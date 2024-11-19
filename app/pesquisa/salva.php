<?php

$ids = null;

if (isset($_POST['teste'])){
    $ids = $_POST['teste'];
}
else{
  header ('location: /banco/app/pesquisa/operacao.php');
}

session_start();

if ((!isset($_SESSION['user'])== true) and (!isset($_SESSION['pass'])==true)){
  unset($_SESSION['user']);
  unset($_SESSION['pass']);
  header('Location: /banco/index.php');
} 
else {
  $usuario = $_SESSION['user'];
}

include('bd.php');
// Pega o ID da URL

// Conecta ao banco de dados
$servername = "localhost";
$username = "root";
$password = "@160l0nc3t";
$dbname = "dbmat";

$conn = new mysqli($servername, $username, $password, $dbname);

// Executa a consulta SQL
for ($i=0; $i < count($ids); $i++) { 
    $query = "SELECT * FROM operacao WHERE opid = '$ids[$i]'";
}

$result = $conn->query($query);

$recursosRecebidos = 0;
$efetivo;
$efetivoEx =0;
$efetivoMb = 0;
$efetivoFab =0;
$efetivoOutros=0;

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

           $efetivoEx += $dados2['participantesEb']; 
           $efetivoMb += $dados2['participantesMb']; 
           $efetivoFab += $dados2['participantesFab']; 
           $efetivoOutros += $dados2['participantesOs']; 
           $efetivoOutros += $dados2['participantesGov']; 
           $efetivoOutros += $dados2['participantesPv']; 
           $efetivoOutros += $dados2['participantesCv']; 
           $recursosRecebidos += $dados4['recebidos']; 
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

// Fecha a conexão com o banco de dados
$conn->close();

?>

<DOCTYPE html>
<html> 
<head>

  <title>colog</title>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <link rel="shortcut icon" type="imagex/png" href="/img/dmat.png">
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
  <div class="conteudo ativo" id="conteudo-1">
  <aside id="separator-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
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
        <a href="#" onclick="ocultar(2)" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
          <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 16">
          <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
          <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
          </svg>
            <span class="ms-1">Ocultar</span>
        </a>
      </li>
      <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
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
  </div>

  <div class="vai p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
      <table class= "border border-black">

      <!-- inicio do resumo -->

      <tr>
        <th class=" border border-black" colspan="<?php if(count($operacoes) <= 5){ echo "5";} else { echo count($operacoes);}?>">Total de Operações</th>
      </tr>

      <tr>
        <td class="w-1/12 border border-black" colspan="<?php if(count($operacoes) <= 5){ echo "5";} else { echo count($operacoes); }?>"><?php echo count($operacoes); ?></td>
      </tr>

      <tr style="margin-right: 150px;" class=" border border-black">
        <th class=" border border-black" colspan="<?php if(count($operacoes) <= 5){ echo "5";} else { echo count($operacoes); }?>">Nomes das Operações</th>
      </tr>

      <tr class="border border-black">
        <?php for ($i=0; $i<count($operacoes); $i++){ ?>
          <td class="px-6 py-4  w-1/12 border border-black" colspan="<?php if(count($operacoes) <= 5){ echo 6/count($operacoes);} else { }?>"><?php echo $operacoes[$i]; ?></td>
        <?php
        }
        ?>
      </tr>

      <tr>
        <th class=" border border-black" colspan="<?php if(count($operacoes) <= 5){ echo "5";} else { echo count($operacoes); }?>"">Comandos Militares de Área</th>
      </tr>

      <tr>
        <?php
        for ($i=0; $i<count($comandoArea); $i++){ ?>
        <td class="px-6 py-4  w-1/12 border border-black" colspan="<?php if(count($operacoes) <= 5){ echo 6/count($operacoes);} else { }?>" ><?php echo $comandoArea[$i]; ?></td>
        <?php
        }
        ?>
      </tr>

      <tr>
        <th class=" border border-black" colspan="<?php if(count($operacoes) <= 5){ echo "5";} else {echo count($operacoes); }?>"">Tipo de Operação</th>
      </tr>

      <tr>
      <?php for ($i=0; $i<count($tipoOp); $i++){ 
      ?>
        <td class="px-6 py-4 w-1/12 border border-black" colspan="<?php if(count($operacoes) <= 5){ echo 6/count($operacoes);} else {}?>"><?php echo $tipoOp[$i]; ?></td>
      <?php
        }
      ?>
      </tr>

      <tr>
      <?php for ($i=0; $i<count($acao); $i++){ 
      ?>
        <td class="px-6 py-4 w-1/12 border border-black" colspan="<?php if(count($operacoes) <= 5){ echo 6/count($operacoes);} else { }?>"><?php echo $acao[$i]; ?></td>
      <?php
        }
      ?>
      </tr>

      <tr colspan="<?php echo count($operacoes)+1; ?>">
        <th class=" border border-black">Efetivo empregado</th>
        <th class="border border-black">Exército</th>
        <th class="border border-black">Marinha</th>
        <th class="border border-black">Força Áerea</th>
        <th class="border border-black">Outros</th>
      </tr>

      <tr>
        <td class="px-6 py-4 w-1/12 border border-black"><?php echo $efetivoEx+ $efetivoMb + $efetivoFab +$efetivoOutros ?></td>
        <td class="px-6 py-4 w-1/12 border border-black"><?php echo $efetivoEx; ?></td>
        <td class="px-6 py-4 w-1/12 border border-black"><?php echo $efetivoMb; ?></td>
        <td class="px-6 py-4 w-1/12 border border-black"><?php echo $efetivoFab; ?></td>
        <td class="px-6 py-4 w-1/12 border border-black"><?php echo $efetivoOutros; ?></td>
      </tr>

    </table>
    </div>
  </div>

  <!-- script da navbar --> 
  <script src="/banco/src/navbar.js"></script>

</body>
</html>  
