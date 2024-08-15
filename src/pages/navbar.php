<<<<<<< Updated upstream
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #17a2b8;">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <!-- Logo, Nome e Nome do Funcionário -->
        <div class="d-flex align-items-center">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="../../assets/images/logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                <span class="ms-2">Sisman</span>
=======
<?php
session_start();
?>

<nav class="sm navbar navbar-expand-lg navbar-dark" style="background-color: #17a2b8; height: 80px; padding-left: 4; padding-right: 0;">
    <div class="sm container-fluid d-flex justify-content-between align-items-center" style="padding-left: 0; padding-right: 0;">
        <!-- Logo, Nome e Nome do Funcionário -->
        <div class="sm d-flex align-items-center" style="margin-left: 0;">
            <a class="sm navbar-brand d-flex align-items-center" href="dashboard.php" style="margin: 0;">
                <img src="../../assets/images/logo.png" alt="Logo" width="46" height="37" class="sm d-inline-block align-text-top">
                <span class="sm ms-2">Sisman</span>
>>>>>>> Stashed changes
            </a>
            <?php
                session_start();
                  echo "<span class='ms-3 text-white'>{$_SESSION['Nome']}</span>";
          ?>
        </div>

<<<<<<< Updated upstream
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
                <button class="btn btn-danger" onclick="window.location.href='logoff.php';">Sair</button>
=======
        <ul class="sm navbar-nav mb-2 mr-3 mb-lg-0 d-flex align-items-center">
            <?php
                echo "<span class='sm me-4 text-white'>Olá, {$_SESSION['Nome']}</span>";
            ?>
            <li class="sm nav-item ml-3">
                <img src="../../assets/images/acount.png" alt="Conta" width="55" height="54" class="sm ms-3">
>>>>>>> Stashed changes
            </li>
        </ul>
    </div>
</nav>
