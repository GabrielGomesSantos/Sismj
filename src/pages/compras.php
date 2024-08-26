<?php
include('../../config/config.php');

// Número de itens por página
$items_per_page = 6;

// Página atual
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $items_per_page;

// Obter o número total de registros
$sql_total = "SELECT COUNT(*) FROM `compras`";
$total_result = $conn->query($sql_total);
$total_rows = $total_result->fetch_row()[0];

// Calcular o número total de páginas
$total_pages = ceil($total_rows / $items_per_page);

// Consultar registros para a página atual, incluindo informações de medicamentos
$sql = "
    SELECT compras.cod_compra, compras.nota_fiscal, compras.data, compras.fornecedor, 
           medicamentos.nome_medicamento, medicamentos.tipo_medicamento, medicamentos.categoria, 
           medicamentos.laboratorio, medicamentos.lote, medicamentos.validade, medicamentos.quantidade
    FROM compras
    LEFT JOIN medicamentos ON compras.cod_compra = medicamentos.cod_compra
    LIMIT $items_per_page OFFSET $offset;
";


$result = $conn->query($sql);
?>


<div class="container">

<style>
    .search-and-button .truncate {
        flex-grow: 1;
        max-width: 400px;
        padding: 5px;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }
    .container {
        padding: 20px;
    }

    /* Responsividade */
    @media (max-width: 768px) {
        .sidebar {
            display: none;
        }

        .col-10 {
            width: 100%;
        }
    }

    .search-and-button {
        display: flex;
        align-items: center;
        gap: 10px; 
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .search-and-button .btn {
        padding: 5px 10px;
        margin-right: 10px; 
    }

    .search-and-button .truncate {
        flex-grow: 1;
        max-width: 400px;
        padding: 5px;
        border: 1px solid #ced4da;
        border-radius: 4px; 
        margin-left: auto;
    }

    .search-and-button label {
        margin: 0 5px;
    }

    .search-and-button input[type="date"] {
        margin: 0 5px;
        padding: 5px;
    }

    .btn-group .btn {
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    .btn-group .btn.active {
        border-bottom: 2px solid #01AEF0;
        font-weight: bold;
    }

    .btn-group .btn:hover {
        background-color: #f8f9fa;
    }

    .search-and-button .btn-custom-edit {
        background-color: #17a2b8;
        color: #FFF;
    }

    .search-and-button .btn-custom-delete {
        background-color: #dc3545;
        color: #FFF;
    }

    .pagination .page-item.active .page-link {
        background-color: #233E99;
        border-color: #01AEF0;
    }

    .pagination .page-item .page-link {
        background-color: #17a2b8;
        color: #FFF;
    }

    .pagination .page-item .page-link:hover {
        background-color: #13899c;
    }

    .pagination .page-item .page-link[aria-label="Previous"],
    .pagination .page-item .page-link[aria-label="Next"] {
        background-color: #13899c;
    }

    .sidebar {
        background-color: #f8f9fa;
        border-right: 1px solid #dee2e6;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
    }

    .sidebar ul li {
        padding: 10px;
        border-bottom: 1px solid #dee2e6;
    }

    .sidebar ul li a {
        text-decoration: none;
        color: #000;
    }

    .sidebar ul li a .centralizar {
        display: flex;
        align-items: center;
    }

    .sidebar ul li a .icone img {
        width: 20px;
    }

    .sidebar ul li a .titulo {
        margin-left: 5px;
    }

    .table th,
    .table td {
        text-align: center;
    }

    .btn-group .btn:not(:last-child) {
        margin-right: -1px;
    }

    .btn-group .btn {
        border-radius: 0;
    }

    .search-and-button .period {
        display: flex;
        align-items: center;
        gap: 1px; /* Ajusta o espaçamento entre os campos de data */
        margin-top: 5px; /* Ajusta o espaçamento superior para alinhar melhor */
        margin-left: 60px; 
    }

    .search-and-button .period label {
        margin: 0;
    }
    .search {
        margin-left: auto; /* Alinha a pesquisa à direita */
    }

    .search input[type="search"] {
        padding: 5px;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }
</style>


    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Cabeçalho do Modal -->
                <div class="modal-header bg-info text-white">
                    <div class="d-flex align-items-center">
                        <h1 class="modal-title fs-5 mb-0" id="cadastrarModal">Cadastrar Entrega</h1>
                    </div>
                    <button type="button" class="btn btn-light p-2 rounded-circle" data-bs-dismiss="modal" aria-label="Close">
                        <img src="../../assets/images/close.png" alt="Fechar" style="width: 20px;">
                    </button>
                </div>

                <!-- Corpo do Modal -->
                <div class="modal-body">
                    <form action="" method="">
                        <!-- Seção Paciente -->
                        <h4 class="text-secondary">PACIENTE</h4>
                        <div class="border-top border-secondary p-2">
                            <label for="nome" class="form-label">Nome:</label>
                            <select class="form-control rounded-4" name="nome" id="DropDownNome">
                                <option value="" disabled selected>Selecione o nome do paciente</option>
                                <?php 
                                    $sql_pacientes = "SELECT nome_paciente, cod_paciente FROM pacientes";
                                    $pacientes = $conn->query($sql_pacientes);

                                    while ($row = $pacientes->fetch_assoc()): ?>
                                        <option value="<?php echo $row['cod_paciente']?>"><?php echo $row['nome_paciente']?></option>
                                    <?php endwhile; ?>
                            </select>

                            <label for="codprocesso" class="form-label mt-3">Código do Processo:</label>
                            <select class="form-control" name="codprocesso" id="codprocesso">
                                <option value="" disabled selected>Selecione o paciente primeiro</option>
                                <!-- As opções serão adicionadas dinamicamente via JavaScript -->
                            </select>
                        </div>

                        <!-- Rodapé do Modal -->
                        <button class="btn btn-primary mt-3" onclick="showSelectedValue()">Mostrar Valor Selecionado</button>
                        <div class="modal-footer">
                            <input type="submit" value="Salvar" class="btn btn-primary">
                        </div>
                    </form>
                </div>       
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-1" style="margin: 0; padding: 0;">
            <div class="sidebar">
                <ul class="mt-4">
                    <li>
                        <a href="dashboard.php?pag=1">
                           <div class="centralizar">
                                <span class="icone"><img src="..\..\assets\images\medicamentos.png" alt=""></span>
                                <span style=" margin-left: 5px;" class="titulo">Medicamentos</span>
                           </div>
                        </a>
                    </li>
                    <li>
                        <a href="dashboard.php?pag=2">
                            <div class="centralizar">
                                <span class="icone"><img src="..\..\assets\images\compras.png" alt=""></span>
                                <span class="titulo">Compras</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-10">
            <div class="row mt-5">
                <div class="col mt-3">
                    <header class="bg-info text-white" style="padding: 5px 15px;">
                        Compras:
                    </header>
                    <br>

                    <div class="search-and-button">
                        <button class="btn btn-custom-edit btn-sm" type="button" onclick="location.href='cadastrarCompras.php'">Cadastrar Compras</button>
                        <div class="period">
                            <label for="data-inicio">Período:</label>
                            <input type="date" id="data-inicio" name="data-inicio">
                            <label for="data-fim">até</label>
                            <input type="date" id="data-fim" name="data-fim">
                        </div>
                        <div class="search">
                            <input id="input" name="teste" class="truncate" type="search" autocomplete="off" spellcheck="false" role="combobox" aria-controls="matches" aria-expanded="false" aria-live="off" placeholder="Pesquise no Google ou digite um URL">
                        </div> 
                    </div>                   
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <table class="table mt-5">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Cod.Compra</th>
                                <th scope="col">Nota Fiscal</th>
                                <th scope="col">Fornecedor</th>
                                <th scope="col">Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr class="row_compra">
                                    <th scope="row"><?= $row['cod_compra']; ?></th>
                                    <td><?= $row['nota_fiscal']; ?></td>
                                    <td><?= $row['data']; ?></td>
                                    <td><?= $row['fornecedor']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <?php if ($current_page > 1): ?>
                                <li class="page-item">
                                    <a style="background-color: #13899c; color: #FFF;" class="page-link" href="?page=<?= $current_page - 1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?= ($i == $current_page) ? 'active' : ''; ?>">
                                    <a style="background-color: #17a2b8; color: #FFF;" class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                                </li>
                            <?php endfor; ?>
                            <?php if ($current_page < $total_pages): ?>
                                <li class="page-item">
                                    <a style="background-color: #13899c; color: #FFF;" class="page-link" href="?page=<?= $current_page + 1; ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
