<?php
$_SESSION['Perfil'] = 1;
session_start();
if (!isset($_SESSION["Perfil"])) {
     header('Location: ../../public/index.php');
} else {

     $perfil = $_SESSION["Perfil"];

}


if (!isset($_GET['pag'])) {
     $pg = 1;
} else {
     $pg = $_GET['pag'];
}

?>
<!DOCTYPE html>

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
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

     <!-- Style -->
     <link rel="stylesheet" href="../../assets/css/style.css">
     <link rel="stylesheet" href="../../assets/css/dashboard.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <!-- Style -->

     <!-- Fonte Awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
     <!-- Fonte Awesome -->

     <!-- Titulo Lembrar de mudar! -->
     <link rel="shortcut icon" href="../../assets/images/favico.ico">
     <title>Sisman - Dashboard</title>

</head>



<?php include('navbar.php') ?>

<body style="position: relative;">
     <?php
     switch ($perfil) {
          case 1:
               switch ($pg) {
                    case 1:
                         include("dashboard_processo.php");
                         break;
                    case 2:
                         include("dashboard_funcionarios.php");
                         break;
                    case 3:
                         include("dashboard_medicos.php");
                         break;
                    case 4:
                         include("dashboard_pacientes.php");
                         break;
                    default:
                         echo "Página não encontrada.";
                         break;
               }
               break;

          case 2:

          default:
               echo "Perfil não reconhecido.";
               break;
     }

     ?>
</body>
<?php include('footer.php') ?>

</html>