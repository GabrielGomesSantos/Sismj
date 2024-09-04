<?php
require_once('../../config/config.php');

// Função para obter resultados de uma consulta
function getResults($conn, $sql)
{
    $result = $conn->query($sql);
    if ($result === FALSE) {
        echo "Erro ao executar a consulta: " . $conn->error;
        return [];
    }
    return $result->fetch_all(MYSQLI_ASSOC);
}

$pacientes = getResults($conn, "SELECT * FROM pacientes");
$medicos = getResults($conn, "SELECT * FROM medicos");



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $num_processo = $_POST['num_processo'];
    $cod_paciente = $_POST['cod_paciente'];
    $cod_medico = $_POST['cod_medico'];

    $teste = $num_processo;

    $copia_processo = $_FILES['copia_processo']['name'];
    $receita_processo = $_FILES['receita_processo']['name'];


   $caminho = "../../arquivos/" . $teste;
    
    mkdir($caminho, 0722, true);
    $destino_copia = $caminho . "/" . $copia_processo;
    $destino_receita = $caminho . "/" . $receita_processo;

    move_uploaded_file($_FILES['copia_processo']['tmp_name'], $destino_copia);
    move_uploaded_file($_FILES['receita_processo']['tmp_name'], $destino_receita);
    
    $sql = "INSERT INTO processos (numero_processo, cod_paciente, copia_processo, receita, cod_medico) 
            VALUES ('$num_processo', '$cod_paciente', '$destino_copia', '$destino_receita', '$cod_medico')";

    if ($conn->query($sql)) {
       echo '<script>
                alert("Processo Cadastrado");
                window.location.href="dashboard.php?pag=1"
            </script>';
    } else {
        echo "Erro na inserção: " . $conn->error;
    }
}
?>
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 contents">
                    <div class="mb-4">
                        <h3>Cadastro de <strong>Processo</strong></h3>
                        <p class="mb-4">Formulário para cadastrar processos</p>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="num_processo">Número do Processo:</label>
                            <input type="text" class="form-control" id="num_processo" name="num_processo" required>
                        </div>
                        <label for="copia_processo">Cópia do Processo:</label>
                        <div class="form-group">
                            <input type="file" class="form-control" id="copia_processo" name="copia_processo" required>
                        </div>
                        <label for="receita_processo">Receita do Processo:</label>
                        <div class="form-group">
                            <input type="file" class="form-control" id="receita_processo" name="receita_processo"
                                required>
                        </div>
                        <label for="cod_paciente">Selecione o Paciente:</label>
                        <div class="form-group">
                            <select class="form-select form-control" id="cod_paciente" name="cod_paciente" required>
                                <option value="" selected disabled>Selecione um paciente</option>
                                <?php foreach ($pacientes as $paciente): ?>
                                    <option value="<?php echo htmlspecialchars($paciente['cod_paciente']); ?>">
                                        <?php echo htmlspecialchars($paciente['nome_paciente']); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                        </div>
                        <label for="cod_paciente">Selecione o Médico:</label>
                        <div class="form-group">
                            <select class="form-select form-control" id="cod_paciente" name="cod_medico" required>
                                <option value="" selected disabled>Selecione um médico</option>
                                <?php foreach ($medicos as $medico): ?>
                                    <option value="<?php echo htmlspecialchars($medico['cod_medico']); ?>">
                                        <?php echo htmlspecialchars($medico['nome_medico']); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                        </div>
        

                        <input type="submit" value="Cadastrar" class="btn text-white btn-block btn-info mt-5">
                    </form>
                </div>
            </div>
        </div>
    </div>