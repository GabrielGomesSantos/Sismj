<?php
include('../../config/config.php');

//Verifica se algo foi pesquisado
$sql = "SELECT * FROM medicamentos WHERE cod_compra = $_GET[id_compra]";

$result = mysqli_query($conn, $sql);

//Se a consulta gerar resultado irá armazenar tudo na variável "saida"
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result))
        $saida[] = $row;
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
                        <tbody>
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
                                                href="sisman_db.php?id_deleteMed2=<?php echo $medicamento['cod_medicamento'] ?>&id_compra=<?php echo $medicamento['cod_compra'] ?>">Remover</a>/<button
                                                type="button" class="btn btn-custom-edit btn-sm btn btn-warning btn-editar"
                                                data-bs-toggle="modal" data-bs-target="#editarMedicamentoModal2">Editar</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <!--Como dito anteriormente, se a tabela estiver vazia não irá imprimi-la, por conseguinte
                    aparecerá uma imagem e uma mensagem informando que a tabela está vazia-->
                                <div class="cardVazia">
                                    <p>A tabela está sem medicamentos</p>
                                </div>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editarMedicamentoModal2" tabindex="-1" aria-labelledby="editarMedicamentoModalLabel"
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
                <form id="editarMedicamentoForm" method="POST" action="sisman_db.php">
                    <input type="hidden" name="cod_medicamento" id="editarCodMedicamento">
                    <div class="mb-3">
                        <label for="editarNomeMedicamento" class="form-label">Nome Medicamento</label>
                        <input type="text" class="form-control" id="editarNomeMedicamento" name="nome"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="editarTipoMedicamento" class="form-label">Tipo Medicamento</label>
                        <input type="text" class="form-control" id="editarTipoMedicamento" name="tipo"
                            required>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
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

<!-- Modal Excluir Medicamento -->
<div class="modal fade" id="excluirMedicamentoModal" tabindex="-1" aria-labelledby="excluirMedicamentoModalLabel"
    aria-hidden="true">
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
                <p>Você tem certeza de que deseja excluir o medicamento <strong id="excluirNomeMedicamento"></strong>?
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
                const codMedicamento = row.querySelector('td:nth-child(1)').innerText; // Código do medicamento

                // Preencher o modal de edição com os dados
                document.getElementById('editarCodMedicamento').value = codMedicamento;
                document.getElementById('editarNomeMedicamento').value = row.querySelector('td:nth-child(2)').innerText; // Nome
                document.getElementById('editarTipoMedicamento').value = row.querySelector('td:nth-child(3)').innerText; // Tipo
                document.getElementById('editarCategoria').value = row.querySelector('td:nth-child(4)').innerText; // Categoria
                document.getElementById('editarLaboratorio').value = row.querySelector('td:nth-child(5)').innerText; // Laboratório
                document.getElementById('editarLote').value = row.querySelector('td:nth-child(6)').innerText; // Lote
                document.getElementById('editarValidade').value = row.querySelector('td:nth-child(7)').innerText; // Validade
                document.getElementById('editarQuantidade').value = row.querySelector('td:nth-child(8)').innerText; // Quantidade
            });
        });
    });


    // Configurar o modal de exclusão
    document.querySelectorAll('.btn-excluir').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const codMedicamento = row.querySelector('th').innerText;
            const nomeMedicamento = row.querySelector('td:nth-child(3)').innerText;
            document.getElementById('excluirCodMedicamento').value = codMedicamento;
            document.getElementById('excluirNomeMedicamento').innerText = nomeMedicamento;
        });
    });
</script>