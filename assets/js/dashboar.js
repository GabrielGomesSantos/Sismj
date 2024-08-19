$(document).ready(function() {
    $('#DropDownNome').on('change', function() {
        var pacienteId = $(this).val();
        var tabelaCorpo = $('#TabelaMedicamentos tbody');
        tabelaCorpo.empty();

        if (pacienteId) {
            $.ajax({
                url: 'buscar_processos.php',
                type: 'POST',
                data: { id: pacienteId },
                success: function(response) {
                    try {
                        var dados = JSON.parse(response);

                        var $dropdown = $('#codprocesso');
                        $dropdown.empty().append('<option value="" disabled selected>Selecione o código do processo</option>');

                        dados.processos.forEach(function(processo) {
                            $dropdown.append(`<option value="${processo['cod_processo']}">${processo['numero_processo']}</option>`);
                        });
                    } catch (e) {
                        console.error('Erro ao processar JSON (buscar_processos.php):', e);
                        console.log('Resposta do servidor (buscar_processos.php):', response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erro na requisição AJAX (buscar_processos.php):', status, error);
                    console.log('Detalhes do erro:', xhr.responseText);
                }
            });
        }
    });

    $('#codprocesso').on('change', function() {
        var codProcesso = $(this).val();
        
        if (codProcesso) {
            $.ajax({
                url: 'buscar_medicamentos.php',
                type: 'POST',
                data: { id: codProcesso },
                success: function(response) {
                    try {
                        var dados = JSON.parse(response);

                        var tabelaCorpo = $('#TabelaMedicamentos tbody');
                        tabelaCorpo.empty();

                        dados.dadosTabela.forEach(function(item) {
                            var novaLinha = '<tr data-id="' + item.cod_medicamento_processo + '">' +
                                '<td>' + item.nome_medicamento + '</td>' +
                                '<td>' + item.tipo_medicamento + '</td>' +
                                '<td>' + item.laboratorio + '</td>' +
                                '<td><input style="border: none;" class="number" type="number" min="1" value="' + item.quantidade + '" max="' + item.quantidade + '"></td>' +
                            '</tr>';
                            tabelaCorpo.append(novaLinha);
                        });

                    } catch (e) {
                        console.error('Erro ao processar JSON (buscar_medicamentos.php):', e);
                        console.log('Resposta do servidor (buscar_medicamentos.php):', response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erro na requisição AJAX (buscar_medicamentos.php):', status, error);
                    console.log('Detalhes do erro:', xhr.responseText);
                }
            });
        }
    });

    $('#processar').on('click', function() {
        var tabelaDados = [];
    
        $('#TabelaMedicamentos tbody tr').each(function() {
            var linha = [];
            
            $(this).find('td').each(function(index) {
                if (index === 3) {
                    linha.push($(this).find('input').val());
                } else {
                    linha.push($(this).text().trim());
                }
            });
    
            tabelaDados.push(linha);
        });
    
        $.ajax({
            url: 'processamento.php',
            type: 'POST',
            data: { dados: JSON.stringify(tabelaDados) },
            success: function(response) {
                console.log('Resposta bruta do servidor (processamento):', response);
                try {
                    var dados = JSON.parse(response);
                    console.log('Dados processados:', dados);
                
                    // Limpar classes de erro e mensagens anteriores
                    $('#TabelaMedicamentos tbody tr').removeClass('table-danger').find('td.text-danger').remove();
                
                    if (dados.status === 'erro') {
                        console.log('Erros encontrados:', dados.erros);
                
                        dados.erros.forEach(function(erro) {
                            var linhaComErro = $('#TabelaMedicamentos tbody tr').filter(function() {
                                return $(this).data('id') == erro.cod_medicamento;
                            });
                            
                            if (linhaComErro.length) {
                                linhaComErro.addClass('table-danger'); // Adiciona a classe de erro
                            } else {
                                console.warn('Linha com erro não encontrada:', erro.cod_medicamento);
                            }
                        });
                
                    } else {
                        var pacienteId = $('#DropDownNome').val();
                        var FuncionarioId = $('#codFuncionario').val();;
                        var codProcesso = $('#codprocesso').val();
                        var observacao = $('#observacaomed').val(); // Use .val() para pegar o valor de um input ou textarea

                        var medicamentos = $('#medicamentos').val(); // Supondo que você tenha um seletor válido

                        var DadosEntrega = {
                            pacienteId: pacienteId,
                            funcionarioId: FuncionarioId,
                            codProcesso: codProcesso,
                            observacao: observacao, // Adicione observacao se for necessário
                            medicamentos: medicamentos // Inclua medicamentos se for necessário
};

                        console.log('Status não há erro. Status recebido:', dados.status);
                        $.ajax({
                            url: 'salvar_entrega.php',
                            type: 'POST',
                            data: {dados: JSON.stringify(DadosEntrega)},
                            success: function(response) {
                                console.log('Resposta bruta do servidor (processamento):', response);

                            }
                        })
                    }
                
                } catch (e) {
                    console.error('Erro ao processar JSON:', e);
                    console.log('Resposta do servidor:', response);
                }
                
            },
            error: function(xhr, status, error) {
                console.error('Erro na requisição AJAX (processamento):', status, error);
                console.log('Detalhes do erro:', xhr.responseText);
            }
        });
    });
});
