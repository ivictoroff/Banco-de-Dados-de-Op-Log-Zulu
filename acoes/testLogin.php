<?php
session_start();

include_once ("bd.php");

    if (isset($_POST['submit'])&& isset($_POST['user']) && isset($_POST['pass'])) {
        $user = $_POST["user"];
        $pass = $_POST["pass"];
        print_r($user);


        $sql = "SELECT * FROM usuario WHERE usuario = '$user' and senha = '$pass'";

        $result = $mysqli -> query($sql);

        if (mysqli_num_rows($result) < 1) {
            unset($_SESSION['user']);
            unset($_SESSION['pass']);
            $_SESSION['login'] = 'nao';
            header('Location: /banco/index.php');

        }
        else {
            $_SESSION["user"] = $user;
            $_SESSION["pass"] = $pass;
            header("Location: /banco/app/pesquisa/operacao.php");
        }
    }
    else {
        header('Location: /banco/index.php');
    }
?>