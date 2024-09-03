<?php
require_once('../../config/config.php');
if (isset($_GET['id_medico'])) {
    $id_medico = intval($_GET['id_medico']);  

    $sql = "SELECT * FROM medicos WHERE cod_medico = '$id_medico'";

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
    <title>Edição de medico</title>
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
                                <h3>Edição de <strong>medicos</strong></h3>
                                <p class="mb-4">Formulario para editar medicos</p>
                            </div>
                            <form action="process_medico.php" method="post">
                                <div class="form-group first mb-4">
                                    <input type="hidden" class="form-control" id="cod_medico"
                                        name="cod_medico" value="<?php echo $row['cod_medico'] ?>">
                                </div>
                                <div class="form-group first mb-4">
                                    <input type="text" class="form-control" id="nome_medico"placeholder="Nome:"
                                        name="nome_medico" required value="<?php echo $row['nome_medico'] ?>">
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control" id="cpf_medico" name="cpf_medico" placeholder="CPF:"
                                        required value="<?php echo $row['cpf_medico'] ?>">
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control" id="crm"placeholder="CRM:"
                                        name="crm" required value="<?php echo $row['crm'] ?>">
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control" id="especialidade"placeholder="Especialidade:"
                                        name="especialidade" required value="<?php echo $row['especialidade'] ?>">
                                </div>
                                <div class="form-group mb-4">
                                    <input type="password" class="form-control" id="celular"placeholder="Celular:"
                                        name="celular" required value="<?php echo $row['celular'] ?>">
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
