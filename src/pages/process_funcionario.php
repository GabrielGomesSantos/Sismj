<?php
require_once('C:/xampp/htdocs/Sismj/config/config.php');
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $cod_funcionario = $_POST['cod_funcionario'];
    $nome_funcionario = $_POST['nome_funcionario'];
    $cpf_funcionario = $_POST['cpf_funcionario'];
    $matricula_funcionario = $_POST['matricula_funcionario'];
    $email_funcionario = $_POST['email_funcionario'];
    $senha_funcionario = $_POST['senha_funcionario'];
    $perfil_funcionario = $_POST['perfil_funcionario'];


    $sql = "UPDATE funcionarios 
        SET nome_funcionario = '$nome_funcionario', 
            cpf_funcionario = '$cpf_funcionario', 
            matricula = '$matricula_funcionario', 
            email_funcionario = '$email_funcionario', 
            senha = '$senha_funcionario', 
            perfil = '$perfil_funcionario' 
        WHERE cod_funcionario = '$cod_funcionario'";


    if ($conn->query($sql) === TRUE) {
        header("Location: listar_funcionario.php");
        exit(); 
    } else {
        echo "Erro ao cadastrar funcionario: " . $conn->error;
    }


   
}
