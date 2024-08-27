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

// Executar a consulta
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
                                    <option value="<?php echo $row['cod_paciente'] ?>"><?php echo $row['nome_paciente'] ?></option>
                                <?php endwhile; ?>
                            </select>

                            <label for="codprocesso" class="form-label mt-3">Código do Processo:</label>
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
                                        <th></th>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <a href="#" id="processar">salvar</a>
                        <!-- <button id="processar" class="btn btn-prim'ary" disabled>Salvar</button> -->
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Observações</label>
                            <textarea class="form-control" id="observacaomed" placeholder="Observações sobre o(s) medicamento(s)" rows="5"></textarea>
                        </div>
                        <!-- Tabela dos medicamentos Fim-->
                        <!-- Rodapé do Modal -->

                        <div class="modal-footer">
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
                                <span class="titulo">Medicamentos</span>
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
                    <button type="button" style="background-color: #17a2b8; color: #FFF;" class="btn mt-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Cadastrar
                    </button>
                </div>
            </div>
            <!-- Fim do botão que ativa o modal -->

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
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr class="row_paciente" onclick="openModal('<?= $row['cod_entrega']; ?>')">
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


<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<!-- Scripts -->

<script>
    $(document).ready(function() {
        $('#DropDownNome').on('change', function() {
            var pacienteId = $(this).val();

            if (pacienteId) {
                $.ajax({
                    url: 'buscar_processos.php',
                    type: 'POST',
                    data: {
                        id: pacienteId
                    },
                    success: function(response) {
                        try {
                            var dados = JSON.parse(response);

                            // Limpa o dropdown e adiciona a opção padrão
                            var $dropdown = $('#codprocesso');
                            $dropdown.empty().append('<option value="" disabled selected>Selecione o código do processo</option>');

                            // Adiciona as opções ao dropdown
                            dados.processos.forEach(function(processo) {
                                $dropdown.append(`<option value="${processo['cod_processo']}">${processo['numero_processo']}</option>`);
                            });
                        } catch (e) {
                            console.error('Erro ao processar JSON:', e);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro na requisição AJAX:', status, error);
                        console.log('Detalhes do erro:', xhr.responseText);
                    }
                });
            }
        });
    });

    $(document).ready(function() {
        $('#codprocesso').on('change', function() {
            var codProcesso = $(this).val();

            console.log(codProcesso);

            if (codProcesso) {
                $.ajax({
                    url: 'buscar_medicamentos.php',
                    type: 'POST',
                    data: {
                        id: codProcesso
                    },
                    success: function(response) {
                        try {
                            var dados = JSON.parse(response);
                            //salvar(dados);

                            // Verificando se os dados da tabela estão sendo recebidos corretamente
                            console.log('Dados da tabela recebidos:', dados.dadosTabela);

                            // Limpa a tabela antes de adicionar os novos dados
                            var tabelaCorpo = $('#TabelaMedicamentos tbody');
                            tabelaCorpo.empty();

                            // Adiciona as linhas na tabela
                            dados.dadosTabela.forEach(function(item) {
                                var novaLinha = '<tr data_id=' + item.cod_medicamento_processo + '">' +
                                    '<td>' + item.nome_medicamento + '</td>' +
                                    '<td>' + item.tipo_medicamento + '</td>' +
                                    '<td>' + item.laboratorio + '</td>' +
                                    '<td> <input style="border: none;" class"number" type="number" min="1" value="' + item.quantidade + '" max="' + item.quantidade + '"></td>' +
                                    '</tr>';
                                tabelaCorpo.append(novaLinha);
                            });
                        } catch (e) {
                            console.error('Erro ao processar JSON:', e);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro na requisição AJAX:', status, error);
                        console.log('Detalhes do erro:', xhr.responseText);
                    }
                });
            }
        });
    });


    function openModal(codEntrega) {
        // URL para buscar detalhes da entrega
        const url = 'entregasQuery.php?cod_entrega=' + codEntrega;
        console.log('Fetching URL for delivery details:', url); // Adicione isto para depuração

        fetch(url)
            .then(response => response.text())
            .then(data => {
                document.getElementById('modalContent').innerHTML = data;

                // Mostrar o modal se não estiver visível
                var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('EntregaModal'));
                modal.show();
            })
            .catch(error => {
                console.error('Erro ao carregar os detalhes da entrega:', error);
            });
    }

    async function generatePDF() {
        const {
            jsPDF
        } = window.jspdf;
        const modalContent = document.getElementById('modalContent');

        try {
            // Captura o conteúdo do modal
            const canvas = await html2canvas(modalContent);
            if (!canvas) {
                throw new Error('Erro ao criar o canvas.');
            }

            const imgData = canvas.toDataURL('image/png');
            const pdf = new jsPDF('p', 'mm', 'a4');
            const imgWidth = 210; // Largura A4 em mm
            const pageHeight = 295; // Altura A4 em mm
            const imgHeight = canvas.height * imgWidth / canvas.width;
            let heightLeft = imgHeight;

            let position = 0;

            // Adiciona a imagem ao PDF
            pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;

            // Adiciona páginas adicionais se necessário
            while (heightLeft > 0) {
                position = heightLeft - imgHeight;
                pdf.addPage();
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }

            // Abre o PDF em uma nova guia
            const pdfUrl = pdf.output('bloburl');
            window.open(pdfUrl, '_blank');
        } catch (err) {
            console.error('Erro ao gerar PDF:', err);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        console.log('html2canvas:', html2canvas);
    });

    $(document).ready(function() {
        $('#processar').on('click', function() {
            var tabelaDados = [];

            // Percorre cada linha da tabela
            $('#TabelaMedicamentos tbody tr').each(function() {
                var linha = [];

                // Percorre cada célula da linha
                $(this).find('td').each(function() {
                    linha.push($(this).text());
                });

                // Adiciona a linha ao array de dados da tabela
                tabelaDados.push(linha);
            });


            // Faz a requisição AJAX com os dados da tabela
            $.ajax({
                url: 'processamento.php',
                type: 'POST',
                data: {
                    dados: JSON.stringify(tabelaDados)
                }, // Serializa os dados em JSON
                success: function(response) {
                    try {
                        var dados = JSON.parse(response);
                        console.log('Resposta do servidor:', dados);
                    } catch (e) {
                        console.error('Erro ao processar JSON:', e);
                        console.log('Resposta do servidor:', response); // Exibe a resposta para depuração
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erro na requisição AJAX:', status, error);
                    console.log('Detalhes do erro:', xhr.responseText);
                }
            });
        });
    });
</script>