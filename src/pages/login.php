<?php

    //Inclusao da pagina de conexao com banco de dados
    include('../../config/config.php');

    //Iniciando sessoes
    session_start();

    //Credencias do login
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    print_r($cpf);

    //Consulta sql a partir do cpf
    $sql_login = "SELECT * FROM `funcionarios` WHERE cpf_funcionario = $cpf";
    $result = mysqli_query($conn, $sql_login);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if($row["senha"] == $senha){
            $_SESSION["Nome"] = $row["nome_funcionario"];
            $_SESSION["ID"] = $row["cod_funcionario"];
            $_SESSION["Perfil"] = $row["perfil"];
            header('location: sucesso.php');
        }else{
            header('location: error_login.php');
        }        
    } else {
        header('location: error_login.php');
    }
?>