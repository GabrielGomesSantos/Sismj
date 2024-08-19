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

                        if (dados.processos && Array.isArray(dados.processos)) {
                            dados.processos.forEach(function(processo) {
                                $dropdown.append(`<option value="${processo['cod_processo']}">${processo['numero_processo']}</option>`);
                            });
                        } else {
                            console.error('Resposta inesperada do servidor (buscar_processos.php):', dados);
                        }
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

                        if (dados.dadosTabela && Array.isArray(dados.dadosTabela)) {
                            dados.dadosTabela.forEach(function(item) {
                                var novaLinha = '<tr data-id="' + item.cod_medicamento_processo + '">' +
                                    '<td>' + item.nome_medicamento + '</td>' +
                                    '<td>' + item.tipo_medicamento + '</td>' +
                                    '<td>' + item.laboratorio + '</td>' +
                                    '<td><input style="border: none;" class="number" type="number" min="1" value="' + item.quantidade + '" max="' + item.quantidade + '"></td>' +
                                '</tr>';
                                tabelaCorpo.append(novaLinha);
                            });
                        } else {
                            console.error('Resposta inesperada do servidor (buscar_medicamentos.php):', dados);
                        }
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

        var pacienteId = $('#DropDownNome').val();
        var FuncionarioId = $('#cod_funcionario').val();
        var codProcesso = $('#codprocesso').val();
        var observacao = $('#observacaomed').val(); // Use .val() para pegar o valor de um input ou textarea

        // Certifique-se de que a variável medicamentos está definida
        var medicamentos = tabelaDados; // Assumindo que você quer usar tabelaDados como medicamentos
        
        var DadosEntrega = {
            pacienteId: pacienteId,
            funcionarioId: FuncionarioId,
            codProcesso: codProcesso,
            observacao: observacao,
            medicamentos: medicamentos
        };

        $.ajax({
            url: 'salvar_entrega.php',
            type: 'POST',
            data: { dados: JSON.stringify(DadosEntrega) },
            success: function(response) {
                console.log('Resposta bruta do servidor (salvar_entrega.php):', response);
            },
            error: function(xhr, status, error) {
                console.error('Erro na requisição AJAX (salvar_entrega.php):', status, error);
                console.log('Detalhes do erro:', xhr.responseText);
            }
        });
    });
});
