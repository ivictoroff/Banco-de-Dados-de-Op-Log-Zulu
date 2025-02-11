<?php
//inicia sessao 
session_start();


if (@$_SESSION['login'] == 'errada') {
  echo "<script>alert('Usuário e/ou senha inválido(s), Tente novamente!');</script>";
  unset($_SESSION['login']);
}
if (@$_SESSION['login'] == 'desativado') {
  echo "<script>alert('Conta desativada! Contate um operador');</script>";
  unset($_SESSION['login']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    
    <!--ANTIGO METODO
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="/public/css/index.css">-->
   
    <link rel="shortcut icon" type="imagex/png" href="/img/colog.png">
    <title>Login</title>

    <style>
        footer {
            background-color: #111827; /* Fundo escuro para o rodapé */
            color: #fff; /* Cor do texto no rodapé */
            padding: 20px;
            text-align: center;
        }
    </style>

  </head>

  <body class="Dark:bg-gray-800">
    <section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <!--LOGO-->
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="w-auto h-50 mr-2" src="/img/colog.png" alt="logo">
        </a>
        <!--TITULO-->
        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
          Banco de Dados de Op Log Zulu
        </h1>
        <br>
        <!--CAIXA DE LOGIN-->
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <!--TITULO-->
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Entrar na sua conta
                </h1>
                <!--FORM LOGIN-->
                <form class="space-y-4 md:space-y-6" method="post" action="/acoes/testLogin.php">
                    <!--NOME USUARIO-->
                    <div>
                        <label for="user" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome de usuario</label>
                        <input name= "user" required placeholder="Digite o usuário" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <!--SENHA USUARIO-->
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha</label>
                        <input type="password" name= "pass" required placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <!--ESQUECEU A SENHA (A SER IMPLEMENTADO)-->
                    <div class="flex items-center justify-between dark:text-gray-400">
                        <div class="flex items-start">
                        </div>
                        <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Esqueceu sua senha? </a>
                    </div>
                    <!--BOTÃO DE ENVIO-->
                    <input type="submit" name="submit" value="ENTRAR" class="w-full text-white bg-indigo-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"/>
                    <!--CADASTRO (SOLICITE SEU LOGIN)-->
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Não tem conta? <a href="cadastro.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Cadastrar</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
    </section>
    <footer>
      <p>&copy; 2025 Exército brasileiro. Divisão de Operações Logisticas</p>
    </footer>

  </body>
</html>

