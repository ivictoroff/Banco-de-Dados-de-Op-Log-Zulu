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

  <table  class= "border border-black">

     <!-- inicio do resumo -->

     <tr>
      <th class=" border border-black" colspan="<?php if(count($operacoes) <= 5){ echo "5";} else { echo count($operacoes);}?>">Total de Operações</th>
     </tr>
    <tr>
      <td class=" w-1/12 border border-black" colspan="<?php if(count($operacoes) <= 5){ echo "5";} else { echo count($operacoes); }?>"><?php echo count($operacoes); ?></td>
    </tr>
     <tr style="margin-right: 150px;" class=" border border-black">
      <th class=" border border-black" colspan="<?php if(count($operacoes) <= 5){ echo "5";} else { echo count($operacoes); }?>">Nomes das Operações</th>
    </tr>

    <tr class="border border-black ">
      <?php for ($i=0; $i<count($operacoes); $i++){ ?>
        <td class=" w-1/12 border border-black" colspan="<?php if(count($operacoes) <= 5){ echo 6/count($operacoes);} else { }?>"><?php echo $operacoes[$i]; ?></td>
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
      <td class=" w-1/12 border border-black" colspan="<?php if(count($operacoes) <= 5){ echo 6/count($operacoes);} else { }?>" ><?php echo $comandoArea[$i]; ?></td>
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
      <td class="w-1/12 border border-black" colspan="<?php if(count($operacoes) <= 5){ echo 6/count($operacoes);} else {}?>"><?php echo $tipoOp[$i]; ?></td>
      <?php
      }
      ?>
    </tr>
    <tr>
    <?php for ($i=0; $i<count($acao); $i++){ 
      ?>
      <td class="w-1/12 border border-black" colspan="<?php if(count($operacoes) <= 5){ echo 6/count($operacoes);} else { }?>"><?php echo $acao[$i]; ?></td>
      <?php
      }
      ?>
    </tr>
    </tr>
    <tr colspan="<?php echo count($operacoes)+1; ?>">
      <th class=" border border-black">Efetivo empregado</th>
      <th class="border border-black">Exército</th>
      <th class="border border-black">Marinha</th>
      <th class="border border-black">Força Áerea</th>
      <th class="border border-black">Outros</th>

    </tr>

    <tr>
      <td class="w-1/12 border border-black"><?php echo $efetivoEx+ $efetivoMb + $efetivoFab +$efetivoOutros ?></td>
      <td class="w-1/12 border border-black"><?php echo $efetivoEx; ?></td>
      <td class="w-1/12 border border-black"><?php echo $efetivoMb; ?></td>
      <td class="w-1/12 border border-black"><?php echo $efetivoFab; ?></td>
      <td class="w-1/12 border border-black"><?php echo $efetivoOutros; ?></td>
    </tr>

  </table>

  <!-- rodape -->
   
   <footer id="rodape">
    <h1>Exército Brasileiro Comando Logístico Diretoria de Material SMU, Bloco C, Térreo. CEP: 70630-901 Divisão de Tecnologia e Informação - Ramal 5451</h1>
  </footer>
</body>
</html>  
