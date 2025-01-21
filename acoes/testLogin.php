<?php
session_start();

date_default_timezone_set("america/sao_paulo");

include_once ("bd.php");

    if (isset($_POST['submit'])&& isset($_POST['user']) && isset($_POST['pass'])) {
        $user = $_POST["user"];
        $pass = $_POST["pass"];
        print_r($user);

        $sql = "SELECT * FROM usuario WHERE usuario = BINARY '$user' and senha = BINARY '$pass'";

        $result = $mysqli -> query($sql);

        if (mysqli_num_rows($result) < 1) {
            unset($_SESSION['user']);
            unset($_SESSION['pass']);
            $_SESSION['login'] = 'nao';
            header('Location: /banco/index.php');

        }
        else {
            $data = date('y-m-d H:i:s');
            $_SESSION["user"] = $user;
            $_SESSION["pass"] = $pass;
            header("Location: /banco/app/pesquisa/operacao.php");
            $sql = "INSERT INTO loglogin (usuario, data) VALUES ('$user', '$data')";
            $mysqli->query($sql);
        }
    }
    else {
        header('Location: /banco/index.php');
    }
?>