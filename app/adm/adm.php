<?php
session_start();

date_default_timezone_set('America/Sao_Paulo');
//VERIFICA SE EXISTE SESSAO 
if ((!isset($_SESSION['user'])== true) and (!isset($_SESSION['pass'])==true)){
  unset($_SESSION['user']);
  unset($_SESSION['pass']);
  header('Location: /index.php');
} 
//SE EXISTIR USUARIO RECEBE SESSION USER
else {
  $usuario = $_SESSION['user'];
}

// Conecta ao banco de dados
require '../../acoes/bd.php';
//SELECIONA TODOS USUARIOS QUE SÃO ADM
$sql = "SELECT * FROM usuario WHERE usuario = '$usuario' and adm = 'Administrador'";
//EXECUTA SQL
$result = $mysqli -> query($sql);
//NAO EXISTIR DIRECIONA PARA TELA INICIAL 
if (mysqli_num_rows($result) < 1) {
  header('Location: /app/pesquisa/operacao.php');
}


?>

<DOCTYPE html>
<html> 
<head>
  <!--<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">-->
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.1/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.1/dist/flowbite.min.js"></script>
  
  <title>Administrador</title>
  <link rel="shortcut icon" type="imagex/png" href="/img/colog.png">
  
  <style>
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
  
    .conteudo {
      display: none;
    }
    .conteudo.ativo {
      display: block;
    }
  </style> 

</head>
<body class="bg-white dark:bg-gray-800">
<!-- inicio sidebar --> 

