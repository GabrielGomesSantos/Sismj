<?php
require_once('D:/xampp/htdocs/Sismj/config/config.php');

if (isset($_GET['id_paciente'])) {
    $id_paciente = intval($_GET['id_paciente']);

    $sql = "SELECT * FROM pacientes WHERE cod_paciente = '$id_paciente'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Paciente não encontrado.";
        exit();
    }
} else {
    echo "ID do paciente não fornecido.";
    exit();
}
?>

<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- Required meta tags -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->

    <!-- Style -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Style -->

    <!-- Fonte Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Fonte Awesome -->
    
    <!-- Titulo Lembrar de mudar! -->
    <link rel="shortcut icon" href="../../assets/images/favico.ico">
    <title>Edição de Paciente</title>
</head>

<?php include('navbar.php')?>

<body>
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 contents">
                    <div class="mb-4">
                        <h3>Edição de <strong>Paciente</strong></h3>
                        <p class="mb-4">Formulário para editar paciente</p>
                    </div>
                    <form action="process_update_paciente.php" method="post">
                        <input type="hidden" name="cod_paciente" value="<?php echo htmlspecialchars($row['cod_paciente']); ?>">
                        
                        <div class="form-group first mb-4">
                            <label for="nome_paciente">Nome:</label>
                            <input type="text" class="form-control" id="nome_paciente" name="nome_paciente" required value="<?php echo htmlspecialchars($row['nome_paciente']); ?>">
                        </div>
                        <div class="form-group mb-4">
                            <label for="cpf_paciente">CPF:</label>
                            <input type="text" class="form-control" id="cpf_paciente" name="cpf_paciente" required value="<?php echo htmlspecialchars($row['cpf_paciente']); ?>">
                        </div>
                        <div class="form-group mb-4">
                            <label for="cns_paciente">CNS:</label>
                            <input type="text" class="form-control" id="cns_paciente" name="cns_paciente" required value="<?php echo htmlspecialchars($row['cns_paciente']); ?>">
                        </div>
                        <div class="form-group mb-4">
                            <label for="logradouro">Logradouro:</label>
                            <input type="text" class="form-control" id="logradouro" name="logradouro" required value="<?php echo htmlspecialchars($row['logradouro']); ?>">
                        </div>
                        <div class="form-group mb-4">
                            <label for="numero">Número:</label>
                            <input type="text" class="form-control" id="numero" name="numero" required value="<?php echo htmlspecialchars($row['numero']); ?>">
                        </div>
                        <div class="form-group mb-4">
                            <label for="complemento">Complemento:</label>
                            <input type="text" class="form-control" id="complemento" name="complemento" value="<?php echo htmlspecialchars($row['complemento']); ?>">
                        </div>
                        <div class="form-group mb-4">
                            <label for="bairro">Bairro:</label>
                            <input type="text" class="form-control" id="bairro" name="bairro" required value="<?php echo htmlspecialchars($row['bairro']); ?>">
                        </div>
                        <div class="form-group mb-4">
                            <label for="cidade">Cidade:</label>
                            <input type="text" class="form-control" id="cidade" name="cidade" required value="<?php echo htmlspecialchars($row['cidade']); ?>">
                        </div>
                        <div class="form-group mb-4">
                            <label for="cep">CEP:</label>
                            <input type="text" class="form-control" id="cep" name="cep" required value="<?php echo htmlspecialchars($row['cep']); ?>">
                        </div>
                        <div class="form-group mb-4">
                            <label for="estado">Estado:</label>
                            <input type="text" class="form-control" id="estado" name="estado" required value="<?php echo htmlspecialchars($row['estado']); ?>">
                        </div>
                        <div class="form-group mb-4">
                            <label for="celular">Celular:</label>
                            <input type="text" class="form-control" id="celular" name="celular" required value="<?php echo htmlspecialchars($row['celular']); ?>">
                        </div>
                        
                        <input type="submit" value="Salvar Alterações" class="btn text-white btn-block btn-info mt-5">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/main.js"></script>
    <?php include('footer.php')?>
</body>

</html>
