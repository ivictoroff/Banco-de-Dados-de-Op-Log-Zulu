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
$id = $_GET['id'];

// Conecta ao banco de dados
$servername = "localhost";
$username = "root";
$password = "@160l0nc3t";
$dbname = "dbmat";

$conn = new mysqli($servername, $username, $password, $dbname);


//operação

$operacao = @$_REQUEST['operacao'];
$estado = @$_REQUEST['estado'];
$missao = @$_REQUEST['missao'];
$cma = @$_REQUEST['cma'];
$rm = @$_REQUEST['rm'];
$comandoOp = @$_REQUEST['comandoOp'];
$comandoApoio = @$_REQUEST['comandoApoiado'];
$inicioOp = @$_REQUEST['inicioOp'];
$fimOp = @$_REQUEST['fimOp'];

//efetivo

$participantes = @$_REQUEST['participantes'];
$participantesEb = @$_REQUEST['participantesEb'];
$participantesMb = @$_REQUEST['participantesMb'];
$participantesFab = @$_REQUEST['participantesFab'];
$participantesOs = @$_REQUEST['participantesOs'];
$participantesGov = @$_REQUEST['participantesGov'];
$participantesPv = @$_REQUEST['participantesPv'];
$participantesCv = @$_REQUEST['participantesCv'];

//tipos de operações

$tipoOp = @$_REQUEST['tipoOp'];
$acaoOuApoio = @$_REQUEST['acaoOuApoio'];
$transporte = @$_REQUEST['transporte'];
$manutencao = @$_REQUEST['manutencao'];
$suprimento = @$_REQUEST['suprimento'];
$aviacao = @$_REQUEST['aviacao'];
$desTransporte = @$_REQUEST['desTransporte'];
$desManutencao = @$_REQUEST['desManutencao'];
$desSuprimento = @$_REQUEST['desSuprimento'];
$desAviacao = @$_REQUEST['desAviacao'];


//recursos aprovisionados

$recebidos = @$_REQUEST['recebidos'];
$descentralizados = @$_REQUEST['descentralizados'];
$empenhados = @$_REQUEST['empenhados'];
$devolvidos = @$_REQUEST['devolvidos'];

$idd = 0;

$idd = $_REQUEST['iddd'];

//outras infos

$outrasInfos = @$_REQUEST['outrasInfos'];

// anexos 

// Executa a consulta SQL
$query = "SELECT * FROM operacao WHERE opid = '$id'";
$result = $conn->query($query);


$submit= @$_REQUEST['submit'];

$conn = new PDO ("mysql:dbname=dbmat;host=localhost", "root", "@160l0nc3t");

if ($submit) {

  /* insere os dados das operacoes */

  
  $sql = "UPDATE operacao SET operacao= :OPERACAO  WHERE opid=:ID";
  $as = 1;
  $stmt = $conn->prepare ($sql);

  $stmt -> bindParam(":OPERACAO", $operacao);


  $stmt -> bindParam(":ID", $idd);

  $stmt->execute();

  header("Location: /banco/app/pesquisa/operacao.php");
}

// Fecha a conexão com o banco de dados

?>

