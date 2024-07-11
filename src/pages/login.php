<?php

    //Inclusao da pagina de conexao com banco de dados
    include('../../config/config.php');

    //Credencias do login
    $cpf = $_post['cpf'];
    $senha = $_post['senha'];

    $sql_login = "SELECT * FROM `funcionarios` WHERE cpf_funcionario =$usuario"



?>