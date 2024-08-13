<?php
include('../../config/config.php');

// Verificar se o parâmetro 'cod_entrega' foi passado
if (isset($_GET['cod_entrega'])) {
    $cod_entrega = $_GET['cod_entrega'];

    // Preparar e executar a consulta para buscar os detalhes da entrega
    $query = "SELECT * FROM entregas WHERE cod_entrega = ?";
    
    // Preparar a consulta
    if ($stmt = mysqli_prepare($conn, $query)) {
        // Vincular o parâmetro
        mysqli_stmt_bind_param($stmt, "s", $cod_entrega);

        // Executar a consulta
        mysqli_stmt_execute($stmt);

        // Obter o resultado
        $result = mysqli_stmt_get_result($stmt);

        // Buscar os dados da entrega
        $entrega = mysqli_fetch_assoc($result);

        if ($entrega) {
            // Retornar os dados da entrega em HTML
            echo " <h4 class='text-secondary'>PACIENTE</h4>
                    <div class='border-top border-secondary p-2'> 
                    <label for='codigo-entrega' class='form-label'> Código da Entrega:</label> 
                    <input type='text' name='codigo-entrega' class='form-control ' disabled value=" . htmlspecialchars($entrega['cod_entrega']). ">
                    <label for='nome-paciente'> Nome do paciente: </label>
                    <input type='text' name='nome-paciente' class='form-control' disabled value='codigo-nome-do-paciente-aqui'>
                    <label for='cpf-paciente'>CPF:</label>
                    <input type='text' name='cpf-paciente' class='form-control' disabled value='codigo-cpf-aqui'>
                    <label for='processo-paciente'>Processo:</label>
                    <input type='text' name='processo-paciente' class='form-control' disabled value='processo-aqui'>
                    </div>
                    <h4 class='text-secondary'> Medicamentos </h4>
                    <div class='border-top border-secondary'>
                    <table class='table mt-5 '>
                    <thead class='thead-light'>
                 
                    <th>Medicamento</th>
                    <th>Tipo</th>
                    <th>Categoria</th>
                    <th>Laboratorio</th>
                    <th>Qnts</th>
                 
                    </thead>
                    </table>
                    
                
                    </div>
                    <h4 class='text-secondary'>Entrega</h4>
                    <div class='border-top border-secondary p-2'> 
                    <label for='data-entrega' class='form-label'> Data Entrega:</label> 
                    <input type='text' name='data-entrega' class='form-control ' disabled value='data-entrega-aqui'>
                    <label for='nome-funcionario'> Nome do paciente: </label>
                    <input type='text' name='nome-funcionario' class='form-control' disabled value='nome-do-funcionario'>
                    
                    </div>
                    ";
        } else {
            echo "<p>Entrega não encontrada.</p>";
        }

        // Fechar a declaração
        mysqli_stmt_close($stmt);
    } else {
        echo "<p>Erro ao preparar a consulta.</p>";
    }

    // Fechar a conexão
    mysqli_close($conn);
} else {
    echo "<p>Código da entrega não especificado.</p>";
}
?>
