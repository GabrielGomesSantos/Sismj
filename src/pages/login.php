<?php
//Inclusao da pagina de conexao com banco de dados
include('../../config/config.php');

//Iniciando sessoes
session_start();

//Credenciais do login
$cpf = $_POST['cpf'];
$senha = $_POST['senha'];

function acountImg($nome) {
    // Caminho do diretório de destino com o nome do funcionário
    $diretorioDestino = "../../perfil_img/" . $nome;
    $source = '../../assets/images/acount.png';  // Caminho do arquivo de origem
    $destino = $diretorioDestino . "/acount.jpg";  // Caminho completo para o arquivo de destino

    // Verifica se o diretório de destino existe, se não existir, cria-o
    if (!is_dir($diretorioDestino)) {
        if (!mkdir($diretorioDestino, 0755, true)) {
            die("Falha ao criar o diretório de destino.");
        }
    }

    // Verifica se o arquivo de destino já existe
    if (!file_exists($destino)) {
        // Copia o arquivo para o diretório de destino
        if (copy($source, $destino)) {
            echo "Arquivo copiado com sucesso para $destino.";
        } else {
            echo "Falha ao copiar o arquivo.";
        }
    } else {
        echo "O arquivo já existe em $destino.";
    }
}

// Consulta SQL a partir do CPF
$sql_login = "SELECT * FROM `funcionarios` WHERE cpf_funcionario = '$cpf'";
$result = mysqli_query($conn, $sql_login);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if($row["senha"] == $senha){
        $_SESSION["Nome"] = $row["nome_funcionario"];
        $_SESSION["ID"] = $row["cod_funcionario"];
        $_SESSION["Perfil"] = $row["perfil"];
        $_SESSION["login_erro"] = false;

        // Cria diretório e copia o arquivo de imagem para o funcionário
        acountImg($row["nome_funcionario"]);

        header('location: dashboard.php');
    } else {
        $_SESSION["login_erro"] = true;
        header('location: ../../public/index.php');
    }        
} else {
    $_SESSION["login_erro"] = true;
    header('location: ../../public/index.php');
}
?>
