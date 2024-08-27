<?php
include('../../config/config.php');

// Número de itens por página
$items_per_page = 6;

// Página atual
$current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($current_page - 1) * $items_per_page;

// Obter o número total de registros
$sql_total = "SELECT COUNT(*) FROM `processos`";
$total_result = $conn->query($sql_total);
$total_rows = $total_result->fetch_row()[0];

// Calcular o número total de páginas
$total_pages = ceil($total_rows / $items_per_page);

// Consultar registros para a página atual
$sql = "SELECT * FROM `processos` LIMIT $items_per_page OFFSET $offset";
$result = $conn->query($sql);

?>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
</div>
<!-- fim do modal  -->
<div class="sidebar ">
    <ul class="mt-4">
        <li>
            <a href="dashboard.php?pag=2">
                <div class="centralizar">
                    <span class="icone"><img src="..\..\assets\images\funcionarios.png" alt=""></span>
                    <span style=" margin-left: 5px; " class="titulo">Funcionarios</span>
                </div>
            </a>
        </li>
        <li>
            <a href="dashboard.php?pag=3">
                <div class="centralizar">
                    <span class="icone"><img src="..\..\assets\images\medico.png" alt=""></span>
                    <span class="titulo">Medicos</span>
                </div>
            </a>
        </li>
        <li>
            <a href="dashboard.php?pag=4">
                <div class="centralizar">
                    <span class="icone"><img src="..\..\assets\images\paciente.png" alt=""></span>
                    <span class="titulo">Pacientes</span>
                </div>
            </a>
        </li>
    </ul>
</div>
<div class="col-10 mb-5">
    <div class="row mt-5">
        <div class="col mt-3" style="position: relative; width:100%; inset: 0% 10%;">
            <header class="bg-info text-white" style="padding: 5px 15px;">
                Processos:
            </header>
            <button type="button" class="btn btn-primary  mt-5 mb-5 text-white" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                Cadastrar Processo
            </button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header bg-info text-white">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastar Processo</h1>
                            <button type="button" class="btn btn-close btn-light p-2 rounded-circle" data-bs-dismiss="modal" aria-label="Close">
                                <img src="../../assets/images/close.png" alt="Fechar" style="width: 20px;">
                            </button>
                        </div>
                        </div>
                        <div class="modal-body bg-white">
                            <?php include("cadastrar_processo.php") ?>
                        </div>
                        <div class="modal-footer">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-10 offset-1">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Número do Processo:</th>
                    <th scope="col">Cópia do Processo:</th>
                    <th scope="col">Receita:</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr >
                    <th scope="row"><?php echo $row['cod_processo'] ?></th>
                    <td><?php echo $row['numero_processo'] ?></td>
                    <td><?php echo $row['copia_processo'] ?></td>
                    <td><?php echo $row['receita'] ?></td>
                    <td>
                        <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
                            data-bs-target="#medModal" onclick="medProcessID(<?php echo $row['cod_processo'] ?>)">
                            Medicamentos
                        </button>
                        <div class="modal fade" id="medModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detalhes do Medicamento</h5>
                                    </div>
                                    <div class="modal-body" id="modal-body">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#excluirModal" onclick="getID(<?php echo $row['cod_processo'] ?>)">
                            <i class="bi bi-trash-fill"></i> Excluir
                        </button>
                    </td>
                    <td><a href="editar_processo.php?id_processo=<?php echo $row['cod_processo'] ?>"
                            class="btn btn-warning"><i class="bi bi-pencil"></i> Editar</a></td>
                </tr>
                <div class="modal fade" id="excluirModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir Processo</h1>
                                <button type="button" class="btn btn-light p-2 rounded-circle" data-bs-dismiss="modal" aria-label="Close">
                    <img src="../../assets/images/close.png" alt="Fechar" style="width: 20px;">
                </button>
                            </div>
                            <div class="modal-body">
                                Deseja excluir esse processo ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger"
                                    onclick="excluirProcesso()">Excluir</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php endif ?>

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
                    <a style="background-color: #13899c; color: FFF;" class="page-link"
                        href="?page=<?= $current_page - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?= ($i == $current_page) ? 'active' : ''; ?>">
                    <a style="background-color: #17a2b8; color: FFF;" class="page-link"
                        href="?page=<?= $i; ?>"><?= $i; ?></a>
                </li>
                <?php endfor; ?>
                <?php if ($current_page < $total_pages): ?>
                <li class="page-item">
                    <a style="background-color: #13899c; color: FFF;" class="page-link"
                        href="?page=<?= $current_page + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>

<script src="../../assets/js/jquery-3.3.1.min.js"></script>
<script src="../../assets/js/popper.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous">
</script>

<script>
var idSelecionado = null
var idMedicamentoProcesso = null

function getID(id) {
    idSelecionado = id
    console.log(idSelecionado);
}

function excluirProcesso() {
    window.location.href = "remover_processo.php?id_processo=" + idSelecionado
}

function medProcessID(id) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "listar_medicamentos_processos.php?id_processo=" + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("modal-body").innerHTML = xhr.responseText;
            $('#medModal').modal('show');
        }
    };
    xhr.send();
}
</script>

<script>
$(function() {
    $("#datepicker").datepicker({
        autoclose: true,
        todayHighlight: true,
    }).datepicker('update', new Date());
});
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
</script>

<script>
function showSelectedValue() {
    var dropdown = document.getElementById('myDropdown');
    var selectedValue = dropdown.value;
    var variaveljs - "yan_corno"
    alert('Valor selecionado: ' + selectedValue);
}
</script>