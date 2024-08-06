<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #17a2b8;">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <!-- Logo, Nome e Nome do Funcionário -->
        <div class="d-flex align-items-center">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="../../assets/images/logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                <span class="ms-2">Sisman</span>
            </a>
            <?php
                session_start();
                  echo "<span class='ms-3 text-white'>{$_SESSION['Nome']}</span>";
          ?>
        </div>

        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
                <button class="btn btn-danger" onclick="window.location.href='logoff.php';">Sair</button>
            </li>
        </ul>
    </div>
</nav>
