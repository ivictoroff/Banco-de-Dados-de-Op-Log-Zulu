<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
if ((!isset($_SESSION['user'])== true) and (!isset($_SESSION['pass'])==true)){
  unset($_SESSION['user']);
  unset($_SESSION['pass']);
  header('Location: /banco/index.php');
} 
else {
  $usuario = $_SESSION['user'];
}
include ("bd.php");

// Conecta ao banco de dados

$servername = "localhost";
$username = "root";
$password = "@160l0nc3t";
$dbname = "dbmat";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Define os campos de pesquisa
$campos = array('operacao', 'operador', 'missao', 'estado', 'cma');

// Define a consulta SQL
$query = "SELECT * FROM operacao WHERE ";

// Adiciona os campos de pesquisa à consulta
foreach ($campos as $campo) {
    if (isset($campo)){
        @$query .= "$campo LIKE '%".$_GET[$campo]."%' AND ";
    }
}

// Remove o último "OR"
$query = substr($query, 0, -4);

// Executa a consulta
$result = $conn->query($query);

// Exibe os resultados
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["uid"] . "<br>";
        echo "Nome: " . $row["pg"] . "<br>";
        echo "E-mail: " . $row["usuario"] . "<br>";
        echo "Telefone: " . $row["adm"] . "<br>";
        echo "Endereço: " . $row["senha"] . "<br><br>";
    }
} else {
    echo "Nenhum resultado encontrado.";
}

// Fecha a conexão
$conn->close();

?>


?>

<DOCTYPE html>
<html> 
<head>

  <title>colog</title>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <link rel="shortcut icon" type="imagex/png" href="/img/dmat.png">
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
    td {
      background-color: #DFDFDF;
      text-align:center;
    }
    tr {
      background-color: #C3C3C3;
    }
    .conteudo {
      display: none;
    }
    
    .conteudo.ativo {
      display: block;
    }
  </style> 

