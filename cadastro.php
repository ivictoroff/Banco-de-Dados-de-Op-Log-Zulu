<?php
  
  $user = @$_REQUEST['user'];
  $pass = @$_REQUEST['pass'];
  $submit = @$_REQUEST['submit'];

  $conn = new PDO ("mysql:dbname=dbmat;host=localhost", "root", "");

  if($submit){

    if($user == "" || $pass == ""){
      echo "<script:alert('Por favor, preencha todos os campos!');</script>";
    }
    else{
      $stmt = $conn->prepare("INSERT INTO usuario (usuario, senha) VALUES (:LOGIN, :PASSWORD)");

      $stmt -> bindParam(":LOGIN", $user);
      $stmt -> bindParam(":PASSWORD", $pass);
      
      $stmt->execute();
    }
    header("Location: cadastro.php");
  }


?>
    
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="/public/css/index.css">
    <link rel="shortcut icon" type="imagex/png" href="/public/img/icon.ico">
    <title>Login e Cadastro</title>
  </head>
  <body>
    <div id="position">

      <form action= "" method= "post">
        <input name= "user" required placeholder="Digite o Usuario">
        <input type="password" name= "pass" required placeholder="Digite a senha">
         <input type="submit" name="submit" value="Logar" />
      </form>

      <a style="color:#209e2e;"href="index.php">login</a>
      
    </div> 
  </body>
</html>

