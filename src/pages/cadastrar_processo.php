<?php
require_once('D:/xampp/htdocs/Sismj/config/config.php');

// Fix table names
$sql_paciente = "SELECT * FROM pacientes";
$result_paciente = $conn->query($sql_paciente);
if ($result_paciente === FALSE) {
    echo "Error executing query for pacientes: " . $conn->error;
}

$sql_medico = "SELECT * FROM medicos";
$result_medico = $conn->query($sql_medico);
if ($result_medico === FALSE) {
    echo "Error executing query for medicos: " . $conn->error;
}
?>



<body>
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Cadastro de <strong>medicos</strong></h3>
                                <p class="mb-4">Formulario para cadastrar medicos</p>
                            </div>
                            <form action="cadastrar_processo.php" method="post">
                                <div class="form-group first mb-4">
                                    <label for="nome_medico">Número do Processo:</label>
                                    <input type="text" class="form-control" id="num_processo" name="num_processo" required>
                                </div>
                                <div class="form-group first mb-4">
                                    <label for="nome_medico">Cópia do Processo:</label>
                                    <input type="text" class="form-control" id="num_processo" name="copia_processo" required>
                                </div>
                                <div class="form-group first mb-4">
                                    <label for="nome_medico">Receita do Processo:</label>
                                    <input type="text" class="form-control" id="num_processo" name="receita_processo" required>
                                </div>
                                <div class="form-group form-floating-label mt-2">
                                    <label for="">Selecione o Paciente</label>
                                    <select class="form-select form-control" name="cod_paciente" required>
                                        <?php if($result_paciente->num_rows > 0): ?>
                                            <option value="" selected disabled>Selecione um paciente</option>
                                            <?php while($row = $result_paciente->fetch_assoc()): ?>
                                                <option value="<?php echo $row['cod_paciente']; ?>"><?php echo $row['nome_paciente']; ?></option>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <option value="" disabled>Nenhum paciente encontrado</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="form-group form-floating-label mt-2">
                                    <label for="">Selecione o Médico</label>
                                    <select class="form-select form-control" name="cod_medico" required>
                                        <?php if($result_medico->num_rows > 0): ?>
                                            <option value="" selected disabled>Selecione um médico</option>
                                            <?php while($row = $result_medico->fetch_assoc()): ?>
                                                <option value="<?php echo $row['cod_medico']; ?>"><?php echo $row['nome_medico']; ?></option>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <option value="" disabled>Nenhum médico encontrado</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <input type="submit" value="Cadastrar" class="btn text-white btn-block btn-info mt-5">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $num_processo = $_POST['num_processo'];
    $copia_processo = $_POST['copia_processo'];
    $receita_processo = $_POST['receita_processo'];
    $cod_paciente = $_POST['cod_paciente'];
    $cod_medico = $_POST['cod_paciente'];
    $sql = "INSERT INTO `processos`(`numero_processo`, `cod_paciente`, `copia_processo`, `receita`, `cod_medico`) VALUES ('$num_processo','$cod_paciente','$copia_processo','$receita_processo','$cod_medico')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Processo Cadastrado');
        window.location.href='listar_processos.php'
      
        </script>";
    } else {
        echo "Erro ao cadastrar funcionario: " . $conn->error;
    }
}
