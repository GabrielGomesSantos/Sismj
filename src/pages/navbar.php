
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">   

<?php

if(!isset($_SESSION['ID'])){

    session_start();

};

$nome = htmlspecialchars($_SESSION['Nome']); // Sanitize session variable

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

        <div class=" sair " onclick="toggleActive()" type="button">

            <ul class="navbar-nav mb-2 mr-3 mb-lg-0 d-flex align-items-center flex-column">
                
                <li class="nav-item mt-5 ">
                   <?php
                    echo "<span class='me-5 text-white'>Olá, {$_SESSION['Nome']}</span>";
                    ?> 
                    <img src="../../perfil_img/<?php echo $nome; ?>/acount.jpg" alt="Conta" width="55" height="54" class="ms-5 me-5 rounded-circle">                </li>
                    <li class="mt-3">
                        <button type="button" class="btn btn-secondary" onclick='changePicture()'>Trocar Foto</button>
                    </li>
                    <li class="mt-3">
                        <button type="button" class="btn btn-danger" onclick='window.location="sair.php"'>Logoff</button>
                    </li>
                </ul>

        </div>

    </div>
    
</nav>



  <!-- Modal Change Picture-->
  <div class="modal fade" id="modalChange" tabindex="-1" aria-labelledby="modalChangeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <div class="d-flex align-items-center">
                        <h1 class="modal-title fs-5 mb-0" id="modalPicture">Mudar Foto de Perfil</h1>
                    </div>
                    <button type="button" class="btn btn-light p-2 rounded-circle" data-bs-dismiss="modal" aria-label="Close">
                        <img src="../../assets/images/close.png" alt="Fechar" style="width: 20px;">
                    </button>
                </div>
                <div class="modal-body" id="modalPictureBody">
                    <!-- Formulário de upload de imagem -->
                    <form class="d-flex flex-column justify-content-center align-items-center p-4" id="form-form">
                        <div class="image-upload">
                            <img id="image-preview" src="" class="w-100 h-100">
                            <i class="bi bi-cloud-arrow-up"></i>
                            <input id="image-field" type="file">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
