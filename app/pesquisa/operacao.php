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
  // Conecta ao banco de dados
  require '../../acoes/bd.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Pesquisa</title>
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

  <div class="conteudo ativo" id="conteudo-1">
  <form action="pesquisa.php" method="post">
      <div class="sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">a. Nome da Operação:</label>
              <input type="text" placeholder="Nome da Operação" name="operacao" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            <label for="estado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">b. Estado (UF):</label>
              <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="estado" name="estado" placeholder="estados">
                <option value="">Selecione o estado</option>
                <option value="Acre">Acre</option>
                <option value="Alagoas">Alagoas</option>
                <option value="Amapá">Amapá</option>
                <option value="Amazonas">Amazonas</option>
                <option value="Bahia">Bahia</option>
                <option value="Ceará">Ceará</option>
                <option value="Distrito Federal">Distrito Federal</option>
                <option value="Espírito Santo">Espírito Santo</option>
                <option value="Goiás">Goiás</option>
                <option value="Maranhão">Maranhão</option>
                <option value="Mato Grosso">Mato Grosso</option>
                <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                <option value="Minas Gerais">Minas Gerais</option>
                <option value="Pará">Pará</option>
                <option value="Paraíba">Paraíba</option>
                <option value="Paraná">Paraná</option>
                <option value="Pernambuco">Pernambuco</option>
                <option value="Piauí">Piauí</option>
                <option value="Rio de Janeiro">Rio de Janeiro</option>
                <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                <option value="Rondônia">Rondônia</option>
                <option value="Roraima">Roraima</option>
                <option value="Santa Catarina">Santa Catarina</option>
                <option value="São Paulo">São Paulo</option>
                <option value="Sergipe">Sergipe</option>
                <option value="Tocantins">Tocantins</option>
                <option value="Internacional">Internacional</option>
              </select>
            <label for="missao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">d. Missão:</label>
              <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="missao" placeholder="missão">
              
            <label for="cma" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">e. Comando Militar de Área:</label>
              <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="cma" name="cma" placeholder="comando militar de area">
                  <option value="">Selecione o Comando Militar de Área</option>
                  <option value="Comando Militar da Amazônia">Comando Militar da Amazônia</option>
                  <option value="Comando Militar do Leste">Comando Militar do Leste</option>
                  <option value="Comando Militar do Planalto">Comando Militar do Planalto</option>
                  <option value="Comando Militar do Norte">Comando Militar do Norte</option>
                  <option value="Comando Militar do Nordeste">Comando Militar do Nordeste</option>
                  <option value="Comando Militar do Oeste">Comando Militar do Oeste</option>
                  <option value="Comando Militar do Sudeste">Comando Militar do Sudeste</option>
                  <option value="Comando Militar do Sul">Comando Militar do Sul</option>
                  </select>
            <label for="rm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">f. Região Militar (RM):</label>
              <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="rm" name="rm">
                <option value=""> Selecione a Região Militar</option>
                <option value="1ª região militar">1ª região militar</option>
                <option value="2ª região militar">2ª região militar</option>
                <option value="3ª região militar">3ª região militar</option>
                <option value="4ª região militar">4ª região militar</option>
                <option value="5ª região militar">5ª região militar</option>
                <option value="6ª região militar">6ª região militar</option>
                <option value="7ª região militar">7ª região militar</option>
                <option value="8ª região militar">8ª região militar</option>
                <option value="9ª região militar">9ª região militar</option>
                <option value="10ª região militar">10ª região militar</option>
                <option value="11ª região militar">11ª região militar</option>
                <option value="12ª região militar">12ª região militar</option>
              </select>

            <label for="ComandoOp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">g. Comando da Operação:</label>
              <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="comandoOp" placeholder="comando da operação">
            <label for="comandoApoiado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">h. Organização apoiada:</label>
              <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="comandoApoio" placeholder="Organização apoiada">
            <label for="ini" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">i. Início da Operação:</label>
              <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="date" id="ini" name="inicioOp" placeholder="inicio da operação">
            <label for="fimOp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">j. Término da Operação:</label>                 
              <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="date" id="fim" name="fimOp" placeholder="término da operação"> <br>
              <button type="submit" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">PESQUISAR</button>
            </div>
    </div>
  </div>
  </form>

  <!-- script da navbar --> 
  <script src="/banco/src/navbar.js"></script>

  <!-- inicio da tabela --> 
  <div class="conteudo" id="conteudo-2">
    <div class="sm:ml-64">
      <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <table  class= "w-full text-center border border-slate-600">

          <!-- inicio do cabecalho da tabela -->

          <tr style="margin-right: 150px;" class=" border border-slate-600">
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
              <td colspan="11">Nenhuma Operação registrada por <?php echo $usuario ?>...</td>
          </tr>
          <?php
            } 
            else {
              while($dados = $sql_query->fetch_assoc()) {
          ?>
          <form action="#" method="post">
          <tr class=" border border-slate-600 ">
            <td class="px-6 py-4 border border-slate-600"><?php echo $dados['operacao']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['missao']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['estado']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['cma']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['rm']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['comandoOp']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['comandoApoio']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo date_format(date_create_from_format('Y-m-d', $dados["inicioOp"]), 'd/m/Y'); ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo date_format(date_create_from_format('Y-m-d', $dados["fimOp"]), 'd/m/Y'); ?></td>
            <td class="px-6 py-4"><a style="cursor: pointer;" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="abrirPesquisa(<?php echo $dados['opid']; ?>)" > Abrir </a> </td>
            <td class="px-6 py-4"><a style="cursor: pointer; " class="content-center font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="abrirEdicao(<?php echo $dados['opid']; ?>)" > Editar </a> </td>
          </tr>
          <?php
              }
            }
          ?>
          </form>
        </table>
      </div>
    </div>
  </div>

        <!-- script da pesquisa pelo id da query --> 

        <script>
      function abrirPesquisa(id) {
        window.open('/banco/app/pesquisa/completo.php?id=' + id, '_blank');
      }
      function abrirEdicao(id) {
        window.open('/banco/app/insercao/update.php?id=' + id, '_blank');
      }

    </script>
</body>
</html>