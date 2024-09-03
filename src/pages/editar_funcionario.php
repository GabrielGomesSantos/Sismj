<?php
require_once('../../config/config.php');
if (isset($_GET['id_funcionario'])) {
    $id_funcionario = intval($_GET['id_funcionario']);  

    $sql = "SELECT * FROM funcionarios WHERE cod_funcionario = '$id_funcionario'";

    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){

        

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
    <title>Edição de Funcionario</title>
</head>

<?php include('navbar.php')?>

<body>
<body>
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Edição de <strong>Funcionarios</strong></h3>
                                <p class="mb-4">Formulario para editar Funcionarios</p>
                            </div>
                            <form action="process_funcionario.php" method="post">
                                <div class="form-group first mb-4">
                                    <input type="hidden" class="form-control" id="cod_funcionario"
                                        name="cod_funcionario" value="<?php echo $row['cod_funcionario'] ?>">
                                </div>
                                <div class="form-group first mb-4">
                                    
                                    <input type="text" class="form-control" id="nome_funcionario"
                                        name="nome_funcionario" required value="<?php echo $row['nome_funcionario'] ?>" placeholder="Nome:">
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control" id="cpf_funcionario" name="cpf_funcionario" placeholder="CPF:"
                                        required value="<?php echo $row['cpf_funcionario'] ?>">
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control" id="matricula_funcionario"placeholder="Matricula"
                                        name="matricula_funcionario" required value="<?php echo $row['matricula'] ?>">
                                </div>
                                <div class="form-group mb-4">
                                    <input type="email" class="form-control" id="email_funcionario"placeholder="E-mail"
                                        name="email_funcionario" required value="<?php echo $row['email_funcionario'] ?>">
                                </div>
                                <div class="form-group mb-4">
                                    <input type="password" class="form-control" id="senha_funcionario"placeholder="Senha:"
                                        name="senha_funcionario" required value="<?php echo $row['senha'] ?>">
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
                                <input type="submit" value="Editar" class="btn text-white btn-block btn-info mt-5">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        }
    
    }

}
    
    
    ?>


    <script src="../../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/main.js"></script>
    <?php include('footer.php')?>
</body>


</html>
