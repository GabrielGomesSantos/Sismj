<?php
require_once('../../config/config.php');

if (isset($_GET['id_processo'])) {
    $id_processo = intval($_GET['id_processo']); // Converte para inteiro para segurança

    // Prepara a consulta SQL para evitar SQL Injection
    $stmt = $conn->prepare("SELECT * FROM processos WHERE cod_processo = ?");
    $stmt->bind_param('i', $id_processo);
    $stmt->execute();
    $result = $stmt->get_result();

    // Consulta para obter pacientes e médicos
    $sql_paciente = "SELECT cod_paciente, nome_paciente FROM pacientes";
    $result_paciente = $conn->query($sql_paciente);

    $sql_medico = "SELECT cod_medico, nome_medico FROM medicos";
    $result_medico = $conn->query($sql_medico);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../../assets/images/favico.ico">
    <title>Cadastro de Processo</title>
</head>

<body>
    <?php include('navbar.php')?>
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 contents">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <div class="mb-4">
                                <h3>Atualizar <strong>Processo</strong></h3>
                                <p class="mb-4">Formulário para atualizar processos</p>
                            </div>
                            <form action="process_form.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_processo" value="<?php echo htmlspecialchars($row['cod_processo']); ?>">
                                <div class="form-group">
                                    <label for="num_processo">Número do Processo:</label>
                                    <input type="text" class="form-control" id="num_processo" name="num_processo" value="<?php echo htmlspecialchars($row['numero_processo']); ?>" required>
                                </div>
                                <label for="copia_processo">Cópia do Processo:</label>
                                <div class="form-group">
                                    <input type="file" class="form-control" id="copia_processo" name="copia_processo">
                                </div>
                                <label for="receita_processo">Receita do Processo:</label>
                                <div class="form-group">
                                    <input type="file" class="form-control" id="receita_processo" name="receita_processo">
                                </div>
                                <label for="cod_paciente">Selecione o Paciente:</label>
                                <div class="form-group">
                                    <select class="form-select form-control" id="cod_paciente" name="cod_paciente" required>
                                        <option value="" disabled>Selecione um paciente</option>
                                        <?php while ($paciente = $result_paciente->fetch_assoc()): ?>
                                            <option value="<?php echo htmlspecialchars($paciente['cod_paciente']); ?>" <?php echo $paciente['cod_paciente'] == $row['cod_paciente'] ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($paciente['nome_paciente']); ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <label for="cod_medico">Selecione o Médico:</label>
                                <div class="form-group">
                                    <select class="form-select form-control" id="cod_medico" name="cod_medico" required>
                                        <option value="" disabled>Selecione um médico</option>
                                        <?php while ($medico = $result_medico->fetch_assoc()): ?>
                                            <option value="<?php echo htmlspecialchars($medico['cod_medico']); ?>" <?php echo $medico['cod_medico'] == $row['cod_medico'] ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($medico['nome_medico']); ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <input type="submit" value="Atualizar" class="btn text-white btn-block btn-info mt-5">
                            </form>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>Processo não encontrado.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/main.js"></script>
</body>

</html>

<?php
    $stmt->close();
    $conn->close();
}
?>
    