<?php
    //Inclusao da pagina de conexao com banco de dados
    include('../../config/config.php');

    //Iniciando sessoes
    session_start();

    //Credencias do login
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    function criarPastaEMoverArquivo($nome) {

        $destino = "../../perfil_img/" . $nome;


        
        if (!is_dir($destino)) {
            if (!mkdir($destino, 0755, true)) {
                return "Falha ao criar a pasta.";
            }
        }
    
        $arquivoOrigem = '../../assests/images/acount.jpg';

        // Move o arquivo para a nova pasta
        if (!rename($arquivoOrigem, $destino . '/' . $arquivoDestino)) {
            return "Falha ao mover o arquivo.";
        }
    
        return "Arquivo movido com sucesso.";
    }
    

    //Consulta sql a partir do cpf
    $sql_login = "SELECT * FROM `funcionarios` WHERE cpf_funcionario = '$cpf'";
    $result = mysqli_query($conn, $sql_login);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if($row["senha"] == $senha){
            $_SESSION["Nome"] = $row["nome_funcionario"];
            $_SESSION["ID"] = $row["cod_funcionario"];
            $_SESSION["Perfil"] = $row["perfil"];
            $_SESSION["login_erro"] = false;


            




            header('location: dashboard.php');
            
        }else{
            $_SESSION["login_erro"]=true;
            header('location: ../../public/index.php');
        }        
    } else {
        $_SESSION["login_erro"]=true;
        header('location: ../../public/index.php');
    }
?>