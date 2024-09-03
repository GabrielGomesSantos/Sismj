<?php
require_once('../../config/config.php');

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
                            <input type="text" class="form-control" id="nome_paciente" name="nome_paciente" placeholder="Nome:" required value="<?php echo htmlspecialchars($row['nome_paciente']); ?>">
                        </div>
                        <div class="form-group mb-4">
                            <input type="text" class="form-control" id="cpf_paciente" placeholder="CPF:" name="cpf_paciente" required value="<?php echo htmlspecialchars($row['cpf_paciente']); ?>">
                        </div>
                        <div class="form-group mb-4">
                            <input type="text" class="form-control" placeholder="CNS:" id="cns_paciente" name="cns_paciente" required value="<?php echo htmlspecialchars($row['cns_paciente']); ?>">
                        </div>
                        <div class="form-group mb-4">
                            <input type="text" class="form-control" placeholder="Logradouro" id="logradouro" name="logradouro" required value="<?php echo htmlspecialchars($row['logradouro']); ?>">
                        </div>
                        <div class="form-group mb-4">
                            <input type="text" class="form-control" placeholder="Número:" id="numero" name="numero" required value="<?php echo htmlspecialchars($row['numero']); ?>">
                        </div>
                        <div class="form-group mb-4">
                            <input type="text" class="form-control" placeholder="Complemento" id="complemento" name="complemento" value="<?php echo htmlspecialchars($row['complemento']); ?>">
                        </div>
                        <div class="form-group mb-4">
                            <input type="text" class="form-control" placeholder="Bairro:" id="bairro" name="bairro" required value="<?php echo htmlspecialchars($row['bairro']); ?>">
                        </div>
                        <div class="form-group mb-4">
                            <input type="text" class="form-control" placeholder="Cidade:" id="cidade" name="cidade" required value="<?php echo htmlspecialchars($row['cidade']); ?>">
                        </div>
                        <div class="form-group mb-4">
                            <input type="text" class="form-control" placeholder="CEF:" id="cep" name="cep" required value="<?php echo htmlspecialchars($row['cep']); ?>">
                        </div>
                        <div class="form-group mb-4">
                            <input type="text" class="form-control" placeholder="Estado:" id="estado" name="estado" required value="<?php echo htmlspecialchars($row['estado']); ?>">
                        </div>
                        <div class="form-group mb-4">
                            <input type="text" class="form-control" placeholder="Celular" id="celular" name="celular" required value="<?php echo htmlspecialchars($row['celular']); ?>">
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
