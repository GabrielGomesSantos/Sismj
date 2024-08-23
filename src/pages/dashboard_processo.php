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

// Consultar registros para a página atual
$sql = "SELECT * FROM `compras` LIMIT $items_per_page OFFSET $offset";
$result = $conn->query($sql);

?>

<div class="container">
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
</div>
    <!-- fim do modal  -->
    
    <div class="sidebar">
        <ul>
            <li>
                <a href="#medicamentos">
                    <img src="../../assets/images/medicamentosIcon.png" alt="Medicamentos">
                    <span class="tooltip">Funcionários</span>
                </a>
            </li>
            <li>
                <a href="#compras">
                    <img src="../../assets/images/comprasIcon.png" alt="Compras">
                    <span class="tooltip">Médicos</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="col-10">
            <div class="row mt-5">
                <div class="col mt-3">
                    <header class="bg-info text-white" style="padding: 5px 15px;">
                        Processos:
                    </header>
                </div>
            </div>
    </div>
            <div class="row">
                <div class="col-10 offset-1">
                    <?php include("listar_processos.php")?>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <nav  aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <?php if ($current_page > 1): ?>
                                <li class="page-item">
                                    <a style="background-color: #13899c; color: FFF;" class="page-link" href="?page=<?= $current_page - 1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li  class="page-item <?= ($i == $current_page) ? 'active' : ''; ?>">
                                    <a style="background-color: #17a2b8; color: FFF;" class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                                </li>
                            <?php endfor; ?>
                            <?php if ($current_page < $total_pages): ?>
                                <li class="page-item">
                                    <a style="background-color: #13899c; color: FFF;" class="page-link" href="?page=<?= $current_page + 1; ?>" aria-label="Next">
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

<script src="../../assets/js/jquery-3.3.1.min.js"></script>
<script src="../../assets/js/popper.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" 
        integrity=
    "sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" 
        crossorigin="anonymous">
    </script>
    <script>
        $(function () {
            $("#datepicker").datepicker({ 
                autoclose: true, 
                todayHighlight: true,
            }).datepicker('update', new Date());
        });
    </script>
    <script src=
"https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" 
        integrity=
"sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" 
        crossorigin="anonymous">
    </script>
    <script src=
"https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" 
        integrity=
"sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" 
        crossorigin="anonymous">
    </script>
    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script>

<script>
    function showSelectedValue() {
        var dropdown = document.getElementById('myDropdown');
        var selectedValue = dropdown.value;
        var variaveljs - "yan_corno"
        alert('Valor selecionado: ' + selectedValue);
    }
</script>