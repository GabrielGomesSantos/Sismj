<?php
require_once('../../config/config.php');
$id_processo = intval(0);
if (isset($_GET['id_processo'])) {
    $id_processo = intval($_GET['id_processo']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {        
        $nome_medicamento = mysqli_real_escape_string($conn, $_POST['nome_medicamento']);
        $tipo_medicamento = mysqli_real_escape_string($conn, $_POST['tipo_medicamento']);
        $categoria_medicamento = mysqli_real_escape_string($conn, $_POST['categoria_medicamento']);
        $laboratorio = mysqli_real_escape_string($conn, $_POST['laboratorio']);
        $quantidade = intval($_POST['quantidade']);
        
        $sql = "INSERT INTO medicamentos_processo (cod_processo, nome_medicamento, tipo_medicamento, categoria_medicamento, laboratorio, quantidade) 
                VALUES ('$id_processo', '$nome_medicamento', '$tipo_medicamento', '$categoria_medicamento', '$laboratorio', '$quantidade')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>
            alert('Medicamento Cadastrado com sucesso!');
            window.location.href='listar_medicamentos_processos.php?id_processo=$id_processo';
            </script>";
        } else {
            echo "Erro ao cadastrar medicamento: " . mysqli_error($conn);
        }
    }
}

?>

<!doctype html>
<html lang="pt-br">

<head>
    <!-- Meta tags e links de estilos -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../../assets/images/favico.ico">
    <title>Cadastro de Medicamento</title>
</head>

<?php include('navbar.php'); ?>

<body>
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Cadastro de <strong>Medicamento para Processo</strong></h3>
                                <p class="mb-4">Formulário para cadastrar medicamentos no processo</p>
                            </div>
                            <form action="" method="post">
                                <input type="hidden" name="id_processo" value="<?php echo $id_processo; ?>">
                                <div class="form-group first mb-4">
                                    <label for="nome_medicamento">Nome do Medicamento:</label>
                                    <input type="text" class="form-control" id="nome_medicamento"
                                        name="nome_medicamento" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="tipo_medicamento">Tipo do Medicamento:</label>
                                    <input type="text" class="form-control" id="tipo_medicamento"
                                        name="tipo_medicamento" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="categoria_medicamento">Categoria do Medicamento:</label>
                                    <input type="text" class="form-control" id="categoria_medicamento"
                                        name="categoria_medicamento" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="laboratorio">Laboratório:</label>
                                    <input type="text" class="form-control" id="laboratorio" name="laboratorio"
                                        required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="quantidade">Quantidade:</label>
                                    <input type="number" class="form-control" id="quantidade" name="quantidade"
                                        required>
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
    <?php include('footer.php'); ?>
</body>

</html>