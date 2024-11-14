<?php

$ids = null;

if (isset($_POST['teste'])){
    $ids = $_POST['teste'];
}

?>

<?php
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
$ids;
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
  </style> 

</head>
<body>

  <!-- inicio do cabeçalho --> 

  <header class="flex bg-neutral-950 shadow-xl shadow-slate-400 px-8 py-4 justify-between sticky top-0 z-10"> 
    <div id= "area-principal" style="display: flex; ">
      <a href="/banco/app/insercao/operacao.php" id=""><img src="/banco/img/prancheta.png" style="padding-right:30px;"></a>
      <a href="/banco/app/pesquisa/operacao.php"><img src="/banco/img/lupaAtual.png"></a>
    </div>
    <div class="text-white flex gap-2 items-end mx-2">
      <a href="/acoes/sair.php">
        <button class="mr-2 text-pink-600"> Log Out <i class="fa-solid fa-user"></i></button>
      </a>
    </div>
  </header>


  <!-- inicio da tabela --> 

  <table  class= " border border-slate-600">

    <?php
      if (!isset($ids)) {
    ?>
    <tr>
      <td colspan="3">Digite algo para pesquisar...</td>
    </tr>
    <?php
      } 
      else {
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

      if ($sql_query->num_rows == 0) {
    ?>
    <tr>
        <td colspan="3">Nenhum resultado encontrado...</td>
    </tr>
    <?php
      } 
      else {
        while($dados = $sql_query->fetch_assoc()) {
          while ($dados2 = $sql_query2->fetch_assoc()) {
            while ($dados3 = $sql_query3->fetch_assoc()) {
              while ($dados4 = $sql_query4->fetch_assoc()) {
                while ($dados5 = $sql_query5->fetch_assoc()) {
                  while ($dados6 = $sql_query6->fetch_assoc()) {
    ?>
    <!-- inicio do cabecalho da tabela -->

      <?php $efetivoEx += $dados2['participantesEb']; ?>
      <?php $efetivoMb += $dados2['participantesMb']; ?>
      <?php $efetivoFab += $dados2['participantesFab']; ?>
      <?php $efetivoOutros += $dados2['participantesOs']; ?>
      <?php $efetivoOutros += $dados2['participantesGov']; ?>
      <?php $efetivoOutros += $dados2['participantesPv']; ?>
      <?php $efetivoOutros += $dados2['participantesCv']; ?>
      <?php $recursosRecebidos += $dados4['recebidos']; ?>

    
 
    <?php
                  }
                }
              }
            }
          }
        }
      }
    }
  }
    ?>
     <!-- inicio do resumo -->

     <tr style="margin-right: 150px;" class=" border border-slate-600">
      <th class=" border border-slate-600">Total de Operações:</th>
      <th class=" border border-slate-600">Recursos recebidos:</th>
      <th class=" border border-slate-600" colspan="4">Efetivo empregado:</th>
      <th class=" border border-slate-600">Exército</th>
      <th class=" border border-slate-600">Marinha</th>
      <th class=" border border-slate-600">Força Áerea Brasileira</th>
      <th class=" border border-slate-600">Outros</th>
    </tr>
    <tr class="border border-slate-600 ">
      <td class=" border border-slate-600"><?php echo count($ids); ?></td>
      <td class=" border border-slate-600"><?php echo $recursosRecebidos ?></td>
      <td class=" border border-slate-600" colspan="4"><?php echo $efetivoEx+ $efetivoMb + $efetivoFab +$efetivoOutros ?></td>
      <td class=" border border-slate-600"><?php echo $efetivoEx; ?></td>
      <td class=" border border-slate-600"><?php echo $efetivoMb; ?></td>
      <td class=" border border-slate-600"><?php echo $efetivoFab; ?></td>
      <td class=" border border-slate-600"><?php echo $efetivoOutros; ?></td>

    </tr>
    <!-- script da pesquisa pelo id da query --> 

    <script>
      function abrirPesquisa(id) {
        window.open('/banco/app/pesquisa/completo.php?id=' + id, '_blank');
      }

    </script>

  </table>

  <!-- rodape -->
   
  <!-- <footer id="rodape">
    <h1>Exército Brasileiro Comando Logístico Diretoria de Material SMU, Bloco C, Térreo. CEP: 70630-901 Divisão de Tecnologia e Informação - Ramal 5451</h1>
  </footer> --> 
</body>
</html>  
