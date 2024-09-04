<?php
if(!isset($_SESSION['ID'])){
    session_start();
};


$usuario =  $_SESSION["Nome"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se o arquivo foi enviado sem erros
    if (isset($_FILES['image-field']) && $_FILES['image-field']['error'] === UPLOAD_ERR_OK) {
        $nome = 'acount.jpg';  // Defina o nome do arquivo que deseja salvar

        // Caminho do diretório de destino
        $diretorioDestino = "../../perfil_img/" . $usuario . "/";

        // Caminho completo para o arquivo de destino
        $destino = $diretorioDestino . $nome;

        // Caminho temporário do arquivo de upload
        $source = $_FILES['image-field']['tmp_name'];

        // Move o arquivo para o diretório de destino
        if (move_uploaded_file($source, $destino)) {
            echo "Arquivo copiado com sucesso para $destino.";
        } else {
            echo "Falha ao copiar o arquivo.";
        }
    } else {
        echo "Nenhum arquivo foi enviado ou ocorreu um erro no upload.";
    }
} else {
    echo "Método de requisição inválido.";
}
