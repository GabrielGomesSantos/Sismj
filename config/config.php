<?php

/////Variaveis de conexao//////

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

////////////////////////////////

/////////////conexão/////////////

$conn = mysqli_connect($servername, $username, $password, $dbname);

////////////////////////////////

// Verifica a conexão
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

define('BASE_URL', 'http://localhost/Sismj/');
// define('ASSETS_URL', BASE_URL . 'assets/');

?>