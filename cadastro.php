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
    header("Location: index.php");
  }


?>
    
<!DOCTYPE html>
<html>
  <head>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="/public/img/icon.ico">
    <title>Cadastro</title>
    <style>
                .alinhar{
                  display: flex;
                }
                
                .produto{
                    border: 1px solid #ccc;
                    padding: 20px;
                    margin: 5px;
                    float: left; 
                    width: 200px; 
                }

                #rodape {
                  background-color: #f0f0f0;
                  padding: 20px;
                  text-align: center;
                  position: fixed;
                  bottom: 0;
                  width: 100%;
                }
                #atual {
	                color: #f7b600;
                }
    </style>
  </head>
  <body>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img class="mx-auto h-15 w-auto" src="dmat.png" alt="DMAT">
      <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900"></h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form action= "" method= "post">
        <div>
          <label for="user" class="block text-sm/6 font-medium text-gray-900">nome de usuario</label>
          <div class="mt-2">
          <input name= "user" required placeholder="Digite o Usuario" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
          </div>
        </div>
        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm/6 font-medium text-gray-900">senha</label>
            <div class="text-sm">
            <a href="index.php" class="font-semibold text-indigo-600 hover:text-indigo-500">Já esta cadastrado?</a>
          </div>
          </div>
        <div class="mt-2">
          <input type="password" name= "pass" required placeholder="Digite a senha" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
        </div>
        <div class="mt-4">
         <input type="submit" name="submit" value="Logar" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"/>
        </div>
        </form>

        </div>
</div>

        <footer id="rodape">
          <h1>Exército Brasileiro Comando Logístico Diretoria de Material SMU, Bloco C, Térreo. CEP: 70630-901 Divisão de Tecnologia e Informação - Ramal 5451</h1>
        </footer> 
    </div> 
  </body>
</html>

