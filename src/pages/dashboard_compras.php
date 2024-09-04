
<?php
include('../../config/config.php');

// Número de itens por página
$items_per_page = 6;

// Página atual
$current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($current_page - 1) * $items_per_page;

// Obter o número total de registros
$sql_total = "SELECT COUNT(*) FROM `compras`";
$total_result = $conn->query($sql_total);
$total_rows = $total_result->fetch_row()[0];

// Calcular o número total de páginas
$total_pages = ceil($total_rows / $items_per_page);

// Consultar registros para a página atual
$sql = "
    SELECT * FROM compras
    LIMIT $items_per_page OFFSET $offset;
";


$result = $conn->query($sql);
?>

<div class="container">
<script>
        function modal_excluir(id)
    {   
        document.getElementById('excluirCodCompra').value = id;
    }

</script>


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
            gap: 1px;
            /* Ajusta o espaçamento entre os campos de data */
            margin-top: 5px;
            /* Ajusta o espaçamento superior para alinhar melhor */
            margin-left: 60px;
        }

        .search-and-button .period label {
            margin: 0;
        }

        .search {
            margin-left: auto;
            /* Alinha a pesquisa à direita */
        }

        .search input[type="search"] {
            padding: 5px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        .form-container {
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control-sm {
            font-size: 0.8;
            /* Ajusta a fonte */
            padding: 0.375rem 0.75rem;
            /* Ajusta o padding */
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            /* Ajusta o padding do botão */
            font-size: 0.875rem;
            /* Ajusta a fonte do botão */
        }

        .mt-5 {
            margin-top: 3rem !important;
        }
    </style>

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
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <table class="table mt-3">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Cod.Compra</th>
                                <th scope="col">Nota Fiscal</th>
                                <th scope="col">Fornecedor</th>
                                <th scope="col">Data</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr class="row_compra">
                                    <th scope="row"><?= $row['cod_compra']; ?></th>
                                    <td><?= $row['nota_fiscal']; ?></td>
                                    <td><?= $row['fornecedor']; ?></td>
                                    <td><?= $row['data']; ?></td>
                                    <td style="text-align: center; padding: 10px;">
                                        <div style="display: flex; justify-content: center; gap: 10px;">
                                            <button type="button"
                                                onclick="window.location.href='dashboard.php?pag=4&id_compra=<?php echo $row['cod_compra'] ?>';"
                                                class="btn btn-custom-edit btn-sm btn btn-success">Visualizar</button>
                                            <button type="button" onclick="modal_excluir(<?php echo $row['cod_compra']; ?>)" 
                                                class="btn btn-custom-delete btn-sm btn btn-danger btn-excluir"
                                                data-bs-toggle="modal" data-bs-target="#excluirCompraModal">Excluir</button>
                                        </div>
                                    </td>
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
                                    <a style="background-color: #13899c; color: #FFF;" class="page-link"
                                        href="?page=<?= $current_page - 1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?= ($i == $current_page) ? 'active' : ''; ?>">
                                    <a style="background-color: #17a2b8; color: #FFF;" class="page-link"
                                        href="?page=<?= $i; ?>"><?= $i; ?></a>
                                </li>
                            <?php endfor; ?>
                            <?php if ($current_page < $total_pages): ?>
                                <li class="page-item">
                                    <a style="background-color: #13899c; color: #FFF;" class="page-link"
                                        href="?page=<?= $current_page + 1; ?>" aria-label="Next">
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

<!-- Modal Editar Compra -->
<div class="modal fade" id="editarCompraModal" tabindex="-1" aria-labelledby="editarCompraModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="editarCompraModalLabel">Editar Compra</h5>
                <button type="button" class="btn btn-light p-2 rounded-circle" data-bs-dismiss="modal"
                    aria-label="Close">
                    <img src="../../assets/images/close.png" alt="Fechar" style="width: 20px;">
                </button>
            </div>
            <div class="modal-body">
                <form id="editarCompraForm" method="POST" action="editar.php">
                    <input type="hidden" name="cod_compra" id="editarCodCompra">
                    <div class="mb-3">
                        <label for="editarNotaFiscal" class="form-label">Nota Fiscal</label>
                        <input type="text" class="form-control" id="editarNotaFiscal" name="nota_fical" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarData" class="form-label">Data</label>
                        <input type="text" class="form-control" id="editarData" name="data" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarFornecedor" class="form-label">Fornecedor</label>
                        <input type="text" class="form-control" id="editarFornecedor" name="fornecedor" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salvar alterações</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Excluir Compra -->
<div class="modal fade" id="excluirCompraModal" tabindex="-1" aria-labelledby="excluirCompraModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="excluirCompraModalLabel">Excluir Compra</h5>
                <button type="button" class="btn btn-light p-2 rounded-circle" data-bs-dismiss="modal"
                    aria-label="Close">
                    <img src="../../assets/images/close.png" alt="Fechar" style="width: 20px;">
                </button>
            </div>
            <div class="modal-body">
                <p>Você tem certeza de que deseja excluir a compra <strong id="excluirNomeCompra"></strong>? Esta ação
                    não pode ser desfeita.</p>
            </div>
            <div class="modal-footer">
                <form id="excluirCompraForm" method="GET" action="sisman_db.php">
                    <input type="hidden" name="compra_delete" id="excluirCodCompra">
                    <button type="submit" class="btn btn-danger">Excluir</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="../../assets/js/jquery-3.3.1.min.js"></script>
<script src="../../assets/js/popper.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
<script>
    // Configurar o modal de edição
    document.querySelectorAll('.btn-editar').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            document.getElementById('editarCodCompra').value = row.querySelector('th').innerText;
            document.getElementById('editarNotaFiscal').value = row.querySelector('td:nth-child(3)').innerText;
            document.getElementById('editarData').value = row.querySelector('td:nth-child(4)').innerText;
            document.getElementById('editarFornecedor').value = row.querySelector('td:nth-child(5)').innerText;
        });

</script>