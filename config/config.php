<?php

/////Variaveis de conexao//////

$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "sis_mj";

////////////////////////////////

/////////////conexão/////////////

$conn = mysqli_connect($servername, $username, $password, $dbname);

////////////////////////////////


// Verifica a conexão
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
?>