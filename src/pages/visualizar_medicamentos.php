<?php
include('../../config/config.php');

// Número de itens por página
$items_per_page = 6;

// Página atual
$current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
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

function getStatus($validade, $quantidade)
{
    $validade_date = new DateTime($validade);
    $current_date = new DateTime();
    $interval = $current_date->diff($validade_date);
    $months_left = $interval->y * 12 + $interval->m;

    if ($months_left < 5 || $quantidade < 50) {
        return ['color' => '#ff0000', 'status' => 'Estoque baixo']; // Vermelho
    } elseif ($months_left < 6 || $quantidade < 100) {
        return ['color' => '#ffff00', 'status' => 'Estoque médio']; // Amarelo
    } else {
        return ['color' => '#00ff00', 'status' => 'Estoque suficiente'];
        ; // Verde
    }
}
?>


<div class="container">
    <style>
        .row_paciente {
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

    <div class="row">
        <div class="col-1" style="margin: 0; padding: 0;">
            <div class="sidebar">
                <ul class="mt-4">
                    <li>
                        <a href="dashboard.php?pag=1">
                            <div class="centralizar">
                                <span class="icone"><img src="..\..\assets\images\medicamentos.png" alt=""></span>
                                <span style=" margin-left: 5px; " class="titulo">Medicamentos</span>
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
                        Medicamentos:
                    </header>
                    <br>
                    <div class="container">
                        <div class="search-and-button">
                            <input id="input" name="teste" class="truncate" type="search" autocomplete="off"
                                spellcheck="false" role="combobox" aria-controls="matches" aria-expanded="false"
                                aria-live="off" placeholder="Pesquise no Google ou digite um URL">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Botão que ativa o modal -->
            <!-- Fim do botão que ativa o modal -->
            <div class="row mt-5">
                <!-- Formulário -->

                <!-- Tabela -->
                <div class="col-md-8">
                    <table class="table mt-5">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Status</th>
                                <th scope="col">Nº</th>
                                <th scope="col">Nome Medicamento</th>
                                <th scope="col">Tipo Medicamento</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Laboratorio</th>
                                <th scope="col">Lote</th>
                                <th scope="col">Validade</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr class="row_paciente">
                                    <?php
                                    $status_info = getStatus($row['validade'], $row['quantidade']);
                                    ?>
                                    <th class="btn" title="<?php echo htmlspecialchars($status_info['status']); ?>"
                                        style="height:80px; background-color: <?php echo htmlspecialchars($status_info['color']); ?>;"
                                        disable>
                                    </th>
                                    <th scope="row" data-id="<?= $row['cod_medicamento']; ?>"></th>
                                    <td><?= $row['nome_medicamento']; ?></td>
                                    <td><?= $row['tipo_medicamento']; ?></td>
                                    <td><?= $row['categoria']; ?></td>
                                    <td><?= $row['laboratorio']; ?></td>
                                    <td><?= $row['lote']; ?></td>
                                    <td><?= $row['validade']; ?></td>
                                    <td><?= $row['quantidade']; ?></td>
                                    <td>
                                        <div style="width: 130px; color: #13899c;">
                                            <button type="button"
                                                class="btn btn-custom-edit btn-sm btn btn-warning btn-editar"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editarMedicamentoModal">Editar</button>
                                            <button type="button"
                                                class="btn btn-custom-delete btn-sm btn btn-danger btn-excluir"
                                                data-bs-toggle="modal"
                                                data-bs-target="#excluirMedicamentoModal">Excluir</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

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
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
            crossorigin="anonymous"></script>

        <!-- Modal Editar Medicamento -->
        <div class="modal fade" id="editarMedicamentoModal" tabindex="-1" aria-labelledby="editarMedicamentoModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="editarMedicamentoModalLabel">Editar Medicamento</h5>
                        <button type="button" class="btn btn-light p-2 rounded-circle" data-bs-dismiss="modal"
                            aria-label="Close">
                            <img src="../../assets/images/close.png" alt="Fechar" style="width: 20px;">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="sisman_db.php">
                            <input type="hidden" name="cod_medicamento" id="editarCodMedicamento">
                            <div class="mb-3">
                                <label for="editarNomeMedicamento" class="form-label">Nome Medicamento</label>
                                <input type="text" class="form-control" id="editarNomeMedicamento" name="nome" required>
                            </div>
                            <div class="mb-3">
                                <label for="editarTipoMedicamento" class="form-label">Tipo Medicamento</label>
                                <input type="text" class="form-control" id="editarTipoMedicamento" name="tipo" required>
                            </div>
                            <div class="mb-3">
                                <label for="editarCategoria" class="form-label">Categoria</label>
                                <input type="text" class="form-control" id="editarCategoria" name="categoria" required>
                            </div>
                            <div class="mb-3">
                                <label for="editarLaboratorio" class="form-label">Laboratório</label>
                                <input type="text" class="form-control" id="editarLaboratorio" name="lab" required>
                            </div>
                            <div class="mb-3">
                                <label for="editarLote" class="form-label">Lote</label>
                                <input type="text" class="form-control" id="editarLote" name="lote" required>
                            </div>
                            <div class="mb-3">
                                <label for="editarValidade" class="form-label">Validade</label>
                                <input type="date" class="form-control" id="editarValidade" name="valid" required>
                            </div>
                            <div class="mb-3">
                                <label for="editarQuantidade" class="form-label">Quantidade</label>
                                <input type="number" class="form-control" id="editarQuantidade" name="quant" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Salvar alterações</button>
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Excluir Medicamento -->
        <div class="modal fade" id="excluirMedicamentoModal" tabindex="-1"
            aria-labelledby="excluirMedicamentoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="excluirMedicamentoModalLabel">Excluir Medicamento</h5>
                        <button type="button" class="btn btn-light p-2 rounded-circle" data-bs-dismiss="modal"
                            aria-label="Close">
                            <img src="../../assets/images/close.png" alt="Fechar" style="width: 20px;">
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Você tem certeza de que deseja excluir o medicamento <strong
                                id="excluirNomeMedicamento"></strong>?
                            Esta ação não pode ser desfeita.</p>
                    </div>
                    <div class="modal-footer">
                        <form id="excluirMedicamentoForm" method="POST" action="excluir.php">
                            <input type="hidden" name="cod_medicamento" id="excluirCodMedicamento">
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
            document.addEventListener('DOMContentLoaded', () => {
                // Configurar o modal de edição
                document.querySelectorAll('.btn-editar').forEach(button => {
                    button.addEventListener('click', function () {
                        const row = this.closest('tr');
                        const dataId = row.querySelector('th[data-id]').getAttribute('data-id');

                        // Preencher o modal de edição com os dados
                        document.getElementById('editarCodMedicamento').value = dataId;
                        document.getElementById('editarNomeMedicamento').value = row.querySelector('td:nth-child(3)').innerText; // Ajuste o índice
                        document.getElementById('editarTipoMedicamento').value = row.querySelector('td:nth-child(4)').innerText;
                        document.getElementById('editarCategoria').value = row.querySelector('td:nth-child(5)').innerText;
                        document.getElementById('editarLaboratorio').value = row.querySelector('td:nth-child(6)').innerText;
                        document.getElementById('editarLote').value = row.querySelector('td:nth-child(7)').innerText;
                        document.getElementById('editarValidade').value = row.querySelector('td:nth-child(8)').innerText;
                        document.getElementById('editarQuantidade').value = row.querySelector('td:nth-child(9)').innerText;
                    });
                });

                // Configurar o modal de exclusão
                document.querySelectorAll('.btn-excluir').forEach(button => {
                    button.addEventListener('click', function () {
                        const row = this.closest('tr');
                        const dataId = row.querySelector('th[data-id]').getAttribute('data-id');
                        const nomeMedicamento = row.querySelector('td:nth-child(2)').innerText;

                        document.getElementById('excluirCodMedicamento').value = dataId;
                        document.getElementById('excluirNomeMedicamento').innerText = nomeMedicamento;
                    });
                });
            });
        </script>