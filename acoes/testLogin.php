<?php
session_start();

include_once ("bd.php");

    if (isset($_POST['submit'])&& isset($_POST['user']) && isset($_POST['pass'])) {
        $user = $_POST["user"];
        $pass = $_POST["pass"];


        $sql = "SELECT * FROM usuario WHERE usuario = '$user' and senha = '$pass'";

        $result = $mysqli -> query($sql);

        if (mysqli_num_rows($result) < 1) {
            unset($_SESSION['user']);
            unset($_SESSION['pass']);
            echo "<script>alert('Usuário e/ou senha inválido(s), Tente novamente!');</script>";
            header('Location: /banco/index.php');

        }
        else {
            $_SESSION["user"] = $user;
            $_SESSION["pass"] = $pass;
            header("Location: /banco/app/insercao/operacao.php");
        }
    }
    else {
        header('Location: /banco/index.php');
    }
?>