<aside id="separator-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
      <a href="#" class="flex items-center ps-1 mb-1">
        <img src="/img/colog.png" class="h-10 me-3 sm:h-20 center" alt="Logo" />
        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">B D Op Log ZULU</span>
      </a>
      <ul class="space-y-2 font-medium">
      <li>
      <a href="/acoes/cargo.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
          <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 16">
            <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z"/>
            <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z"/>
            <path d="M8.5 6.5a.5.5 0 0 0-1 0V8H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V9H10a.5.5 0 0 0 0-1H8.5z"/>
          </svg>  
            <span class="ms-3">Inserção</span>
        </a>
      </li>
      <li>
        <a href="/app/pesquisa/operacao.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
          <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
          </svg>
            <span class="ms-3">Pesquisa</span>
        </a>
          </li>
          <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">  
          <li>
            <a href="#" onclick="mostrarConteudo(2)" class="flex items-center p-2 text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
               <svg class="flex-shrink-0 w-6 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
               <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
              </svg>
               <span class="ms-3">Usuários</span>
            </a>
         </li>
          <li>
            <a href="#" onclick="mostrarConteudo(1)" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 15">
               <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
              </svg>
               <span class="ms-3">Acessos</span>
            </a>
         </li>
         <li>
            <a href="#" onclick="mostrarConteudo(3)" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 15">
               <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
              </svg>
               <span class="ms-3">Operações Registradas</span>
            </a>
         </li>
      <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
         <li>
            <a href="/acoes/sair.php" class="flex items-center p-2 text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 16">
                <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
                <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
              </svg>
               <span class="ms-3">log Out</span>
            </a>
         </li>
      </ul>
   </div>
  </aside>

  <!-- inicio da tabela "acessos" --> 
  <div class="conteudo" id="conteudo-1">
    <div class="sm:ml-64">
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="w-full text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <table  class= "w-full text-center border border-slate-600">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="px-6 py-3">Usuário </th>
                <th scope="col" class="px-6 py-3">Horário de Login</th>
              </tr>
            </thead>
            <tbody class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <?php              
                $sql_code = "SELECT * FROM loglogin ORDER BY data DESC" ;
                $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error); 
                while($dados = $sql_query->fetch_assoc()) {
              ?>

              <tr class="bg-white text-black border-b upper case dark:bg-gray-800 dark:border-gray-700 border-gray-200 dark:text-white">
                <th scope="row" class="px-6 py-4"><?php echo $dados['usuario'] ?></th>
                <td class="px-6 py-4"><?php echo date_format(date_create_from_format('Y-m-d H:i:s', $dados["data"]), 'd/m/Y H:i:s'); ?></td>
              </tr>

              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- inicio da tabela "USUARIO" -->        
  <div class="conteudo ativo" id="conteudo-2">

  <div class="sm:ml-64">
  <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
  
  <form action="/acoes/permissao.php" method="post">

    <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Insira o ID:</label>
    <input type="text" name="uid" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/6 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <br>
    <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cargos:</label>
    <input type="submit" name="administrador" value="Administrador" class="w-1/7 text-white bg-red-800 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"/>
    <input type="submit" name="gerente" value="Gerente" class="w-1/7 text-white bg-red-800 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"/>
    <input type="submit" name="on" value="Usuario" class="w-1/7 text-white bg-red-800 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"/> <br><br>
    <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Funções:</label>
    <input type="submit" name="Preparo" value="Preparo" class="w-1/7 text-white bg-red-800 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"/>
    <input type="submit" name="Emprego" value="Emprego" class="w-1/7 text-white bg-red-800 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"/>
    <input type="submit" name="Transporte" value="Transporte" class="w-1/7 text-white bg-red-800 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"/>
    <input type="submit" name="Remover" value="Remover" class="w-1/7 text-white bg-red-800 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"/>
    <br>
    <br>
    <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status do usuário:</label>
    <input type="submit" name="ativar" value="Ativar Usuário" class="w-1/7 text-white bg-red-800 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"/>
    <input type="submit" name="desativar" value="Desativar Usuário" class="w-1/7 text-white bg-red-800 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"/>
  </form>
  
  </div>
  </div>
  
    <!-- script da navbar --> 
    <script src="/src/navbar.js"></script>

    <!-- tela de adm -->

    <div class="sm:ml-64">
      <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">  
        <table  class= "p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <!-- inicio do cabecalho da tabela -->
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">        
        <tr class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <th class="w-80 border border-slate-600">ID</th>
          <th class="w-80 border border-slate-600">P/G</th>
          <th class="w-80 border border-slate-600">Nome de guerra</th>
          <th class="w-80 border border-slate-600">Solicitação</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $pesquisa = $mysqli->real_escape_string("on");
            $sql_code = "SELECT * FROM usuario WHERE adm LIKE '%$pesquisa%'";
            $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error); 
              
          if ($sql_query->num_rows == 0) {
          ?>
          <tr>
            <td colspan="5" class="bg-gray-700 text-white text-x uppercase dark:text-gray-400 ">Nenhuma solicitação pendente.</td>
          </tr>
          <?php
          } 
          else {
            while($dados = $sql_query->fetch_assoc()) {
          ?>
          <tr class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <td class="w-80 px-6 py-4 border border-slate-600"><?php echo $dados['uid']; ?></td>
            <td class="w-80 px-6 py-4 border border-slate-600"><?php echo $dados['pg']; ?></td>
            <td class="w-80 px-6 py-4 border border-slate-600"><?php echo $dados['usuario']; ?></td>
            <td class="w-80 px-6 py-4 border border-slate-600"><?php echo $dados['adm']; ?></td>
          </tr>
          <?php
          }
          }
          ?>
          </tbody>
        </table>
      </div>
    </div>

      <div class="sm:ml-64">
      <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">

      <form action="">
          <input class="border-2 rounded-lg border-slate-800" name="busca" value="<?php if(isset($_GET['busca'])) echo $_GET['busca']; ?>" placeholder="Digite os termos de pesquisa" type="text">
          <button class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 
            focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg 
            dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 " type="submit">
            Pesquisar
          </button>
      </form> <br>
      
        <table  class= " border border-slate-600">

          <!-- inicio do cabecalho da tabela -->
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr style="margin-right: 150px;" class=" border border-slate-600">
            <th class="w-80 border border-slate-600">ID</th>
            <th class="w-80 border border-slate-600">Posto/Graduação</th>
            <th class="w-80 border border-slate-600">Nome de Guerra</th>
            <th class="w-80 border border-slate-600">Cargo</th>
            <th class="w-80 border border-slate-600">Função</th>
            <th class="w-80 border border-slate-600">Status</th>
          </tr>
          </thead>
          <tbody>
          <?php
              $pesquisa = $mysqli->real_escape_string(@$_GET['busca']);
              $sql_code = "SELECT * 
                FROM usuario 
                WHERE pg LIKE '%$pesquisa%' 
                OR uid LIKE '%$pesquisa%'
                OR usuario LIKE '%$pesquisa%'
                OR adm LIKE '%$pesquisa%'
                OR funcao LIKE '%$pesquisa%'";

                $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error); 
                
            if ($sql_query->num_rows == 0) {
          ?>
          <tr>
              <td class="bg-gray-700 text-white uppercase text-xs dark:text-gray-400"colspan="3">Nenhum resultado encontrado...</td>
          </tr>
          <?php
            } 
            else {
              while($dados = $sql_query->fetch_assoc()) {
          ?>
          <tr class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <td class="px-6 py-4 border border-slate-600"><?php echo $dados['uid']; ?> </td>
            <td class="px-6 py-4 border border-slate-600"><?php echo $dados['pg']; ?> </td>
            <td class="px-6 py-4 border border-slate-600"><?php echo $dados['usuario']; ?></td>
            <td class="px-6 py-4 border border-slate-600"><?php echo $dados['adm']; ?></td>
            <td class="px-6 py-4 border border-slate-600"><?php echo $dados['funcao']; ?></td>
            <td class="px-6 py-4 border border-slate-600"><?php echo $dados['status']; ?></td>
          </tr>
          <?php
                }
              }
          ?>
        </table>
      </div>
    </div>


  </div>

      <!-- inicio da tabela --> 
  <div class="conteudo" id="conteudo-3">
    <div class="sm:ml-64">
      <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">        
          <table  class= "w-full text-center border border-slate-600">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">  
            <tr>
              <th scope="col" class="px-6 py-3">Usuário </th>
              <th scope="col" class="px-6 py-3">Nome da Operação</th>
              <th scope="col" class="px-6 py-3">Horário da inserção</th>
            </tr>
          </thead>
          <tbody class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <?php 
          
          $sql_code = "SELECT * 
              FROM logins ORDER BY data DESC";
          $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error); 
          while($dados = $sql_query->fetch_assoc()) {
            ?>
          <tr class="bg-white text-black border-b upper case dark:bg-gray-800 dark:border-gray-700 border-gray-200 dark:text-white">
            <th scope="row" class="px-6 py-4"><?php echo $dados['usuario'] ?></th>
            <td class="px-6 py-4"><?php echo $dados['operacao'] ?></td>
            <td class="px-6 py-4"><?php echo date_format(date_create_from_format('Y-m-d H:i:s', $dados["data"]), 'd/m/Y H:i:s'); ?></td>
          </tr>
            <?php
          }

          ?>
          </tbody>    
        </table>
      </div>
    </div>
  </div>

        <!-- script da pesquisa pelo id da query --> 

        <script>
      function abrirPesquisa(id) {
        window.open('/app/pesquisa/completo.php?id=' + id, '_blank');
      }
      function abrirEdicao(id) {
        window.open('/app/insercao/update.php?id=' + id, '_blank');
      }

    </script>
    
  <script src="/src/navbar.js"></script>

</body>
</html>  
