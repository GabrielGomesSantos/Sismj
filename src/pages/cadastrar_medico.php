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
    <title>Cadastro de medico</title>
</head>

<?php include('navbar.php')?>

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
                            <form action="cadastrar_medico.php" method="post">
                                <div class="form-group first mb-4">
                                    <label for="nome_medico">Nome:</label>
                                    <input type="text" class="form-control" id="nome_medico"
                                        name="nome_medico" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="cpf_medico">Cpf:</label>
                                    <input type="text" class="form-control" id="cpf_medico" name="cpf_medico"
                                        required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="crm">CRM:</label>
                                    <input type="text" class="form-control" id="crm"
                                        name="crm" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="especialidade">Especialidade:</label>
                                    <input type="text" class="form-control" id="especialidade"
                                        name="especialidade" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="celular">Celular:</label>
                                    <input type="text" class="form-control" id="celular"
                                        name="celular" required>
                                </div>
                                <input type="submit" value="Cadastrar" class="btn text-white btn-block btn-info mt-5">
                            </form>
                        </div>
                    </div>
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

<?php
require_once('C:/xampp/htdocs/Sismj/config/config.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_medico = $_POST['nome_medico'];
    $cpf_medico = $_POST['cpf_medico'];
    $crm = $_POST['crm'];
    $especialidade = $_POST['especialidade'];
    $celular = $_POST['celular'];


    $sql = "INSERT INTO medicos (nome_medico, cpf_medico, crm, especialidade, celular) VALUES ('$nome_medico', '$cpf_medico', '$crm', '$especialidade', '$celular')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('medico Cadastrado');
        window.location.href='listar_medico.php'
      
        </script>";
    } else {
        echo "Erro ao cadastrar medico: " . $conn->error;
    }


   
}
