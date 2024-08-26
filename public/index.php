<?php session_start();
if (isset($_SESSION['login_erro'])) {
  $login_erro = $_SESSION['login_erro'];
} else {
  $login_erro = "";
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="assets/fonts/icomoon/style.css">

  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="../assets/css/style.css">

  <title>Login</title>
</head>



<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #17a2b8;">
  <div class="container-fluid ">

    <!-- Logo e Nome  -->

    <a class="navbar-brand" href="index.html">
      <img src="../assets/images/logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
      Sisman
    </a>
  </div>
</nav>

<body>



  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-2">
          <img src="../assets/images/medicos.png" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
                <div class="logo-container">
                  <h3>Entrar no <strong class="logo">SISMAN</strong></h3>
                </div>
                <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p>
              </div>


              <form action="../src/pages/login.php" method="post">

                <div class="form-group first">
                  <label for="cpf">Cpf</label>
                  <input type="text" class="form-control" name="cpf" id="cpf" required>

                </div>
                <div class="form-group last mb-4">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="senha" id="password" required>

                </div>
                <?php if ($login_erro == true) {
                  echo "<div class=' justify-content-center'>
              <div class='alert alert-danger text-center p-2 d-flex shadow-sm rounded'> Cpf ou senha incorretos
              </div>
              </div>";
                }

                ?>

                <input type="submit" value="Log In" class="btn text-white btn-block btn-info">

            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>


  <script src="../assets/js/jquery-3.3.1.min.js"></script>
  <script src="../assets/js/popper.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/main.js"></script>
</body>

</html>