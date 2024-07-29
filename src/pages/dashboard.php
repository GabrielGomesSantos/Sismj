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
    <title>Sisman - Dashboard</title>

     <style>
        .card-title {
            display: flex;
            align-items: center;
            font-weight: bold;
        }
        .card-title i {
            margin-right: 10px;
        }
        .card-deck .card {
            margin-bottom: 20px;
        }
        .btn {
            width: 100%;
        }
    </style>
</head>

<?php include('navbar.php')?>

<body>

<div class="content py-5">
    <div class="container">
        <div class="row">
            <!-- Card Cadastrar -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-user-plus"></i> Cadastrar Funcionários</h5>
                        <p class="card-text">Adicione novos funcionários ao sistema de maneira fácil e rápida.</p>
                        <a href="#" class="btn btn-primary">Cadastrar</a>
                    </div>
                </div>
            </div>
            <!-- Card Cadastrar -->

            <!-- Card Editar -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-user-pen"></i> Editar Funcionários</h5>
                        <p class="card-text">Altere as informações dos funcionários cadastrados.</p>
                        <a href="#" class="btn btn-primary">Editar</a>
                    </div>
                </div>
            </div>
            <!-- Card Editar -->

            <!-- Card Excluir -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-user-minus"></i> Excluir Funcionários</h5>
                        <p class="card-text">Remova funcionários que não fazem mais parte da equipe.</p>
                        <a href="#" class="btn btn-primary">Excluir</a>
                    </div>
                </div>
            </div>
            <!-- Card Excluir -->
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