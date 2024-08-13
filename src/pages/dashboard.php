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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Style -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Style -->

    <!-- Fonte Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Fonte Awesome -->
    
    <!-- Titulo Lembrar de mudar! -->
    <link rel="shortcut icon" href="../../assets/images/favico.ico">
    <title>Sisman - Dashboard</title>

</head>

<style>
     *{

          list-style: none;
          margin: 0; 
          padding: 0;
     }
     body{

          min-height: 100vh;

     }

    .col {
         margin: 0px;
    }
    .row {
         margin: 0px;
    }
    .sidebar{

          position: absolute;
          width: 60px;
          height: calc(100vh - 80px);
          transition: 0.4s;
          background-color: #17a2b8;
          overflow: hidden;
          
          
    }
    .sidebar ul li a{

     display: flex;
     white-space: nowrap;
     text-decoration: none;

    }
    .sidebar ul li .icone{

     display: flex;
     justify-content: center;
     

     min-width: 60px;
     height: 60px;

    }
    
    .sidebar:hover{

          width: 165px;

    }

    .sidebar ul li .titulo{

          display: flex;
          width: 100%;
          height: 20px;
          text-align: center;
          color: white;
          transition: 0.2s;
     }

     .sidebar ul li .titulo:hover{

          color: #ccc;

     }
     
     .centralizar{

          display: flex;
          align-items: center;
          text-align: center;
          margin-bottom: 30px;

     }

</style>

<?php include('navbar.php')?>

<body style="position: relative;">
     <!<?php 
        
        include("dashboard_atendente.php");
      ?>
</body> 
<?php include('footer.php')?>
</html>