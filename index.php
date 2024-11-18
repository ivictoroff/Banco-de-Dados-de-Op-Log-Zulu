<?php
session_start();

if (@$_SESSION['login'] == 'nao') {
  echo "<script>alert('Usuário e/ou senha inválido(s), Tente novamente!');</script>";
  unset($_SESSION['login']);
}
?>

<!DOCTYPE html>
<html>
  <head>
  <html lang="pt-br">
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/index.css">
    <link rel="shortcut icon" type="imagex/png" href="/banco/img/dmat.png">
    <title>Login</title>
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
    <img class="mx-auto h-15 w-auto" src="/banco/img/dmat.png" alt="DMAT">
    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900"></h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" action="/banco/acoes/testLogin.php" method="POST">
      <div>
        <label for="user" class="block text-sm/6 font-medium text-gray-900">Nome de guerra:</label>
        <div class="mt-2">
          <input id="user" placeholder="V araujo" name="user" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm/6 font-medium text-gray-900">Senha:</label>
          <div class="text-sm">
            <a href="cadastro.php" class="font-semibold text-indigo-600 hover:text-indigo-500">Não esta cadastrado?</a>
          </div>
        </div>
        <div class="mt-2">
          <input id="password" placeholder="Sua senha" name="pass" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
        </div>
      </div>

      <div>
        <button name="submit" type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
      </div>
    </form>


  </div>
</div>

    </div> 
        <footer id="rodape">
          <h1>Exército Brasileiro Comando Logístico Diretoria de Material SMU, Bloco C, Térreo. CEP: 70630-901 Divisão de Tecnologia e Informação - Ramal 5451</h1>
        </footer> 
  </body>
</html>

