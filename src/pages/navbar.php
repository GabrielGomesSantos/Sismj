<nav class="navbar navbar-expand-lg navbar-dark"  style="background-color: #17a2b8;">
    <div class="container-fluid ">

      <!-- Logo e Nome  -->

      <a class="navbar-brand" href="#">
        <img src="../../assets/images/logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
        Sisman
      </a>

      <?php

        session_start();

        if($_SESSION["Perfil"] = 2) //Caso o usuario seja um atendente
        {

        }elseif($_SESSION["Perfil"] = 1) //Caso o usuario seja um Gestor
        {

        }else //Caso o usuario seja um Adm
        {

        }


      ?>



    </div>
  </nav>