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
    <title>Cadastro de paciente</title>
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
                                <h3>Cadastro de <strong>Pacientes</strong></h3>
                                <p class="mb-4">Formulario para cadastrar Pacientes</p>
                            </div>
                            <form action="processar_cadastro_paciente.php" method="post">
                                <div class="form-group first mb-4">
                                    <label for="nome_paciente">Nome:</label>
                                    <input type="text" class="form-control" id="nome_paciente"
                                        name="nome_paciente" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="cpf_paciente">Cpf:</label>
                                    <input type="number" class="form-control" id="cpf_paciente" name="cpf_paciente"
                                        required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="cns_paciente">Cns:</label>
                                    <input type="text" class="form-control" id="cns_paciente"
                                        name="cns_paciente" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="logradouro_paciente">Logradouro:</label>
                                    <input type="text" class="form-control" id="logradouro_paciente"
                                        name="logradouro_paciente" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="numero_paciente">Numero:</label>
                                    <input type="number" class="form-control" id="numero_paciente"
                                        name="numero_paciente" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="complemento_paciente">Complemento:</label>
                                    <input type="text" class="form-control" id="complemento_paciente"
                                        name="complemento_paciente" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="bairro_paciente">Bairro:</label>
                                    <input type="text" class="form-control" id="bairro_paciente"
                                        name="bairro_paciente" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="cidade_paciente">Cidade:</label>
                                    <input type="text" class="form-control" id="cidade_paciente"
                                        name="cidade_paciente" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="cep_paciente">Cep:</label>
                                    <input type="number" class="form-control" id="cep_paciente"
                                        name="cep_paciente" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="estado_paciente">Estado:</label>
                                    <input type="text" class="form-control" id="estado_paciente"
                                        name="estado_paciente" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="celular_paciente">Celular:</label>
                                    <input type="number" class="form-control" id="celular_paciente"
                                        name="celular_paciente" required>
                                </div>


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