<DOCTYPE html>
<html> 
<head>
  
  <title>colog</title>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  
  <style>
    #atual {
      color: #f7b600;
    }
    
    .conteudo {
      display: none;
    }
    
    .conteudo.ativo {
      display: block;
    }
    .active {
      color: #f7b600;
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

  <!-- inicio da navebar --> 
  <div style="text-align:center;" >
    <header class="flex bg-neutral-950 shadow-xl shadow-slate-400 px-8 py-4 justify-between sticky top-0 z-10"> 
        <a href="#" class="tab active" onclick="mostrarConteudo(1)" style="padding-right: 15px;">DADOS DAS OPERAÇÕES</a>
        <a href="#" class="tab" onclick="mostrarConteudo(2)" style="padding-right: 15px;">EFETIVO</a>
        <a href="#" class="tab" onclick="mostrarConteudo(3)" style="padding-right: 15px;">TIPOS DE OPERAÇÕES</a>
        <a href="#" class="tab" onclick="mostrarConteudo(4)" style="padding-right: 15px;">RECURSOS PROVISIONADOS</a>
        <a href="#" class="tab" onclick="mostrarConteudo(5)" style="padding-right: 15px;">OUTRAS INFORMAÇÕES</a>
        <a href="#" class="tab" onclick="mostrarConteudo(6)">ANEXOS</a>
    </header>
  </div>
  
  <!-- id da query sendo pesquisado -->
  <form action="">
    <input disabled class="border-2 rounded-lg border-slate-800" name="busca" value="<?php if(isset($id)) echo $id; ?>" placeholder="Digite os termos de pesquisa" type="text">
  </form> <br>

    <?php
      if (!isset($_GET['id'])) {
    ?>
    <?php
      } 
      else {
        $pesquisa = $mysqli->real_escape_string($_GET['id']);
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
    <div class="conteudo ativo" id="conteudo-1">
      <form>
      <input type="text" name="iddd" value="<?php echo $dados['opid'];?>"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">a. Nome da Operação</label>
      <input type="text"  value="<?php echo $dados['operacao'];?>" name="operacao" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
      <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">b. Estado(UF):</label>
      <input type="text" name="estado" value="<?php echo $dados['estado'];?>"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
      <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">d. Missão:</label>
      <input type="text" name="missao" value="<?php echo $dados['missao']; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">e. Comando Militar de Área:</label>
      <input type="text" name="cma" value="<?php echo $dados['cma']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">f. Região Militar (RM):</label>
      <input type="text" name="rm" value="<?php echo $dados['rm']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">g. Comando da Operação:</label>
      <input type="text" name="comandoOp" value="<?php echo $dados['comandoOp']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">h. Organização apoiada:</label>
      <input type="text" name="comandoApoio" value="<?php echo $dados['comandoApoio']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">i. Início da Operação:</label>
      <input type="date" name="inicioOp" value="<?php echo $dados['inicioOp']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">j. Término da Operação:</label>
      <input type="date" name="fimOp" value="<?php echo $dados['fimOp']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>

    <div class="conteudo" id="conteudo-2">
      <input type="text" value="<?php echo $dados2['participantes']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <input type="text" value="<?php echo $dados2['participantesEb']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <input type="text" value="<?php echo $dados2['participantesMb']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <input type="text" value="<?php echo $dados2['participantesFab']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <input type="text" value="<?php echo $dados2['participantesOs']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <input type="text" value="<?php echo $dados2['participantesGov']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <input type="text" value="<?php echo $dados2['participantesPv']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <input type="text" value="<?php echo $dados2['participantesCv']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>

    <div class="conteudo" id="conteudo-3">
      <input type="text" value="<?php echo $dados3['tipoOp']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <input type="text" value="<?php echo $dados3['acaoOuApoio']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <input type="text" value="<?php echo $dados3['transporte']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <input type="text" value="<?php echo $dados3['manutencao']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <input type="text" value="<?php echo $dados3['suprimento']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <input type="text" value="<?php echo $dados3['aviacao']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <input type="text" value="<?php echo $dados3['desTransporte']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <input type="text" value="<?php echo $dados3['desManutencao']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <input type="text" value="<?php echo $dados3['desSuprimento']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <input type="text" value="<?php echo $dados3['desAviacao']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>

    <div class="conteudo" id="conteudo-4">
      <input type="text" value="<?php echo $dados4['recebidos']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <input type="text" value="<?php echo $dados4['descentralizados']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <input type="text" value="<?php echo $dados4['empenhados']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <input type="text" value="<?php echo $dados4['devolvidos']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>

    <div class="conteudo" id="conteudo-5">
      <input type="text" value="<?php echo $dados5['outrasInfos']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>

        <!-- otras informacoes --> 
        <div class="conteudo" id="conteudo-6">       
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">a. Relatório Final:</label>
        <input value="<?php echo $dados6['relatorioFinal']; ?>" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="relatorioFinal" type="file">
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">b. Relatório do Comando Logístico:</label>
        <input value="<?php echo $dados6['relatorioComando']; ?>" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="relatorioComando" type="file">
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">c. Fotos:</label>
        <input value="<?php echo $dados6['fotos']; ?>" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="fotos" type="file">
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">d. Outros documentos:</label>
        <input value="<?php echo $dados6['outrosDocumentos']; ?>" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="outrasDocumentos" type="file">
      <div class="mt-2">
          
      </div>
    </div>
    <input type="submit" name="submit" value="SALVAR" class=" flex w-12/6 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"/>
  </form>

    <?php
              }
            }
          }
        }
      }
    }
  }
}



    ?>
<!-- script da navbar --> 
  <script>
    // Função para mostrar o conteúdo
    function mostrarConteudo(pagina) {
      // Esconde todos os conteúdos
      document.querySelectorAll('.conteudo').forEach(conteudo => {
        conteudo.classList.remove('ativo');
      });
      
      // Mostra o conteúdo selecionado
      document.getElementById(`conteudo-${pagina}`).classList.add('ativo');
      
      // Adiciona classe active ao tab selecionado
      document.querySelectorAll('.tab').forEach(tab => {
        tab.classList.remove('active');
      });
      document.querySelector(`.tab:nth-child(${pagina})`).classList.add('active');
    }
  </script>
</body>
</html>  
