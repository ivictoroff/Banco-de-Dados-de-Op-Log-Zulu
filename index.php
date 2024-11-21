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
    <link rel="shortcut icon" type="imagex/png" href="/banco/img/colog.png">
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

  <section class="bg-gray-50 dark:bg-gray-900">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
          <img class="w-auto h-15 mr-2" src="/banco/img/colog.png" alt="logo">
      </a>
      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Entrar na sua conta
              </h1>
              <form class="space-y-4 md:space-y-6" method="post" action="/banco/acoes/testLogin.php">
              <div>
                      <label for="user" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome de usuario</label>
                      <input name= "user" required placeholder="V araujo" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha</label>
                      <input type="password" name= "pass" required placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  </div>
                  <div class="flex items-center justify-between">
                      <div class="flex items-start">
                      </div>
                      <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Esqueceu sua senha?</a>
                  </div>
                  <input type="submit" name="submit" value="CADASTRAR" class="w-full text-white bg-indigo-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"/>
                  <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                      Não tem conta? <a href="cadastro.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Cadastrar</a>
                  </p>
              </form>
          </div>
      </div>
  </div>
</section>
<br>
<br>

  </div>
</div>

    </div> 
        <footer id="rodape">
          <h1>Exército Brasileiro Comando Logístico Diretoria de Material SMU, Bloco C, Térreo. CEP: 70630-901 Divisão de Tecnologia e Informação - Ramal 5451</h1>
        </footer> 
  </body>
</html>

