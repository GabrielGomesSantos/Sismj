$(document).ready(function() {
    console.log('Documento carregado. Associando o evento de mudança...');

    $('#DropDownNome').on('change', function() {
        var pacienteId = $(this).val();
        
        console.log('ID do paciente selecionado:', pacienteId);

        if (pacienteId) {
            $.ajax({
                url: 'buscar_processos.php',
                type: 'POST',
                data: { id: pacienteId },
                success: function(response) {
                    console.log('Resposta do servidor:', response);
                    
                    try {
                        var dados = JSON.parse(response);

                        // Verificando se os dados estão sendo recebidos corretamente
                        console.log('Dados processados:', dados);

                        // Acessa a lista de processos
                        var processos = dados.processos;

                        // Verificando os processos recebidos
                        console.log('Processos recebidos:', processos);

                        // Limpa o dropdown de processos
                        $('#codprocesso').empty();

                        // Adiciona uma opção de seleção padrão
                        $('#codprocesso').append('<option value="" disabled selected>Selecione o código do processo</option>');

                        // Preenche o dropdown com os processos recebidos
                        processos.forEach(function(processo) {
                            $('#codprocesso').append('<option value="' + processo + '">' + processo + '</option>');
                        });

                        // Acessa os dados da tabela
                        var dadosTabela = dados.dadosTabela;

                        console.log('Dados da tabela recebidos:', dadosTabela);

                        // Limpa a tabela antes de adicionar os novos dados
                        var tabelaCorpo = $('#tabela-processos tbody');
                        tabelaCorpo.empty();

                        // Adiciona as linhas na tabela
                        dadosTabela.forEach(function(item) {
                            var novaLinha = '<tr>' +
                                '<td>' + item.nome_medicamento + '</td>' +
                                '<td>' + item.tipo_medicamento + '</td>' +
                                '<td>' + item.laboratorio + '</td>' +
                                '<td>' + item.quantidade + '</td>' +
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
