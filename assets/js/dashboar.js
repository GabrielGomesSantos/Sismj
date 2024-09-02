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

function fecharModal() {
    var modal = bootstrap.Modal.getInstance(document.getElementById('cadastromodal'));
    if (modal) {
        modal.hide();
    }
}


function confirmacao(){
    var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('confirmacaoModal'));
    modal.show();
}

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

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
                            var novaLinha = 
                            '<tr data-toggle="tooltip" data-placement="top" id="' + item.cod_medicamento_processo + '" >' +
                                '<td>' + item.nome_medicamento + '</td>' +
                                '<td>' + item.tipo_medicamento + '</td>' +
                                '<td>' + item.laboratorio + '</td>' +
                                '<td><input style="border: none;" class="number" type="number" min="1" value="' + item.quantidade + '" max="' + item.quantidade + '"></td>' +
                                '<td><button type="button" class="deletarButton" data-cod="' + item.cod_medicamento_processo + '">Deletar</button></td>' +
                            '</tr>';
                            tabelaCorpo.append(novaLinha);
                        });

                        //<button onclick="deletar_mediamento(' + item.cod_medicamento_processo +')" >TEste</button>

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
        var id = 0;
        $('#TabelaMedicamentos tbody tr').each(function() {
            var linha = [];
            
            // Obtém o valor do data-id do tr
            var id = $(this).attr('id');
            linha.push(id);
    
            $(this).find('td').each(function(index) {
                if (index === 3) {
                    linha.push($(this).find('input').val());
                } else {
                    linha.push($(this).text().trim());
                }
            });
    
            tabelaDados.push(linha);
        });
        
        console.log(tabelaDados);
    
        $.ajax({
            url: 'processamento.php',
            type: 'POST',
            data: { dados: JSON.stringify(tabelaDados) },
            success: function(response) {
                try {
                    var dados = JSON.parse(response);
                    console.log('Dados processados:', dados);
                
                    // Limpar classes de erro e mensagens anteriores
                    $('#TabelaMedicamentos tbody tr').removeClass('table-danger').find('td.text-danger').remove();
                
                    if (dados.status === 'erro' || dados.status === 'Faltando dados') {
                        console.log('Erros encontrados:', dados.erros);
                
                        dados.erros.forEach(function(erro) {
                            var linhaComErro = $('#TabelaMedicamentos tbody tr').filter(function() {
                                return $(this).attr('id') == erro.cod_medicamento;
                            });
                            
                            if (linhaComErro.length) {
                                linhaComErro.addClass('table-danger'); // Adiciona a classe de erro
                                linhaComErro.attr('data-title', erro.mensagem); // Define o atributo title                            
                            } else {
                                console.warn('Linha com erro não encontrada:', erro.cod_medicamento);
                            }
                        });
                
                    } else {
                        console.log("Salvando...");
                        var pacienteId = $('#DropDownNome').val();
                        var FuncionarioId = $('#cod_funcionario').val();;
                        var codProcesso = $('#codprocesso').val();
                        var observacao = $('#observacaomed').val(); // Use .val() para pegar o valor de um input ou textarea

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

                        var DadosEntrega = {
                            pacienteId: pacienteId,
                            funcionarioId: FuncionarioId,
                            codProcesso: codProcesso,
                            observacao: observacao, // Adicione observacao se for necessário
                            medicamentos: tabelaDados // Inclua medicamentos se for necessário
};

                        console.log('Status não há erro. Status recebido:', dados.status);
                        $.ajax({
                            url: 'salvar_entrega.php',
                            type: 'POST',
                            data: {dados: JSON.stringify(DadosEntrega)},
                            success: function(response) {
                                console.log('Resposta bruta do servidor (processamento):', response);

                                fecharModal();
                                confirmacao();
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


// PARTE DA SEARCH BAR INICIO 

// Função de pesquisa
function pesquisar(valor) {
    if (valor.length >= 3) {
        $.ajax({
            url: `../../src/pages/pesquisar_estoque.php`,
            type: 'GET',
            data: { valor: valor },
            dataType: 'json',
            success: function(dados) {
                let resultado = "<ul class='list-group position-fixed'>";

                if (dados.status) {
                    dados.dados.forEach(function(item) {
                        resultado += `<li onclick="listar_medicamentos('${item.nome}')" class='list-group-item list-group-item-action'>${item.nome}</li>`;
                    });
                } else {
                    resultado += `<li class='list-group-item disabled'>${dados.msg}</li>`;
                }

                resultado += "</ul>";

                // Atualize a interface com os resultados
                $('#search-addon').html(resultado);
            },
            error: function(xhr, status, error) {
                console.error('Erro na pesquisa:', status, error);
            }
        });
    } else {
        // Limpa a lista se a pesquisa for menor que 3 caracteres
        $('#search-addon').html('');
    }
}

// Função para listar medicamentos
function listar_medicamentos(nome) {
    $('#search_bar').val(nome);
    $('#search-addon').html(''); // Limpa a lista de sugestões ao selecionar um item
}

$(document).ready(function() {
    // Manipulador de eventos para o botão de pesquisa
    $('#search_button').on('click', function(e) {
        e.preventDefault(); // Evita o comportamento padrão do botão de envio
        var nome = $('#search_bar').val(); // Obtém o valor do campo de entrada
        listar_medicamentos(nome); // Chama a função de pesquisa com o valor do campo
    });

    // Limpar a lista de sugestões ao clicar fora da área de pesquisa
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#search_bar, #search-addon').length) {
            $('#search-addon').html('');
        }
    });
});

function searchMedicamento(){
    var nome = $('#search_bar').val()
    window.location.href = '../../src/pages/dashboard.php?pag=2&searchMed=' + nome;
}



// Função de pesquisa Entrega 


function pesquisar_entrega(valor) {
    if (valor.length >= 3) {
        $.ajax({
            url: `../../src/pages/pesquisar_entrega.php`,
            type: 'GET',
            data: { valor: valor },
            dataType: 'json',
            success: function(dados) {
                let resultado = "<ul class='list-group position-fixed'>";
                console.log(dados);

                if (dados.status) {
                    dados.dados.forEach(function(item) {
                        resultado += `<li onclick="listar_entregas('${item.nome}')" class='list-group-item list-group-item-action'>${item.nome}</li>`;
                    });
                } else {
                    resultado += `<li class='list-group-item disabled'>${dados.msg}</li>`;
                }

                resultado += "</ul>";

                // Atualize a interface com os resultados
                $('#search-addon-entregas').html(resultado);
            },
            error: function(xhr, status, error) {
                console.error('Erro na pesquisa:', status, error);
            }
        });
    } else {
        // Limpa a lista se a pesquisa for menor que 3 caracteres
        $('#search-addon-entregas').html('');
    }
}

// Função para listar medicamentos
function listar_entregas(nome) {
    $('#search_bar_entrega').val(nome);
    $('#search-addon-entregas').html(''); // Limpa a lista de sugestões ao selecionar um item
}

$(document).ready(function() {
    // Manipulador de eventos para o botão de pesquisa
    $('#search_button').on('click', function(e) {
        e.preventDefault(); // Evita o comportamento padrão do botão de envio
        var nome = $('#search_bar_entrega').val(); // Obtém o valor do campo de entrada
        listar_entregas(nome); // Chama a função de pesquisa com o valor do campo
    });

    // Limpar a lista de sugestões ao clicar fora da área de pesquisa
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#search_bar_entrega, #search-addon-entregas').length) {
            $('#search-addon-entregas').html('');
        }
    });
});

function searchEntregas(){
    var valor = $('#search_bar_entrega').val();
    window.location.href = '../../src/pages/dashboard.php?pag=1&search=' + valor;
}

//  toggleActive button

function toggleActive() {
    var button = document.querySelector('.sair');
    button.classList.toggle('active');
};

// Função de Deletar Medicamento
$(document).ready(function() {
    // Usa delegação de eventos para lidar com elementos dinâmicos
    $(document).on('click', '.deletarButton', function(event) {
        // Impede o comportamento padrão do botão, como submissão de formulário
        event.preventDefault();

        // Obtém o valor do atributo data-cod do botão clicado
        var cod = $(this).data('cod');

        // Remover a linha da tabela HTML que possui o ID correspondente
        $('#TabelaMedicamentos tbody tr').each(function() {
            var id = $(this).attr('id');
            if (id == cod) {
                alert("Igual é: " + cod);
                $(this).remove(); // Remove a linha da tabela
            }
        });
    });
});
