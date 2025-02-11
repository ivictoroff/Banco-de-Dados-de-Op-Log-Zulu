<?php
//CONECTANDO COM O BD
$host = "localhost";
$db = "dbmat";
$user = "root";
$pass = "@160l0nc3t";

$mysqli = new mysqli($host, $user, $pass, $db);
//TESTE D CONEXÃO
if($mysqli->connect_errno) {
    die("Falha na conexão com o banco de dados");
}
?>