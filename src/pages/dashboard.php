<?php 
if(!isset($_SESSION['ID'])){
     session_start();
 };
 
     if(!isset($_SESSION["Perfil"])){
          header('Location: ../../public/index.php');
     }else{
          $perfil = $_SESSION["Perfil"];
     }

     if(!isset($_GET['pag'])){
          $pg = 1;
     }else{
          $pg = $_GET['pag'];
     }

?>
<!DOCTYPE html>
<html lang="en">
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <!-- Style -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <!-- Style -->

    <!-- Fonte Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Fonte Awesome -->
    
    <!-- Titulo Lembrar de mudar! -->
    <link rel="shortcut icon" href="../../assets/images/favico.ico">
    <title>Sisman - Dashboard</title>

</head>
<?php include('navbar.php')?>

<body style="position: relative;">
     <!<?php 
          if($perfil == 1){
               if ($pg == 1){
                    include("dashboard_atendente.php");
               }else if ($pg == 2){
                    include("estoque.php");
               }

          }else if($perfil== 2){
               switch ($pg) {
                    case 1:
                        include("dashboard_Compras.php");
                        break;
                    case 2:
                        include("dashboard_Medicamentos.php");
                        break;
                    case 3:
                        include("dashboard_processo.php");
                        break;
                    case 4:
                        include("dashboard_medicos.php");
                        break;
                    case 5:
                        include("dashboard_funcionarios.php");
                        break;
                    case 6:
                        include("dashboard_pacientes.php");
                        break;
                    case 7:
                         include("ver_medicamento.php");
                         break;
                    default:
                        include("dashboard_Compras.php");
                        break;
                }
                
          }else if($perfil == 0 ){
          
               switch ($pg) {
                    case 1:
                        include("dashboard_Compras.php");
                        break;
                    case 2:
                        include("dashboard_Medicamentos.php");
                        break;
                    case 3:
                        include("dashboard_processo.php");
                        break;
                    case 4:
                        include("dashboard_medicos.php");
                        break;
                    case 5:
                        include("dashboard_funcionarios.php");
                        break;
                    case 6:
                        include("dashboard_pacientes.php");
                        break;
                    case 7:
                         include("ver_medicamento.php");
                         break;
                    case 8:
                         include("dashboard_atendente.php");
                         break;
                    case 9:
                         include("estoque.php");
                         break;
                    default:
                        include("dashboard_Compras.php");
                        break; 
                    
          }    
     }
        
        
      ?>
</body> 
     <?php include('footer.php')?>
</html>