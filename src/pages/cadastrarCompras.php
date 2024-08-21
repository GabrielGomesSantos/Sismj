<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Fonte Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../../assets/images/favico.ico">
    <title>Cadastro de Compras</title>
</head>

<?php include('navbar.php')?>

<body>
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 contents">
                    <div class="mb-4">
                        <h3>Cadastro de <strong>Compras</strong></h3>
                        <p class="mb-4">Formulário para cadastrar Compras</p>
                    </div>
                    <form action="cadastrarCompras.php" method="post">
                        <div class="form-group first mb-4">
                            <label for="nota_fiscal">Nota Fiscal:</label>
                            <input type="text" class="form-control" id="nota_fiscal" name="nota_fiscal" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="data">Data:</label>
                            <input type="date" class="form-control" id="data" name="data" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="fornecedor">Fornecedor:</label>
                            <input type="text" class="form-control" id="fornecedor" name="fornecedor" required>
                        </div>
                        <input type="submit" value="Cadastrar" class="btn text-white btn-block btn-info mt-5">
                    </form>

                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Conectar ao banco de dados
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "bd_sisman";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Verificar conexão
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Receber dados do formulário
                        $nota_fiscal = $_POST['nota_fiscal'];
                        $data = $_POST['data'];
                        $fornecedor = $_POST['fornecedor'];

                        // Inserir dados na tabela
                        $sql = "INSERT INTO compras (nota_fiscal, data, fornecedor) VALUES ('$nota_fiscal', '$data', '$fornecedor')";

                        if ($conn->query($sql) === TRUE) {
                            echo "<div class='alert alert-success mt-4'>Compra cadastrada com sucesso!</div>";
                        } else {
                            echo "<div class='alert alert-danger mt-4'>Erro: " . $sql . "<br>" . $conn->error . "</div>";
                        }

                        $conn->close();
                    }
                    ?>
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
