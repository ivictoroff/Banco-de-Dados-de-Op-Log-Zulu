<?php
session_start();

$conn = new PDO ("mysql:dbname=dbmat;host=localhost", "root", "@160l0nc3t");
require 'bd.php';
$usuario = $_SESSION['user'];
$sql = "SELECT funcao FROM usuario WHERE usuario = '$usuario'";
$result = $mysqli -> query($sql);
while ($dados = $result->fetch_assoc()) {
    print_r ($dados);
    if ($dados['funcao'] === 'Emprego') {
        header('Location: /banco/app/insercao/emprego.php');
    }
    if ($dados['funcao'] == 'Preparo') {
        header('Location: /banco/app/insercao/preparo.php');
    }
    if ($dados['funcao'] == 'Transporte') {
        header('Location: /banco/app/insercao/transporte.php');
    }
}