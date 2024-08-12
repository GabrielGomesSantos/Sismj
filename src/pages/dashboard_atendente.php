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
    (SELECT e.*, p.nome_paciente, p.cpf_paciente
    FROM entregas e
    LEFT JOIN pacientes p
    ON e.cod_paciente = p.cod_paciente)

    UNION

    (SELECT e.*, p.nome_paciente, p.cpf_paciente
    FROM entregas e
    RIGHT JOIN pacientes p
    ON e.cod_paciente = p.cod_paciente)

    LIMIT $items_per_page OFFSET $offset;
";


$result = $conn->query($sql);
?>

<div class="container">
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Cabeçalho do Modal -->
            <div class="modal-header bg-info text-white">
                <div class="d-flex align-items-center">
                    <h1 class="modal-title fs-5 mb-0" id="staticBackdropLabel">Cadastrar Entrega</h1>
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
                    <select class="form-control rounded-4" name="nome" id="myDropdown">
                        <option value="" disabled selected>Selecione o nome do paciente</option>
                    
                        <?php 
                            $sql_pacientes = "SELECT nome_paciente,cod_paciente FROM pacientes";
                            $pacientes = $conn->query($sql_pacientes);

                            foreach ($pacientes as $row): ?>
                                <option value="<?php echo $row['cod_paciente']?>"><?php echo $row['nome_paciente']?></option>
                            <?php endforeach; ?>
                        
                    </select>
                        
                    <label for="codprocesso" class="form-label">Código do Processo:</label>
                    <select class="form-control" name="codprocesso" id="codprocesso">
                        <option value="" disabled selected>Selecione o código do processo</option>

                        <option value="codigo1">Código 1</option>

                        <!-- Adicione mais opções conforme necessário -->
                    </select>

                    </div>

                    <?php

                        $variavel = "<script> document.write(variaveljs)</script>";

                        echo $variavel;

                    ?>

                    <!-- Seção entregas -->
                    <h4 class="text-secondary mt-4">Entregas:</h4>
                    <div class="bg-light border-top border-secondary p-2">
                        <!-- Colocar código PHP aqui para os entregas -->
                        <select class="form-control text-secondary" name="entregas" id="entregas">
                            <option disabled selected>Selecione o entregas</option>
                            <option>Paracetamol</option>
                            <option>Amoxicilina</option>
                            <!-- Adicionar mais opções conforme necessário -->
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
    <!-- fim do modal  -->
    <div class="row" style=" height: 100%; ">
        <div class="col-1" style=" left: -15px;" >
            <div style="background-color: #17a2b8; width: 50px; height: 100%; left: -15%;">
            <button class="btn mt-2 mb-2 " style="background-color: #13899c; padding: 4px; ">botao1</button> 
            <button class="btn mt-2 mb-2 " style="background-color: #13899c; padding: 4px; ">botao1</button> 
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
            
            <!--botao que ativa o modal-->
            <div class="row">
                <div class="col-2 ">
                <button type="button" style="background-color: #17a2b8;  color: FFF;"" class="btn mt-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                  Cadastrar
                </button>
                </div>
            </div>
            <!--botao que ativa o modal Fim-->


            <div class="row">
                <div class="col-10 offset-1">
                    <table class="table mt-5">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Nome do Paciente</th>
                                <th scope="col">Cpf</th>
                                <th scope="col">Cod. Processo</th>
                                <th scope="col">Data</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result as $row): ?>
                                <!-- Consulta sql para os itens ta table-->
                                <tr onclick="openModal('<?= $row['cod_entrega']; ?>')">
                                    <th scope="row"><?= $row['cod_entrega']; ?></th>
                                    <td><?= $row['nome_paciente']; ?></td>
                                    <td><?= $row['cpf_paciente']; ?></td>
                                    <td><?= $row['cod_processo']; ?></td>
                                    <td><?= $row['data_entrega']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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
<script src="../../assets/js/jquery-3.3.1.min.js"></script>
<script src="../../assets/js/popper.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<script>
    function showSelectedValue() {
        var dropdown = document.getElementById('myDropdown');
        var selectedValue = dropdown.value;

    };

    function openModal(codEntrega) {
    const url = 'entregasQuery.php?cod_entrega=' + codEntrega + '.php';
    console.log('Fetching URL:', url); // Adicione isto para depuração
    
    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById('modalContent').innerHTML = data;

            var modal = new bootstrap.Modal(document.getElementById('EntregaModal'));
            modal.show();
        })
        .catch(error => {
            console.error('Erro ao carregar os detalhes da entrega:', error);
        });
}

</script>