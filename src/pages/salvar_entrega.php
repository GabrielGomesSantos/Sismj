<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recebe os dados JSON enviados via POST
        $dados = json_decode($_POST['dados'], true);

        // Verifica o conteúdo de $dados 
        file_put_contents('debug_entrega.log', print_r($dados, true)); // Salva o conteúdo no log
    }
?>