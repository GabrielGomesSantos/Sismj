<?php
if(!isset($_SESSION['ID'])){
    session_start();
};

if(!isset($_SESSION["Perfil"])){
    header('Location: ../../public/index.php');
}

include('../../config/config.php');

$id_funcionario = $_SESSION['ID'];

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
    SELECT e.*, p.nome_paciente, p.cpf_paciente
    FROM entregas e
    LEFT JOIN pacientes p ON e.cod_paciente = p.cod_paciente
    WHERE e.cod_funcionario = {$id_funcionario}

    LIMIT {$items_per_page} OFFSET {$offset};
";


// Executar a consulta
$result = $conn->query($sql);
?>

<div class="container">
<!-- Modal -->
<div class="modal fade" id="cadastromodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Cabeçalho do Modal -->
            <div class="modal-header bg-info text-white">
                <div class="d-flex align-items-center">
                    <h1 class="modal-title fs-5 mb-0" id="cadastrarModal">Cadastrar Entrega</h1>
                </div>
                <button type="button" class="btn btn-light p-2  rounded-circle" style=" height: 42px; width: 42px;" data-bs-dismiss="modal" aria-label="Close">
                    <img src="../../assets/images/close.png" alt="Fechar" style="width: 20px;">
                </button>
            </div>

            <!-- Corpo do Modal -->
            <div class="modal-body">
                <form action="" method="">
                    <!-- Seção Paciente -->
                    <h4 class="text-secondary">PACIENTE</h4>
                    <div class="border-top border-secondary p-2">
                        <label for="nome" class="form-label" Required>Nome:</label>
                        <select class="form-control rounded-4" name="nome" id="DropDownNome">
                            <option value="" disabled selected>Selecione o nome do paciente</option>
                            <?php 
                                $sql_pacientes = "SELECT nome_paciente, cod_paciente FROM pacientes";
                                $pacientes = $conn->query($sql_pacientes);

                                while ($row = $pacientes->fetch_assoc()): ?>
                                    <option value="<?php echo $row['cod_paciente']?>"><?php echo $row['nome_paciente']?></option>
                                <?php endwhile; ?>
                        </select>

                        <label for="codprocesso" class="form-label mt-3" Required>Código do Processo:</label>
                        <select class="form-control" name="codprocesso" id="codprocesso">
                            <option value="" disabled selected>Selecione o o paciente primeiro</option>
                            <!-- As opções serão adicionadas dinamicamente via JavaScript -->
                        </select>
                    </div>

                    
                    <!-- Tabela dos medicamentos -->
                    <h4 class="text-secondary mt-4">MEDICAMENTOS</h4>
                    <div class="border-top border-secondary p-2">
                    <div>
                        <table class="table mt-4" id="TabelaMedicamentos">

                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Medicamento</th>
                                    <th scope="col">tipo</th>
                                    <th scope="col">Laboratorio</th>
                                    <th scope="col">Qnts</th>
                                </tr>
                            </thead>

                            <tbody>
                                    <th>

                                    </th>
                            </tbody>
                        </table>
                        </div>
                    </div>
                                    
                    <div class="form-group">
                    <h4 class="text-secondary mt-4">OBSERVAÇÕES</h4>
                    <div class="border-top border-secondary p-2"></div>
                      <textarea class="form-control" id="observacaomed" placeholder="Observações sobre o(s) medicamento(s)" rows="3"></textarea>
                    </div>
                    <input type="hidden" value=" <?php echo $_SESSION['ID'] ?>" name="id" id="cod_funcionario">
                    <!-- Tabela dos medicamentos Fim-->
                        <!-- Rodapé do Modal -->
                                    
                    <div class="modal-footer">
                    </div>
                </form>
                <div class="row">
                    <div class="col-2 offset-9">
                        <button type="button" id="processar" style="background-color: #17a2b8; color: #FFF;" class="btn">
                            Salvar
                        </button>
                    </div>
                </div>
            </div>       
        </div>
    </div>
</div>
    <!-- Fim do modal  -->

    <div class="row">
        <div class="col-1" style="margin: 0; padding: 0;">
            <div class="sidebar ">
                <ul class="mt-4">
                    <li>
                        <a href="dashboard.php?pag=1">
                           <div class="centralizar">
                                <span class="icone"><img src="..\..\assets\images\entrega.png" alt=""></span>
                                <span style=" margin-left: 5px; " class="titulo">Entregas</span>
                           </div>
                        </a>
                    </li>
                    <li>
                        <a href="dashboard.php?pag=2">
                            <div class="centralizar">
                                <span class="icone"><img src="..\..\assets\images\estoque.png" alt=""></span>
                                <span  class="titulo">Estoque</span>
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
                        Entregas:
                    </header>
                </div>
            </div>

            <!-- Botão que ativa o modal -->
            <div class="row">
                <div class="col-2">
                    <button type="button" style="background-color: #17a2b8; color: #FFF;" class="btn mt-3" data-bs-toggle="modal" data-bs-target="#cadastromodal">
                        Cadastrar
                    </button>
                </div>
                
            </div>
            <!-- Fim do botão que ativa o modal -->
             

            <div class="row">
                <div class="col-10 offset-1">
                    <table class="table mt-5 text-center" id="TabelaEntregas">
                        <thead class="thead-light" >
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Nome do Paciente</th>
                                <th scope="col">Cpf</th>
                                <th scope="col">Cod. Processo</th>
                                <th scope="col">Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr class="row_paciente " onclick="openModal('<?= $row['cod_entrega']; ?>')">
                                    <th scope="row"><?= $row['cod_entrega']; ?></th>
                                    <td><?= $row['nome_paciente']; ?></td>
                                    <td><?= $row['cpf_paciente']; ?></td>
                                    <td><?= $row['cod_processo']; ?></td>
                                    <td><?= $row['data_entrega']; ?></td>
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
            <div class="modal-header bg-info text-white">
                <div class="d-flex align-items-center">
                    <h1 class="modal-title fs-5 mb-0" id="cadastrarModal">Detalhes da entrega</h1>
                </div>
                <button type="button" class="btn btn-light p-2 rounded-circle" data-bs-dismiss="modal" aria-label="Close">
                    <img src="../../assets/images/close.png" alt="Fechar" style="width: 20px;">
                </button>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- O conteúdo dinâmico será inserido aqui -->
            </div>
            <div class='modal-footer'>
                <button onclick="generatePDF()" class='btn btn-info'>Gerar PDF</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Entrega Infos Fim -->


<!-- Modal confirmacao-->
<div class="modal fade" id="confirmacaoModal" tabindex="-1" aria-labelledby="EntregaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <div class="d-flex align-items-center">
                    <h1 class="modal-title fs-5 mb-0" id="cadastrarModal">Confirmação de Entrega</h1>
                </div>
                <div>
                    <p>
                        Entrega realizada com sucesso
                    </p>
                </div>
        </div>
    </div>
</div>
</div>

<!-- Modal confirmacao Fim -->


<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="../../assets/js/dashboar.js"></script>
