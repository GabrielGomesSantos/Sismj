<?php
include('../../config/config.php');

// Número de itens por página
$items_per_page = 6;

// Página atual
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $items_per_page;

// Obter o número total de registros
$sql_total = "SELECT COUNT(*) FROM `medicamentos`";
$total_result = $conn->query($sql_total);
$total_rows = $total_result->fetch_row()[0];

// Calcular o número total de páginas
$total_pages = ceil($total_rows / $items_per_page);

// Consultar registros para a página atual
$sql = "SELECT * FROM `medicamentos` LIMIT $items_per_page OFFSET $offset";
$result = $conn->query($sql);
?>



<div style="overflow-x: hidden;  " class="container">
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"    aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastrar entrega</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
            <div class="modal-body">
                <div class="container">
                    <form action="" method="">

                        <h4>Paciente</h4>
                        <div class="paciente border-top border-info p-2">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" class="form-control" name="nome" id="nome">
                            <label for="codprocesso" class="codprocesso">Cod. processo</label>
                            <input type="text" class="form-control" name="codprocesso" id="">
                        </div>

                        <h4>Medicamentos:</h4>
                        <div class="bg-light border-top border-info p-2">
                            <!-- Colocar codigo php aqui para os medicamentos -->
                            <input class="form-control text-secondary " type="text" name="medicamento" id="medicamento" value="<?php echo "medicamento"?>" disabled ">

                            
                        </div>

                        <div class="modal-footer">
                            <input type="submit" value="Enviar" class="btn btn-primary" data-bs-dismiss="modal">
                        </div>
                    </form>
                </div>
            </div>       
        </div>
      </div>
    </div>
    <!-- fim do modal  -->
    <div class="row">
        <div class="col-1">
            <div style="background-color: #17a2b8; width: 50px; height: 100%;">
            <button class="btn btn-primary mt-3" style=" padding: 4px; ">Teste</button>  
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
                <div class="col-2 offset-10">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                  Launch static backdrop modal
                </button>
                </div>
            </div>
            <div class="row">
                <div style="display: flex; justify-content: center;" class="col-10 offset-1">
                    <table class="table mt-5">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Medicamento</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Laboratório</th>
                                <th scope="col">Lote</th>
                                <th scope="col">Validade</th>
                                <th scope="col">Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result as $row): ?>
                                <tr>
                                    <th scope="row"><?= $row['cod_medicamento']; ?></th>
                                    <td><?= $row['nome_medicamento']; ?></td>
                                    <td><?= $row['tipo_medicamento']; ?></td>
                                    <td><?= $row['categoria']; ?></td>
                                    <td><?= $row['laboratorio']; ?></td>
                                    <td><?= $row['lote']; ?></td>
                                    <td><?= $row['validade']; ?></td>
                                    <td><?= $row['quantidade']; ?></td>
                                </tr>
                            <?php endforeach; ?>
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
                                    <a class="page-link" href="?page=<?= $current_page - 1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?= ($i == $current_page) ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                                </li>
                            <?php endfor; ?>
                            <?php if ($current_page < $total_pages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $current_page + 1; ?>" aria-label="Next">
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
<script src="../../assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
