<?php
// session_start();
?>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #17a2b8; height: 80px; padding-left: 4; padding-right: 0;">
    <div class="container-fluid d-flex justify-content-between align-items-center" style="padding-left: 0; padding-right: 0;">
        <!-- Logo, Nome e Nome do Funcionário -->
        <div class="d-flex align-items-center" style="margin-left: 0;">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php" style="margin: 0;">
                <img src="../../assets/images/logo.png" alt="Logo" width="46" height="37" class="d-inline-block align-text-top">
                <span class="ms-2">Sisman</span>
            </a>
        </div>

        <ul class="navbar-nav mb-2 mr-3 mb-lg-0 d-flex align-items-center">
            <?php
                echo "<span class='me-4 text-white'>Olá, {$_SESSION['Nome']}</span>";
            ?>
            <li class="nav-item ml-3">
                <img src="../../assets/images/acount.png" alt="Conta" width="55" height="54" class="ms-3">
            </li>
        </ul>
    </div>
</nav>


