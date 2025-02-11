<?php 

session_start();
//DESTROI INFORMAÇOES DA SESSAO 
unset($_SESSION['user']);
unset($_SESSION['pass']);
//DIRECIONA PARA O INDEX
header('Location:/index.php');

?>

