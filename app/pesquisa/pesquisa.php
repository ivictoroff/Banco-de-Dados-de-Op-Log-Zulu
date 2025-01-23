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
 <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
 <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
 <title>Pesquisa</title>
  <style>
    a.disabled {
      pointer-events: none;
      cursor: default;
      color: #cccccc;
    }
  </style>
</head>
<body>

<aside id="separator-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
      <a href="#" class="flex items-center ps-1 mb-1">
        <img src="/banco/img/colog.png" class="h-10 me-2 sm:h-16" alt="Flowbite Logo" />
        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">B D Op Log ZULU</span>
      </a>
      <ul class="space-y-2 font-medium">
      <li>
      <a href="/banco/acoes/cargo.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
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
  
</body>
</html>
<div class="Content sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
      <?php

      // Define os campos de pesquisa
      $campos = array('operacao', 'estado', 'missao', 'cma', 'rm', 'comandoOp', 'comandoApoio', 'tipoOp');

      $query = "SELECT * FROM operacao WHERE ";

      if (!empty($_POST['inicioOp']) && !empty($_POST['fimOp'])) {
        $data_inicial =  $_POST['inicioOp'];
        $data_final = $_POST['fimOp'];
        
        $query .= "inicioOp >= '".$data_inicial."' AND fimOp <= '".$data_final."'";
        
        if (!empty($_POST['operacao'])||!empty($_POST['estado'])||!empty($_POST['missao'])||!empty($_POST['cma'])||!empty($_POST['rm'])||!empty($_POST['comandoOp'])||!empty($_POST['comandoApoio'])) {
          foreach ($campos as $campo) {
          $query .= " AND $campo LIKE '%".$_POST[$campo]."%'";
          } 
        }
    } else {
        // Busca sem datas
        foreach ($campos as $campo) {
          if (isset($campo)){
            @$query .= "$campo LIKE '%".$_POST[$campo]."%' AND ";
          }
      }
      // Remove o último "OR"
      $query = substr($query, 0, -4);
    }

    //print_r($query);
    
      // Executa a consulta
      $result = $mysqli->query($query);
      // Exibe os resultados
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $ids[] = $row['opid'];
          }
      
      foreach ($ids as $id){
          $pesquisa = $mysqli->real_escape_string($id);
          $sql_code = "SELECT * 
            FROM operacao 
            WHERE opid LIKE '%$pesquisa%'";
          $sql_code2 = "SELECT * 
            FROM efetivo 
            WHERE eid LIKE '%$pesquisa%'";
          $sql_code3 = "SELECT * 
            FROM tipoOp 
            WHERE tid LIKE '%$pesquisa%'";
          $sql_code4 = "SELECT * 
            FROM recursos 
            WHERE rid LIKE '%$pesquisa%'";
          $sql_code5 = "SELECT * 
            FROM infos
            WHERE iid LIKE '%$pesquisa%'";
          $sql_code6 = "SELECT * 
            FROM anexos
            WHERE aid LIKE '%$pesquisa%'";
        
          $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error); 
          $sql_query2 = $mysqli->query($sql_code2) or die("ERRO ao consultar! " . $mysqli->error); 
          $sql_query3 = $mysqli->query($sql_code3) or die("ERRO ao consultar! " . $mysqli->error); 
          $sql_query4 = $mysqli->query($sql_code4) or die("ERRO ao consultar! " . $mysqli->error); 
          $sql_query5 = $mysqli->query($sql_code5) or die("ERRO ao consultar! " . $mysqli->error); 
          $sql_query6 = $mysqli->query($sql_code6) or die("ERRO ao consultar! " . $mysqli->error); 
        
          while($dados = $sql_query->fetch_assoc()) {
            while ($dados2 = $sql_query2->fetch_assoc()) {
              while ($dados3 = $sql_query3->fetch_assoc()) {
                while ($dados4 = $sql_query4->fetch_assoc()) {
                  while ($dados5 = $sql_query5->fetch_assoc()) {
                    while ($dados6 = $sql_query6->fetch_assoc()) {
        
                    @$recursosLiquidados += $dados4['liquidados'];
                    @$recursosRecebidos += $dados4['recebidos'];
                    @$recursosDescentralizados += $dados4['descentralizados']; 
                    @$recursosDevolvidos += $dados4['devolvidos']; 
                    
        
                    @$efetivoEx += $dados2['participantesEb']; 
                    @$efetivoMb += $dados2['participantesMb']; 
                    @$efetivoFab += $dados2['participantesFab']; 
                    @$efetivoOutros += $dados2['participantesOs']; 
                    @$efetivoOutros += $dados2['participantesGov']; 
                    @$efetivoOutros += $dados2['participantesPv']; 
                    @$efetivoOutros += $dados2['participantesCv']; 
                    $operacoes[] = $dados['operacao'];
                    $comandoArea[] = $dados['cma'];
                    $tipoOp[] = $dados3['tipoOp'];
                    $acao[] = $dados3['desTransporte']. " ". $dados3['desManutencao']. " ". $dados3['desSuprimento']. " ". $dados3['desAviacao'];
                    }
                  }
                }
              }
            }
          }
        }

        // Fecha a conexão
        echo '1. Resumo' ;
        ?>

        <table class="w-full text-center">
          <tr class="">
            <th class=" border border-slate-600"> <?php echo "Total de operações: " . count($ids) ; ?></th>
            <th class=" border border-slate-600"> <?php echo "Recursos Liquidados: " . $recursosLiquidados ; ?> </th>
          </tr>
          <tr>
            <td class="border border-slate-600"> <?php echo "Efetivo empregado: " . $efetivoEx+ $efetivoMb + $efetivoFab +$efetivoOutros . "<br>"; ?>
            <?php echo "Exército: " . $efetivoEx . "<br>"; ?>
            <?php echo "Marinha: " . $efetivoMb . "<br>"; ?>
            <?php echo "Força áerea: " . $efetivoFab . "<br>"; ?>
            <?php echo "Outras forças: " . $efetivoOutros . "<br>"; ?></td>
            <td class="border border-slate-600"><?php echo "Recursos Recebidos: " . $recursosRecebidos . "<br>";
              echo "Recursos Devolvidos: " . $recursosDevolvidos . "<br>";
              echo "Recursos Descentralizados: " . $recursosDescentralizados . "<br>";
            ?></td>
          </tr>
        </table>
        <?php

        echo '<br>' . '2. Operações Relacionadas' . "<br>";

        ?>

        <table  class= "w-full text-center border border-slate-600">

        <!-- inicio do cabecalho da tabela -->

        <tr style="margin-right: 150px;" class=" border border-slate-600 ">
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
        foreach ($ids as $id){
          $pesquisa = $mysqli->real_escape_string($id);
          $sql_code = "SELECT * 
            FROM operacao 
            WHERE opid LIKE '%$pesquisa%'";
          $sql_code2 = "SELECT * 
            FROM efetivo 
            WHERE eid LIKE '%$pesquisa%'";
          $sql_code3 = "SELECT * 
            FROM tipoOp 
            WHERE tid LIKE '%$pesquisa%'";
          $sql_code4 = "SELECT * 
            FROM recursos 
            WHERE rid LIKE '%$pesquisa%'";
          $sql_code5 = "SELECT * 
            FROM infos
            WHERE iid LIKE '%$pesquisa%'";
          $sql_code6 = "SELECT * 
            FROM anexos
            WHERE aid LIKE '%$pesquisa%'";
          $sql_code7 = "SELECT * 
            FROM usuario 
            WHERE usuario ='$usuario' and adm ='administrador'";
        
          $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error); 
          $sql_query2 = $mysqli->query($sql_code2) or die("ERRO ao consultar! " . $mysqli->error); 
          $sql_query3 = $mysqli->query($sql_code3) or die("ERRO ao consultar! " . $mysqli->error); 
          $sql_query4 = $mysqli->query($sql_code4) or die("ERRO ao consultar! " . $mysqli->error); 
          $sql_query5 = $mysqli->query($sql_code5) or die("ERRO ao consultar! " . $mysqli->error); 
          $sql_query6 = $mysqli->query($sql_code6) or die("ERRO ao consultar! " . $mysqli->error); 
          while($dados = $sql_query->fetch_assoc()) {
            while ($dados2 = $sql_query2->fetch_assoc()) {
              while ($dados3 = $sql_query3->fetch_assoc()) {
                while ($dados4 = $sql_query4->fetch_assoc()) {
                  while ($dados5 = $sql_query5->fetch_assoc()) {
                    while ($dados6 = $sql_query6->fetch_assoc()) {
                    ?>

                    <form action="/banco/src/pdf/gerar_pdf.php" method="post">
                    <tr class="border border-slate-600">
                      <?php
                      foreach ($ids as $chave => $valor) { ?>
                        <input type="hidden" name="ids[<?= $chave ?>]" value="<?= $valor ?>">
                      <?php } ?>
                      <td class="px-6 py-4 border border-slate-600"><?php echo $dados['operacao']; ?></td>
                      <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['missao']; ?></td>
                      <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['estado']; ?></td>
                      <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['cma']; ?></td>
                      <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['rm']; ?></td>
                      <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['comandoOp']; ?></td>
                      <td class="px-6 py-4 border border-slate-600 "><?php echo $dados['comandoApoio']; ?></td>
                      <td class="px-6 py-4 border border-slate-600 "><?php echo date_format(date_create_from_format('Y-m-d', $dados["inicioOp"]), 'd/m/Y'); ?></td>
                      <td class="px-6 py-4 border border-slate-600 "><?php echo date_format(date_create_from_format('Y-m-d', $dados["fimOp"]), 'd/m/Y'); ?></td>
                      <td class="px-6 py-4 border border-slate-600 "><a style="cursor: pointer;" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="abrirPesquisa(<?php echo $dados['opid']; ?>)" > Abrir </a> </td>
                      <td class="px-6 py-4"><a style="cursor: pointer; " class="" onclick="abrirEdicao(<?php echo $dados['opid']; ?>)" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                         <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                         <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                        </svg> </a> </td>
                    </tr>
                  <?php
                    }
                  }
                }
              }
            }
          }
        }

        $mysqli->close();
        ?>
        <button type="submit" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Gerar PDF</button>
         
          <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 inline-flex items-center focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-1 text-center me-1 mb-1 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800" type="button"> Selecione os campos <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
          </svg>
          </button>

          <!-- Dropdown menu -->
          <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
              <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
              <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                  <div class="flex items-center ps-3">
                  <input id="operacao" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="teste[]" value="operacao">
                      <label for="operacao" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Operação</label>
                  </div>
              </li>
              <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                  <div class="flex items-center ps-3">
                  <input id="efetivo" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="teste[]" value="efetivo">
                      <label for="efetivo" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Efetivo</label>
                  </div>
              </li>
              <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                  <div class="flex items-center ps-3">
                  <input id="tipoop" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="teste[]" value="tipoop">
                      <label for="tipoop" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tipos de Operações</label>
                  </div>
              </li>
              <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                  <div class="flex items-center ps-3">
                  <input id="recurso" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="teste[]" value="recurso">
                      <label for="recurso" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Recursos</label>
                  </div>
              </li>
              <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                  <div class="flex items-center ps-3">
                  <input id="resumo" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="teste[]" value="resumo">
                      <label for="resumo" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Resumo</label>
                  </div>
              </li>
              </ul>
          </div>

        </form>
        <?php
        }else {
          echo "Nenhum resultado encontrado.";
        }
        ?>

        <script src="/banco/src/pdf.js"></script>

        
        <!-- script da pesquisa pelo id da query --> 

        <script>
      function abrirPesquisa(id) {
        window.open('/banco/app/pesquisa/completo.php?id=' + id, '_blank');
      }
      function abrirEdicao(id) {
        window.open('/banco/app/insercao/update.php?id=' + id, '_blank');
      }

    </script>
    </div>
</div>