</head>
<body>

  <aside id="separator-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
      <a href="#" class="flex items-center ps-1 mb-1">
        <img src="/banco/img/colog.png" class="h-3 me-2 sm:h-16" alt="Flowbite Logo" />
        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">B D Op Log ZULU</span>
      </a>
      <ul class="space-y-2 font-medium">
      <li>
        <a href="/banco/app/insercao/operacao.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
          <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 16">
            <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z"/>
            <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z"/>
            <path d="M8.5 6.5a.5.5 0 0 0-1 0V8H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V9H10a.5.5 0 0 0 0-1H8.5z"/>
          </svg>  
            <span class="ms-3">Inserção</span>
        </a>
      </li>
      <li>
        <a href="/banco/app/pesquisa/operacao.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
          <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
          </svg>
            <span class="ms-3">Pesquisa</span>
        </a>
          </li>
          <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">  
          <li>
            <a href="#" onclick="mostrarConteudo(1)" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 17">
               <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
              </svg>
               <span class="ms-3">Todas as operações</span>
            </a>
         </li>
         <li>
            <a href="#" onclick="mostrarConteudo(2)" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
              <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
              <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/>
              </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Minhas operações</span>
            </a>
         </li>
      <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
      <li>
            <a href="/banco/app/adm/adm.php" class="flex items-center p-2 text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
               <svg class="flex-shrink-0 w-6 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 16">
               <path d="M8.39 12.648a1 1 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-1.046l.476-2.304a1 1 0 0 0 .016-.164.51.51 0 0 0-.516-.516.54.54 0 0 0-.539.43l-.523 2.554H7.617l.477-2.304c.008-.04.015-.118.015-.164a.51.51 0 0 0-.523-.516.54.54 0 0 0-.531.43L6.53 5.484H5.414c-.43 0-.617.22-.617.532s.187.539.617.539h.906l-.515 2.523H4.609c-.421 0-.609.219-.609.531s.188.547.61.547h.976l-.516 2.492c-.008.04-.015.125-.015.18 0 .305.21.508.5.508.265 0 .492-.172.554-.477l.555-2.703h2.242zm-1-6.109h2.266l-.515 2.563H6.859l.532-2.563z"/>
              </svg>
               <span class="ms-3">Administrador</span>
            </a>
         </li>
         <li>
            <a href="/banco/acoes/sair.php" class="flex items-center p-2 text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
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

  

  <!-- inicio da tabela --> 
  <div class="conteudo ativo" id="conteudo-1">
    <div class="p-4 sm:ml-64">
      <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">

          <!-- campo de pesquisa --> 
          <form action="">
          <input class="border-2 rounded-lg border-slate-800" name="operacao" value="<?php if(isset($_GET['operacao'])) echo $_GET['operacao']; ?>" placeholder="nome da operacao" type="text">
          <br>
          <input class="border-2 rounded-lg border-slate-800" name="operador" value="<?php if(isset($_GET['operador'])) echo $_GET['operador']; ?>" placeholder="operador" type="text">
          <br>
          <input class="border-2 rounded-lg border-slate-800" name="missao" value="<?php if(isset($_GET['missao'])) echo $_GET['missao']; ?>" placeholder="missao" type="text">
          <br>
          <input class="border-2 rounded-lg border-slate-800" name="estado" value="<?php if(isset($_GET['estado'])) echo $_GET['estado']; ?>" placeholder="estado" type="text">
          <br>
          <input class="border-2 rounded-lg border-slate-800" name="cma" value="<?php if(isset($_GET['cma'])) echo $_GET['cma']; ?>" placeholder="cma" type="text">
          <br>
          <button class="border-2 rounded-lg border-slate-800" type="submit">Pesquisar</button>
        </form> <br>

        <table  class= " border border-slate-600">

          <!-- inicio do cabecalho da tabela -->

          <tr style="margin-right: 150px;" class=" border border-slate-600">
            <th class="border border-slate-600">Selecione</th>
            <th class="border border-slate-600">Operador</th>
            <th class="border border-slate-600">Operação</th>
            <th class="border border-slate-600">Missão</th>
            <th class="border border-slate-600">Estado</th>
            <th class="border border-slate-600">Comando Militar de Área</th>
            <th class="border border-slate-600">Região Militar</th>
            <th class="border border-slate-600">Comando da Operação</th>
            <th class="border border-slate-600">Comando Apoiado</th>
            <th class="border border-slate-600">Inicio da Operação</th>
            <th class="border border-slate-600">Fim da Operação</th> 
            <th class="border border-slate-600">Completo</th>
          </tr>
          <?php
            if (!isset($_GET['operador'])) {
              if (!isset($_GET['operacao'])) {

          ?>
          <tr>
            <td colspan="3">Digite algo para pesquisar...</td>
          </tr>
          <?php
            } 
            else {
              $pesquisa = $mysqli->real_escape_string($_GET['operacao']);
              $sql_code = "SELECT * 
                FROM operacao 
                WHERE operacao LIKE '%$pesquisa%'";

                $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error); 
                
            if ($sql_query->num_rows == 0) {
          ?>
          <tr>
              <td colspan="3">Nenhum resultado encontrado...</td>
          </tr>
          <?php
            } 
            else {
              while($dados = $sql_query->fetch_assoc()) {
          ?>
          <form action="salva.php" method="post">
          <tr class=" border border-slate-600 ">
            <td class="px-6 py-4 border border-slate-600"><input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="teste[]" value="<?php echo $dados['opid']; ?>"></td>
            <td class="px-6 py-4 border border-slate-600"><?php echo $dados['operador']; ?></td>
            <td class="px-6 py-4 border border-slate-600"><?php echo $dados['operacao']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['missao']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['estado']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['cma']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['rm']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['comandoOp']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['comandoApoio']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['inicioOp']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['fimOp']; ?></td>
            <td class="px-6 py-4"><a style="cursor: pointer;" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="abrirPesquisa(<?php echo $dados['opid']; ?>)" > Abrir </a> </td>
          </tr>
          <?php
                }
              }

            }
          }
            else {
              $pesquisa = $mysqli->real_escape_string($_GET['operador']);
              $sql_code = "SELECT * 
                FROM operacao 
                WHERE operador LIKE '%$pesquisa%'";

                $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error); 
                
            if ($sql_query->num_rows == 0) {
          ?>
          <tr>
              <td colspan="3">Nenhum resultado encontrado...</td>
          </tr>
          <?php
            } 
            else {
              while($dados = $sql_query->fetch_assoc()) {
          ?>
          <form action="salva.php" method="post">
          <tr class=" border border-slate-600 ">
            <td class="px-6 py-4 border border-slate-600"><input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="teste[]" value="<?php echo $dados['opid']; ?>"></td>
            <td class="px-6 py-4 border border-slate-600"><?php echo $dados['operador']; ?></td>
            <td class="px-6 py-4 border border-slate-600"><?php echo $dados['operacao']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['missao']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['estado']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['cma']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['rm']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['comandoOp']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['comandoApoio']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['inicioOp']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['fimOp']; ?></td>
            <td class="px-6 py-4"><a style="cursor: pointer;" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="abrirPesquisa(<?php echo $dados['opid']; ?>)" > Abrir </a> </td>
          </tr>
          <?php
                }
              }
            }
          ?>
          <input type="submit" class="border-2 rounded-lg border-slate-800" value="Gerar resumo">
          </form>

        </table>




      </div>
    </div>
  </div>

  <div class="conteudo" id="conteudo-2">
    <div class="p-4 sm:ml-64">
      <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
      <table  class= " border border-slate-600">

      <!-- inicio do cabecalho da tabela -->

      <tr style="margin-right: 150px;" class=" border border-slate-600">
        <th class="border border-slate-600">Selecione</th>
        <th class="border border-slate-600">Operação</th>
        <th class="border border-slate-600">Missão</th>
        <th class="border border-slate-600">Estado</th>
        <th class="border border-slate-600">Comando Militar de Área</th>
        <th class="border border-slate-600">Região Militar</th>
        <th class="border border-slate-600">Comando da Operação</th>
        <th class="border border-slate-600">Comando Apoiado</th>
        <th class="border border-slate-600">Inicio da Operação</th>
        <th class="border border-slate-600">Fim da Operação</th> 
        <th class="border border-slate-600">Completo</th>
        <th class="border border-slate-600">Editar</th>
      </tr>
      <?php
          $pesquisa = $mysqli->real_escape_string($usuario);
          $sql_code = "SELECT * 
            FROM operacao 
            WHERE operador LIKE '%$pesquisa%'";

            $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error); 
            
        if ($sql_query->num_rows == 0) {
      ?>
      <tr>
          <td colspan="3">Nenhum resultado encontrado...</td>
      </tr>
      <?php
        } 
        else {
          while($dados = $sql_query->fetch_assoc()) {
      ?>
      <form action="salva.php" method="post">
      <tr class=" border border-slate-600 ">
        <td class="px-6 py-4 border border-slate-600"><input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="teste[]" value="<?php echo $dados['opid']; ?>"></td>
        <td class="px-6 py-4 border border-slate-600"><?php echo $dados['operacao']; ?></td>
        <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['missao']; ?></td>
        <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['estado']; ?></td>
        <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['cma']; ?></td>
        <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['rm']; ?></td>
        <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['comandoOp']; ?></td>
        <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['comandoApoio']; ?></td>
        <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['inicioOp']; ?></td>
        <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['fimOp']; ?></td>
        <td class="px-6 py-4"><a style="cursor: pointer;" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="abrirPesquisa(<?php echo $dados['opid']; ?>)" > Abrir </a> </td>
        <td class="px-6 py-4"><a style="cursor: pointer; " class="content-center font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="abrirEdicao(<?php echo $dados['opid']; ?>)" > Editar </a> </td>
      </tr>
  <?php
      }
    }
  ?>
  <input type="submit" class="border-2 rounded-lg border-slate-800" value="Gerar resumo">
  </form>

        <!-- script da pesquisa pelo id da query --> 

        <script>
      function abrirPesquisa(id) {
        window.open('/banco/app/pesquisa/completo.php?id=' + id, '_blank');
      }
      function abrirEdicao(id) {
        window.open('/banco/app/insercao/update.php?id=' + id, '_blank');
      }

    </script>
    
  <script src="/banco/src/navbar.js"></script>

</body>
</html>  
