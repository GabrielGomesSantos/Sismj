<?php
require_once('C:/xampp/htdocs/Sismj/config/config.php');

// Função para obter resultados de uma consulta
function getResults($conn, $sql) {
    $result = $conn->query($sql);
    if ($result === FALSE) {
        echo "Erro ao executar a consulta: " . $conn->error;
        return [];
    }
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Consulta para obter pacientes, médicos e medicamentos
$pacientes = getResults($conn, "SELECT * FROM pacientes");
$medicos = getResults($conn, "SELECT * FROM medicos");
$medicamentos = getResults($conn, "SELECT * FROM medicamentos");

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $num_processo = $_POST['num_processo'];
    $cod_paciente = $_POST['cod_paciente'];
    $cod_medico = $_POST['cod_medico'];
    
    // Processar arquivos
    $copia_processo = $_FILES['copia_processo']['name'];
    $receita_processo = $_FILES['receita_processo']['name'];

    $upload_dir = 'uploads/';
    move_uploaded_file($_FILES['copia_processo']['tmp_name'], $upload_dir . $copia_processo);
    move_uploaded_file($_FILES['receita_processo']['tmp_name'], $upload_dir . $receita_processo);
    
    // Inserir dados no banco de dados
    $stmt = $conn->prepare("INSERT INTO processos (numero_processo, cod_paciente, copia_processo, receita_processo, cod_medico) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $num_processo, $cod_paciente, $copia_processo, $receita_processo, $cod_medico);

    if ($stmt->execute()) {
        echo "<script>
        alert('Processo Cadastrado');
        window.location.href='listar_processos.php';
        </script>";
    } else {
        echo "Erro ao cadastrar processo: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Processo</title>
    <link rel="stylesheet" href="path/to/bootstrap.css">
    <style>
       <style>
    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-select {
        width: 100%;
        padding: 10px;
        font-size: 16px;
    }

    .form-check {
        margin-bottom: 10px;
    }
</style>

    </style>
</head>
<body>
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
                        <div class="form-group">
                            <label for="copia_processo">Cópia do Processo:</label>
                            <input type="file" class="form-control" id="copia_processo" name="copia_processo" required>
                        </div>
                        <div class="form-group">
                            <label for="receita_processo">Receita do Processo:</label>
                            <input type="file" class="form-control" id="receita_processo" name="receita_processo" required>
                        </div>
                        <div class="form-group">
                            <label for="cod_paciente">Selecione o Paciente:</label>
                            <select class="form-select form-control" id="cod_paciente" name="cod_paciente" required>
                                <option value="" selected disabled>Selecione um paciente</option>
                                <?php foreach ($pacientes as $paciente): ?>
                                    <option value="<?php echo htmlspecialchars($paciente['cod_paciente']); ?>">
                                        <?php echo htmlspecialchars($paciente['nome_paciente']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cod_medico">Selecione o Médico:</label>
                            <select class="form-select form-control" id="cod_medico" name="cod_medico" required>
                                <option value="" selected disabled>Selecione um médico</option>
                                <?php foreach ($medicos as $medico): ?>
                                    <option value="<?php echo htmlspecialchars($medico['cod_medico']); ?>">
                                        <?php echo htmlspecialchars($medico['nome_medico']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Selecione os Medicamentos:</label>
                            <div id="medicamentos">
                                <?php foreach ($medicamentos as $medicamento): ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="<?php echo htmlspecialchars($medicamento['cod_medicamento']); ?>" id="medicamento_<?php echo htmlspecialchars($medicamento['cod_medicamento']); ?>" name="medicamentos[]">
                                        <label class="form-check-label" for="medicamento_<?php echo htmlspecialchars($medicamento['cod_medicamento']); ?>">
                                            <?php echo htmlspecialchars($medicamento['nome_medicamento']); ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <input type="submit" value="Cadastrar" class="btn text-white btn-block btn-info mt-5">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="path/to/bootstrap.js"></script>
</body>
</html>

