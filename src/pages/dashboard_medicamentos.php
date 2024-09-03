<?php
if(!isset($_SESSION['ID'])){
    session_start();
};

     if(!isset($_SESSION["Perfil"])){
        header('Location: ../../public/index.php');
   }

include('../../config/config.php');

// Número de itens por página
$items_per_page = 6;

// Página atual
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $items_per_page;

// Obter o número total de registros
$sql_total = "SELECT COUNT(*) FROM `entregas`";
$total_result = $conn->query($sql_total);
$total_rows = $total_result->fetch_row()[0];

// Calcular o número total de páginas
$total_pages = ceil($total_rows / $items_per_page);

// Consultar registros para a página atual
$sql = "
    SELECT * FROM medicamentos
    LIMIT $items_per_page OFFSET $offset;
";

// Executar a consulta
$result = $conn->query($sql);

function getStatus($validade, $quantidade) {
    $validade_date = new DateTime($validade);
    $current_date = new DateTime();
    $interval = $current_date->diff($validade_date);
    $months_left = $interval->y * 12 + $interval->m;

    if ($months_left < 5 || $quantidade < 50) {
        return ['color' => '#ff0000', 'status' => 'Estoque baixo']; // Vermelho
    } elseif ($months_left < 6 || $quantidade < 100) {
        return ['color' => '#ffff00', 'status' => 'Estoque médio']; // Amarelo
    } else {
        return ['color' => '#00ff00', 'status' => 'Estoque suficiente'];; // Verde
    }
}
?>


<div class="container">
<style>
.row_paciente{
    cursor: default; 
}

.container {
    padding: 20px;
}

.search-and-button {
    display: flex;
    align-items: center; 
    gap: 70%;
}

.search-and-button .btn {
    padding: 5px 10px; 
}

.search-and-button .truncate {
    flex-grow: 1; 
    max-width: 400px; 
    padding: 5px;
    border: 1px solid #ced4da;
    border-radius: 4px;
}

</style>
<!-- Modal -->
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
                            <option value="" disabled selected>Selecione o o paciente primeiro</option>
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
    <!-- Fim do modal  -->

    <div class="row">
        <div class="col-1" style="margin: 0; padding: 0;">
        <?php include('sidebar_gestor.php'); ?>
        </div>
        <div class="col-10">
            <div class="row mt-5">
                <div class="col mt-3">
                    <header class="bg-info text-white" style="padding: 5px 15px;">
                        Medicamentos:
                    </header>
                    <br>
                    <div class="container">
                        <div class="search-and-button">
                            <button style="background-color: #17a2b8; color: #FFF;" class="btn btn-custom-edit btn-sm" type="button" onclick="location.href='cadastrar.php'">Cadastrar Medicamentos</button>
                            <input id="input" name="teste" class="truncate" type="search" autocomplete="off" spellcheck="false" role="combobox" aria-controls="matches" aria-expanded="false" aria-live="off" placeholder="Pesquise no Google ou digite um URL">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Botão que ativa o modal -->
            <!-- Fim do botão que ativa o modal -->

            <div class="row">
                <div class="col-10 offset-1">
                    <table class="table mt-5 text-center">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Status</th>
                                <th scope="col">cod. medicamento</th>
                                <th scope="col">cod. compra</th>
                                <th scope="col">nome medicamento</th>
                                <th scope="col">tipo medicamento</th>
                                <th scope="col">categoria</th>
                                <th scope="col">laboratorio</th>
                                <th scope="col">lote</th>
                                <th scope="col">validade</th>
                                <th scope="col">quantidade</th>
                                <th scope="col">ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr class="row_paciente" >
                                    <?php
                                        $status_info = getStatus($row['validade'], $row['quantidade']);
                                    ?>
                                    <span class="tooltip status-th d-inline-block" tabindex="0" data-toggle="tooltip">
                                    <th class="btn"
                                        title="<?php echo htmlspecialchars($status_info['status']); ?>"
                                        type="button"
                                        style="height:80px; background-color: <?php echo htmlspecialchars($status_info['color']); ?>;" disable>
                                    </th>
                                    <th scope="row"><?= $row['cod_medicamento']; ?></th>
                                    <td><?= $row['cod_compra']; ?></td>
                                    <td><?= $row['nome_medicamento']; ?></td>
                                    <td><?= $row['tipo_medicamento']; ?></td>
                                    <td><?= $row['categoria']; ?></td>
                                    <td><?= $row['laboratorio']; ?></td>
                                    <td><?= $row['lote']; ?></td>
                                    <td><?= $row['validade']; ?></td>
                                    <td><?= $row['quantidade']; ?></td>
                                    <td>
                                        <div style="width: 130px; color: #13899c;" >
                                            <button type="button"  onclick="editar.php" class="btn btn-custom-edit btn-sm btn btn-warning">Editar</button>
                                            <button type="button" onclick="excluir.php" class="btn btn-custom-delete btn-sm btn btn-danger">Excluir</button>
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

<!-- Modal Entrega Infos Inicio-->
<!-- Modal -->
<div class="modal fade" id="EntregaModal" tabindex="-1" aria-labelledby="EntregaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EntregaModalLabel">Detalhes da Entrega</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- O conteúdo dinâmico será inserido aqui -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Entrega Infos Fim -->

<!-- Scripts -->
 <!-- Inicializa os tooltips -->
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>
<script src="../../assets/js/jquery-3.3.1.min.js"></script>
<script src="../../assets/js/popper.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

