<?php
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
            <div class="sidebar">
                <ul class="mt-4">
                    <li>
                        <a href="dashboard.php?pag=1">
                           <div class="centralizar">
                                <span class="icone"><img src="..\..\assets\images\truck.png" alt=""></span>
                                <span style=" margin-left: 5px; " class="titulo">Entregas</span>
                           </div>
                        </a>
                    </li>
                    <li>
                        <a href="dashboard.php?pag=2">
                            <div class="centralizar">
                                <span class="icone"><img src="..\..\assets\images\pill.png" alt=""></span>
                                <span  class="titulo">Medicamentos</span>
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
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="search-and-button">
                        <button style="background-color: #17a2b8; color: #FFF;" class="btn btn-custom-edit btn-sm" type="button" onclick="location.href='cadastrar.php'">Cadastrar Medicamentos</button>
                        <input id="input" name="teste" class="truncate" type="search" autocomplete="off" spellcheck="false" role="combobox" aria-controls="matches" aria-expanded="false" aria-live="off" placeholder="Pesquise no Google ou digite um URL">
                    </div>
                </div>
            </div>
            <!-- Botão que ativa o modal -->
            <!-- Fim do botão que ativa o modal -->

            <div class="row">
                <div class="col-10 offset-1">
                    <table class="table mt-5">
                        <thead class="thead-light">
                            <tr>
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
                                        <div style="width: 130px; color: #13899c;">
                                            <button type="button" class="btn btn-custom-edit btn-sm btn btn-warning btn-editar" data-bs-toggle="modal" data-bs-target="#editarMedicamentoModal">Editar</button>
                                            <button type="button" class="btn btn-custom-delete btn-sm btn btn-danger btn-excluir" data-bs-toggle="modal" data-bs-target="#excluirMedicamentoModal">Excluir</button>
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
<!-- Modal Editar Medicamento -->
<div class="modal fade" id="editarMedicamentoModal" tabindex="-1" aria-labelledby="editarMedicamentoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="editarMedicamentoModalLabel">Editar Medicamento</h5>
                <button type="button" class="btn btn-light p-2 rounded-circle" data-bs-dismiss="modal" aria-label="Close">
                    <img src="../../assets/images/close.png" alt="Fechar" style="width: 20px;">
                </button>
            </div>
            <div class="modal-body">
                <form id="editarMedicamentoForm" method="POST" action="editar.php">
                    <input type="hidden" name="cod_medicamento" id="editarCodMedicamento">
                    <div class="mb-3">
                        <label for="editarNomeMedicamento" class="form-label">Nome Medicamento</label>
                        <input type="text" class="form-control" id="editarNomeMedicamento" name="nome_medicamento" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarTipoMedicamento" class="form-label">Tipo Medicamento</label>
                        <input type="text" class="form-control" id="editarTipoMedicamento" name="tipo_medicamento" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarCategoria" class="form-label">Categoria</label>
                        <input type="text" class="form-control" id="editarCategoria" name="categoria" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarLaboratorio" class="form-label">Laboratório</label>
                        <input type="text" class="form-control" id="editarLaboratorio" name="laboratorio" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarLote" class="form-label">Lote</label>
                        <input type="text" class="form-control" id="editarLote" name="lote" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarValidade" class="form-label">Validade</label>
                        <input type="date" class="form-control" id="editarValidade" name="validade" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarQuantidade" class="form-label">Quantidade</label>
                        <input type="number" class="form-control" id="editarQuantidade" name="quantidade" required>
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
<!-- Modal Excluir Medicamento -->
<div class="modal fade" id="excluirMedicamentoModal" tabindex="-1" aria-labelledby="excluirMedicamentoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="excluirMedicamentoModalLabel">Excluir Medicamento</h5>
                <button type="button" class="btn btn-light p-2 rounded-circle" data-bs-dismiss="modal" aria-label="Close">
                    <img src="../../assets/images/close.png" alt="Fechar" style="width: 20px;">
                </button>
            </div>
            <div class="modal-body">
                <p>Você tem certeza de que deseja excluir o medicamento <strong id="excluirNomeMedicamento"></strong>? Esta ação não pode ser desfeita.</p>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script>
    // Configurar o modal de edição
    document.querySelectorAll('.btn-editar').forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            document.getElementById('editarCodMedicamento').value = row.querySelector('th').innerText;
            document.getElementById('editarNomeMedicamento').value = row.querySelector('td:nth-child(3)').innerText;
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
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const codMedicamento = row.querySelector('th').innerText;
            const nomeMedicamento = row.querySelector('td:nth-child(3)').innerText;
            document.getElementById('excluirCodMedicamento').value = codMedicamento;
            document.getElementById('excluirNomeMedicamento').innerText = nomeMedicamento;
        });
    });
</script>

