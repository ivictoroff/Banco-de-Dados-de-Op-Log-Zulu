<?php
session_start();
//DEFINE O FUSO HORARIO (PARA SALVAR OS HORARIOS QUE FORAM EFETUADOS OS LOGINS )
date_default_timezone_set("america/sao_paulo");
//INCLUI O BANCO DE DADOS 
include_once ("bd.php");
    //SE EXISTER SUBMIT, LOGIN E SENHA, ELE ARMAZENA O USUARIO E A SENHA 
    if (isset($_POST['submit'])&& isset($_POST['user']) && isset($_POST['pass']) ) {
        $user = $_POST["user"];
        $pass = $_POST["pass"];
        //print_r($user);
        //FAZ UMA CONSULTA NO BD
        $sql = "SELECT * FROM usuario WHERE usuario = '$user' and senha = BINARY '$pass'";
            
        $result = $mysqli -> query($sql);
        //SE NAO EXISTIR USER E SENHA DESTROI INFORMACÕES DE USER E SENHA E REDIRECIONA PARA O INDEX
        if (mysqli_num_rows($result) < 1) {
            unset($_SESSION['user']);
            unset($_SESSION['pass']);
            $_SESSION['login'] = 'errada';
            header('Location: /index.php');

        }
        //SE EXISTIR SALVA HORA, USER E SENHA ->DIRECIONA PARA TELA PRINCIPAL || INSERE NO BD TABELA logLogin usuario e data 
        
        else {
            $status =  "SELECT * FROM usuario WHERE usuario = '$user' and senha = BINARY '$pass' and status = 'Ativo'";
            $result = $mysqli -> query($status);
            if (mysqli_num_rows($result) < 1){
                unset($_SESSION['user']);
                unset($_SESSION['pass']);
                $_SESSION['login'] = 'desativado';
                header('Location: /index.php');
            }
            else{
            $data = date('y-m-d H:i:s');
            $_SESSION["user"] = $user;
            $_SESSION["pass"] = $pass;
            header("Location: /app/pesquisa/operacao.php");
            //INSERINDO NA TABELA 
            $sql = "INSERT INTO loglogin (usuario, data) VALUES ('$user', '$data')";
            $mysqli->query($sql);
            }
        }
    }
    else {
        //EM TODO CASO REDIRECIONA PARA O INDEX 
        header('Location: /index.php');
    }
?>