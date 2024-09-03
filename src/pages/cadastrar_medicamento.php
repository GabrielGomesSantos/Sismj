<?php
include('../../config/config.php');

//Verifica se algo foi pesquisado
$sql = "SELECT * FROM medicamentos WHERE cod_compra = $_GET[id]";

$result = mysqli_query($conn, $sql);

//Se a consulta gerar resultado irá armazenar tudo na variável "saida"
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result))
        $saida[] = $row;
}
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
            <?php include('sidebar_gestor.php'); ?>
        </div>
        <div class="col-10">
            <div class="row mt-4">
                <div class="col mt-0">
                    <header class="bg-info text-white" style="padding: 5px 15px;">
                        Carrinho:
                    </header>

                    <div class="row mt-5">
                        <!-- Formulário -->
                        <div class="col-md-4 form-container">
                            <div class="form-header">
                                <h3>Cadastro de <strong>Medicamentos</strong></h3>
                                <p class="mb-4">Formulário para cadastrar Medicamentos</p>
                            </div>
                            <form action="sisman_db.php" method="post">
                                <div class="form-group mb-3">
                                    <label for="nome_medicamento">Nome:</label>
                                    <input type="text" class="form-control form-control-sm" id="nome" name="nome"
                                        required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tipo">Tipo:</label>
                                    <input type="text" class="form-control form-control-sm" id="tipo" name="tipo"
                                        required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="categoria">Categoria:</label>
                                    <input type="text" class="form-control form-control-sm" id="categoria"
                                        name="categoria" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="laboratorio">Laboratorio:</label>
                                    <input type="text" class="form-control form-control-sm" id="laboratorio"
                                        name="laboratorio" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="lote">Lote:</label>
                                    <input type="number" class="form-control form-control-sm" id="lote" name="lote"
                                        required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="validade">Validade:</label>
                                    <input type="date" class="form-control form-control-sm" id="validade"
                                        name="validade" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="quantidade">Quantidade:</label>
                                    <input type="number" class="form-control form-control-sm" id="quantidade"
                                        name="quantidade" required>
                                </div>
                                <input type="hidden" name="id_compra" value="<?php echo $_GET['id'] ?>">
                                <input type="submit" name="insert_med" value="Adicionar"
                                    class="btn text-white btn-block btn-info mt-3 btn-sm">
                            </form>
                            <a href="dashboard.php?pag=2" class="btn text-white btn-block btn-success mt-3 btn-sm">Finalizar</a>
                        </div>

                        <!-- Tabela -->
                        <div class="col-md-8">
                            <table class="table mt-5">
                                <tbody>
                                    <!--Se a variável "saida" estiver vazia ele não irá tentar imprimir a tabela, caso contrário,
                a tabela aparecerá normalmente-->
                                    <?php if (!empty($saida)) { ?>
                                        <tr>
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
                                        <!--Itera sobre todos os elementos da variável "saida" para imprimi-la corretamente-->
                                        <?php foreach ($saida as $medicamento) { ?>
                                            <tr>
                                                <td><?php echo $medicamento['cod_medicamento'] ?></td>
                                                <td><?php echo $medicamento['nome_medicamento'] ?></td>
                                                <td><?php echo $medicamento['tipo_medicamento'] ?></td>
                                                <td><?php echo $medicamento['categoria'] ?></td>
                                                <td><?php echo $medicamento['laboratorio'] ?></td>
                                                <td><?php echo $medicamento['lote'] ?></td>
                                                <td><?php echo $medicamento['validade'] ?></td>
                                                <td><?php echo $medicamento['quantidade'] ?></td>
                                                <!--Links para editar ou remover um elemento da tabela com base no ID-->
                                                <td><a class="corDelete"
                                                        href="sisman_db.php?id_deleteMed=<?php echo $medicamento['cod_medicamento'] ?>&id_compra=<?php echo $medicamento['cod_compra'] ?>">Remover</a></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <!--Como dito anteriormente, se a tabela estiver vazia não irá imprimi-la, por conseguinte
                    aparecerá uma imagem e uma mensagem informando que a tabela está vazia-->
                                        <div class="cardVazia">
                                            <p>A tabela está sem medicamentos😪 <br>Se tiver adicione medicamento</p>
                                        </div>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Modal Editar Compra -->
                    <div class="modal fade" id="editarCompraModal" tabindex="-1"
                        aria-labelledby="editarCompraModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info text-white">
                                    <h5 class="modal-title" id="editarCompraModalLabel">Editar Compra</h5>
                                    <button type="button" class="btn btn-light p-2 rounded-circle"
                                        data-bs-dismiss="modal" aria-label="Close">
                                        <img src="../../assets/images/close.png" alt="Fechar" style="width: 20px;">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="editarCompraForm" method="POST" action="editar.php">
                                        <input type="hidden" name="cod_compra" id="editarCodCompra">
                                        <div class="mb-3">
                                            <label for="editarNotaFiscal" class="form-label">Nota Fiscal</label>
                                            <input type="text" class="form-control" id="editarNotaFiscal"
                                                name="nota_fical" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editarData" class="form-label">Data</label>
                                            <input type="text" class="form-control" id="editarData" name="data"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editarFornecedor" class="form-label">Fornecedor</label>
                                            <input type="text" class="form-control" id="editarFornecedor"
                                                name="fornecedor" required>
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
                    <!-- Modal Excluir Compra -->
                    <div class="modal fade" id="excluirCompraModal" tabindex="-1"
                        aria-labelledby="excluirCompraModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="excluirCompraModalLabel">Excluir Compra</h5>
                                    <button type="button" class="btn btn-light p-2 rounded-circle"
                                        data-bs-dismiss="modal" aria-label="Close">
                                        <img src="../../assets/images/close.png" alt="Fechar" style="width: 20px;">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Você tem certeza de que deseja excluir a compra <strong
                                            id="excluirNomeCompra"></strong>? Esta ação não pode ser desfeita.</p>
                                </div>
                                <div class="modal-footer">
                                    <form id="excluirCompraForm" method="POST" action="excluir.php">
                                        <input type="hidden" name="cod_compra" id="excluirCodCompra">
                                        <button type="submit" class="btn btn-danger">Excluir</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancelar</button>
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

                            // Configurar o modal de exclusão
                            document.querySelectorAll('.btn-excluir').forEach(button => {
                                button.addEventListener('click', function () {
                                    const row = this.closest('tr');
                                    const codCompra = row.querySelector('th').innerText;
                                    const nomeCompra = row.querySelector('td:nth-child(3)').innerText;
                                    document.getElementById('excluirCodCompra').value = codCompra;
                                    document.getElementById('excluirNomeCompra').innerText = nomeMedicamento;
                                });
                            });
                    </script>