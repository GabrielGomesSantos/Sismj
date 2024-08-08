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
    <title>Cadastro de Funcionario</title>
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
                                <h3>Cadastro de <strong>Funcionarios</strong></h3>
                                <p class="mb-4">Formulario para cadastrar Funcionarios</p>
                            </div>
                            <form action="cadastrar_funcionario.php" method="post">
                                <div class="form-group first mb-4">
                                    <label for="nome_funcionario">Nome:</label>
                                    <input type="text" class="form-control" id="nome_funcionario"
                                        name="nome_funcionario" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="cpf_funcionario">Cpf:</label>
                                    <input type="text" class="form-control" id="cpf_funcionario" name="cpf_funcionario"
                                        required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="matricula_funcionario">Matricula:</label>
                                    <input type="text" class="form-control" id="matricula_funcionario"
                                        name="matricula_funcionario" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="email_funcionario">Email:</label>
                                    <input type="email" class="form-control" id="email_funcionario"
                                        name="email_funcionario" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="senha_funcionario">Senha:</label>
                                    <input type="password" class="form-control" id="senha_funcionario"
                                        name="senha_funcionario" required>
                                </div>

                                <div class="form-group form-floating-label mt-2">

                                    <label for="perfil_funcionario">Perfil</label>
                                    <select class="form-select form-control" id="perfil_funcionario"
                                        name="perfil_funcionario" required>
                                        <option value="" selected disabled></option>
                                        <option value="1">Gestor</option>
                                        <option value="2">Atendente</option>
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

    <script src="../../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/main.js"></script>
    <?php include('footer.php')?>
</body>


</html>

<?php
require_once('D:/xampp/htdocs/Sismj/config/config.php');
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_funcionario = $_POST['nome_funcionario'];
    $cpf_funcionario = $_POST['cpf_funcionario'];
    $matricula_funcionario = $_POST['matricula_funcionario'];
    $email_funcionario = $_POST['email_funcionario'];
    $senha_funcionario = $_POST['senha_funcionario'];
    $perfil_funcionario = $_POST['perfil_funcionario'];


    $sql = "INSERT INTO funcionarios (nome_funcionario, cpf_funcionario, matricula, email_funcionario, senha, perfil) VALUES ('$nome_funcionario', '$cpf_funcionario', '$matricula_funcionario', '$email_funcionario', '$senha_funcionario', '$perfil_funcionario')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Funcionario Cadastrado');
        window.location.href='listar_funcionario.php'
      
        </script>";
    } else {
        echo "Erro ao cadastrar funcionario: " . $conn->error;
    }


   
}
