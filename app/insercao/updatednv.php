<?php

// inicia a seçao

session_start();

if ((!isset($_SESSION['user'])== true) and (!isset($_SESSION['pass'])==true)){
  unset($_SESSION['user']);
  unset($_SESSION['pass']);
  header('Location: /index.php');
} 
else {
  $usuario = $_SESSION['user'];
}

//anexos

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $relatorioFinal = $_FILES["relatorioFinal"];
  $relatorioComando = $_FILES["relatorioComando"];
  $fotos = $_FILES["fotos"];
  $outrasDocumentos = $_FILES["outrasDocumentos"];

  $dirUploads = "../../uploads";

  if (!is_dir($dirUploads)) {

      mkdir($dirUploads);

  }
  if (!empty($_FILES['relatorioFinal']['name'][0])) {
    
    if (move_uploaded_file($relatorioFinal["tmp_name"], $dirUploads . DIRECTORY_SEPARATOR . $relatorioFinal["name"])) {
        echo "Upload realizado com sucesso!";
        $relatorioFinalName = $relatorioFinal["name"];
    } else {
        throw new Exception("Não foi possível reaizar o upload.");
  
    }
  }
  if (!empty($_FILES['relatorioComando']['name'][0])) {
    
    if (move_uploaded_file($relatorioComando["tmp_name"], $dirUploads . DIRECTORY_SEPARATOR . $relatorioComando["name"])) {
        echo "Upload realizado com sucesso!";
        $relatorioComandoName = $relatorioComando["name"];
    } else {
        throw new Exception("Não foi possível reaizar o upload.");
  
    }
  }
  if (!empty($_FILES['fotos']['name'][0])) {
    
    if (move_uploaded_file($fotos["tmp_name"], $dirUploads . DIRECTORY_SEPARATOR . $fotos["name"])) {
        echo "Upload realizado com sucesso!";
        $fotosName = $fotos["name"];
    } else {
        throw new Exception("Não foi possível reaizar o upload.");
  
    }
  }
  if (!empty($_FILES['outrasDocumentos']['name'][0])) {
    
    if (move_uploaded_file($outrasDocumentos["tmp_name"], $dirUploads . DIRECTORY_SEPARATOR . $outrasDocumentos["name"])) {
        echo "Upload realizado com sucesso!";
        $outrasDocumentosName = $outrasDocumentos["name"];
    } else {
        throw new Exception("Não foi possível reaizar o upload.");
  
    }
  }
}


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

//outras infos

$outrasInfos = @$_REQUEST['outrasInfos'];

// anexos 

$submit= @$_REQUEST['submit'];

$conn = new PDO ("mysql:dbname=dbmat;host=localhost", "root", "@160l0nc3t");

if ($submit) {

  /* insere os dados das operacoes */

  $stmt = $conn->prepare("INSERT INTO operacao (operador, operacao,estado, missao, cma, rm, comandoOp, comandoApoio, inicioOp, fimOp) VALUES (:OPERADOR, :OPERACAO, :ESTADO, :MISSAO, :CMA, :RM, :COMANDOOP, :COMANDOAPOIO, :INICIOOP, :FIMOP)");

  $stmt -> bindParam(":OPERADOR", $usuario);
  $stmt -> bindParam(":OPERACAO", $operacao);
  $stmt -> bindParam(":ESTADO", $estado);
  $stmt -> bindParam(":MISSAO", $missao);
  $stmt -> bindParam(":CMA", $cma);
  $stmt -> bindParam(":RM", $rm);
  $stmt -> bindParam(":COMANDOOP", $comandoOp);
  $stmt -> bindParam(":COMANDOAPOIO", $comandoApoio);
  $stmt -> bindParam(":INICIOOP", $inicioOp);
  $stmt -> bindParam(":FIMOP", $fimOp);

  $stmt->execute();

  /* insere os dados do efetivo */

  $stmt = $conn->prepare("INSERT INTO efetivo (participantes,participantesEb, participantesMb,participantesFab,participantesOs,participantesGov,participantesPv,participantesCv) VALUES (:PARTICIPANTES, :PARTICIPANTESEB, :PARTICIPANTESMB, :PARTICIPANTESFAB, :PARTICIPANTESOS, :PARTICIPANTESGOV, :PARTICIPANTESPV, :PARTICIPANTESCV)");
  $stmt -> bindParam(":PARTICIPANTES", $participantes);
  $stmt -> bindParam(":PARTICIPANTESEB", $participantesEb);
  $stmt -> bindParam(":PARTICIPANTESMB", $participantesMb);
  $stmt -> bindParam(":PARTICIPANTESFAB", $participantesFab);
  $stmt -> bindParam(":PARTICIPANTESOS", $participantesOs);
  $stmt -> bindParam(":PARTICIPANTESGOV", $participantesGov);
  $stmt -> bindParam(":PARTICIPANTESPV", $participantesPv);
  $stmt -> bindParam(":PARTICIPANTESCV", $participantesCv);

  $stmt -> execute();

  /* insere os dados dos tipos de operacoes */

  $stmt = $conn->prepare("INSERT INTO tipoOp (tipoOp,acaoOuApoio, transporte, manutencao, suprimento, aviacao, desTransporte, desManutencao, desSuprimento, desAviacao) VALUES (:TIPOOP, :ACAOOUAPOIO, :TRANSPORTE, :MANUTENCAO, :SUPRIMENTO, :AVIACAO, :DESTRANSPORTE, :DESMANUTENCAO, :DESSUPRIMENTO, :DESAVIACAO)");
  $stmt -> bindParam(":TIPOOP", $tipoOp);
  $stmt -> bindParam(":ACAOOUAPOIO", $acaoOuApoio);
  $stmt -> bindParam(":TRANSPORTE", $transporte);
  $stmt -> bindParam(":MANUTENCAO",$manutencao);
  $stmt -> bindParam(":SUPRIMENTO",$suprimento);
  $stmt -> bindParam(":AVIACAO",$aviacao);
  $stmt -> bindParam(":DESTRANSPORTE", $desTransporte);
  $stmt -> bindParam(":DESMANUTENCAO",$desManutencao);
  $stmt -> bindParam(":DESSUPRIMENTO",$desSuprimento);
  $stmt -> bindParam(":DESAVIACAO",$desAviacao);

  $stmt -> execute();

  /* insere os dados dos recursos aprovisionados */

  $stmt = $conn->prepare("INSERT INTO recursos (recebidos,descentralizados, empenhados, devolvidos) VALUES (:RECEBIDOS, :DESCENTRALIZADO, :EMPENHADOS, :DEVOLVIDOS)");
  $stmt -> bindParam(":RECEBIDOS", $recebidos);
  $stmt -> bindParam(":DESCENTRALIZADO", $descentralizados);
  $stmt -> bindParam(":EMPENHADOS", $empenhados);
  $stmt -> bindParam(":DEVOLVIDOS", $devolvidos);

  $stmt -> execute();

  /* insere os dados de outras informacoes */

  $stmt = $conn->prepare("INSERT INTO infos (outrasInfos) VALUES (:OUTRASINFOS)");
  $stmt -> bindParam(":OUTRASINFOS", $outrasInfos);

  $stmt -> execute();

    /* insere os dados dos anexos */

  $stmt = $conn->prepare("INSERT INTO anexos (relatorioFinal,relatorioComando,fotos,outrosDocumentos) VALUES (:RELATORIOFINAL,:RELATORIOCOMANDO,:FOTOS,:OUTROSDOCUMENTOS)");
  $stmt -> bindParam(":RELATORIOFINAL", $relatorioFinalName);
  $stmt -> bindParam(":RELATORIOCOMANDO", $relatorioComandoName);
  $stmt -> bindParam(":FOTOS", $fotosName);
  $stmt -> bindParam(":OUTROSDOCUMENTOS", $outrasDocumentosName);

  $stmt -> execute();
$operacoes;
  header("Location: /banco/app/pesquisa/operacao.php");

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
           $operacoes = $dados['operacao'];
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


?>


<DOCTYPE html>
<html> 
<head>
  <title>colog</title>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="favicon.ico" type="/banco/img/dmat.ico">
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
      <a href="" id="atual"><img src="/banco/img/pranchetaAtual.png" style="padding-right:30px;"></a>
      <a href="/banco/app/pesquisa/operacao.php"><img src="/banco/img/lupa.png"></a>
    </div>
    <div class="text-white flex gap-2 items-end mx-2">
      <a href="/banco/acoes/sair.php">
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
      
  <!-- inicio formulario --> 
  <form method="POST" enctype="multipart/form-data">

    <!-- dados das operacoes -->
    <div class="conteudo ativo" id="conteudo-1">
            <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">a. Nome da Operação:</label>
              <input type="text" value="<?php echo $dados['operacao'];?>" placeholder="Nome da Operação" name="operacao" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required  required />
            <label for="estado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">b. Estado (UF):</label>
              <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required id="estado" name="estado" placeholder="estados">
                <option value="null">selecione o estado</option>
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
                <option value="Estrangeiro">Estrangeiro</option>
              </select>
            <label for="missao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">d. Missão:</label>
              <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required type="text" name="missao" placeholder="missão">
              
            <label for="cma" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">e. Comando Militar de Área:</label>
              <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required id="cma" name="cma" placeholder="comando militar de area">
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
              <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required id="rm" name="rm">
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
              <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required type="text" name="comandoOp" placeholder="comando da operação">
            <label for="comandoApoiado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">h. Organização apoiada:</label>
              <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required type="text" name="comandoApoiado" placeholder="Organização apoiada">
            <label for="ini" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">i. Início da Operação:</label>
              <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required type="date" id="ini" name="inicioOp" placeholder="inicio da operação">
            <label for="fimOp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">j. Término da Operação:</label>
              <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required type="date" id="fim" name="fimOp" placeholder="término da operação">
    </div>
    
    <!-- efetivo -->
    <div class="conteudo" id="conteudo-2">

              <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">a. Participantes:</label>
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required type="text" name="participantes" placeholder="participantes">
              <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">b. participantes do Exército brasileiro:</label>
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required type="number" name="participantesEb" placeholder="participantes do exercito Brasileiro">
              <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">c. Participantes da Marinha do Brasil:</label>
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" name="participantesMb" placeholder="participantes da marinha do Brasil">
              <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">d. Participantes da Força Aérea Brasileira:</label>
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" name="participantesFab" placeholder="participantes da forca aérea Brasileira">
              <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">e. Participantes de Órgãos de Segurança e Ordenamento Pública:</label>
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" name="participantesOs" placeholder="participantes de orgãos de Segurança e Ordem Pública">
              <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">f. Participantes de outras Agências Governamentais:</label>
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" name="participantesGov" placeholder="participantes de outras agências governamentais">
              <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">g. Participantes de outras Agências Privadas:</label>
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" name="participantesPv" placeholder="participantes de outras agências privadas">
              <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">h. Participantes de Organizações Não-Governamentais:</label>
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" name="participantesCv" placeholder="participantes de organizações não governamentais">
    </div>

    <!-- tipos de operacoes -->
    <div class="conteudo" id="conteudo-3">
              
      <label for="tipoOp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">a. Operação:</label>
        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required id="tipoOp" name="tipoOp">
          <option value="">Selecione o tipo de operação</option>
          <option value="Preparo">Preparo</option>
          <option value="Emprego">Emprego</option>
        </select>
      <label for="acaoOuApoio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">b. Tipo de de Ação ou Apoio:</label>
        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required id="acaoOuApoio" name="acaoOuApoio">
          <option value="">Selecione o tipo de Ação ou Apoio</option>
          <option value="logística para Operações de Garantia da Soberania">logística para Operações de Garantia da Soberania</option>
          <option value="logística de apoio a operacoes garantia da lei e da ordem">logística de apoio a operacoes garantia da lei e da ordem</option>
          <option value="logística de apoio a garantia da votação e apuração">logística de apoio a garantia da votação e apuração </option>
          <option value="logística de apoio a defesa civil">logística de apoio a defesa civil</option>
          <option value="logística de apoio as ações subsidiarias">logística de apoio as ações subsidiarias</option>
          <option value="logística de apoio a operacoes internacionais">logística de apoio a operacoes internacionais</option>
        </select>
      <label for="apoioDesempenhado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">c. Ação ou Apoio Desempenhado:</label>
      <label for="Transporte" class="block mb-2 text-sm text-gray-900 dark:text-white">1) Transporte:</label>
        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="transporte" name="transporte">
          <option value="">Selecione a Classe</option>
          <option value="Classe I">Classe I</option>
          <option value="Classe II">Classe II</option>
          <option value="Classe III">Classe III</option>
          <option value="Classe VI">Classe IV</option>
          <option value="Classe V">Classe V</option>
          <option value="Classe VI">Classe VI</option>
          <option value="Classe VII">Classe VII</option>
          <option value="Classe VIII">Classe VIII</option>
          <option value="Classe IX">Classe IX</option>
          <option value="Classe X">Classe X</option>
        </select>
        <label for="apoioDesempenhado" class="block mb-2 text-sm text-gray-900 dark:text-white">Descreva a Ação ou Apoio:</label>
        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="desTransporte" placeholder="Transporte">
      <label for="manutencao" class="block mb-2 text-sm text-gray-900 dark:text-white">2) Manutenção:</label>
        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="manutencao" name="manutencao">
          <option value="">Selecione a Classe</option>
          <option value="Classe I">Classe I</option>
          <option value="Classe II">Classe II</option>
          <option value="Classe III">Classe III</option>
          <option value="Classe IV">Classe IV</option>
          <option value="Classe V">Classe V</option>
          <option value="Classe VI">Classe VI</option>
          <option value="Classe VII">Classe VII</option>
          <option value="Classe VIII">Classe VIII</option>
          <option value="Classe IX">Classe IX</option>
          <option value="Classe X">Classe X</option>
        </select>
      <label for="desManutencao" class="block mb-2 text-sm text-gray-900 dark:text-white">Descreva a Ação ou Apoio:</label>
        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="desManutencao" placeholder="Manutenção">
      <label for="suprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">3) Suprimento:</label>
        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="suprimento" name="suprimento">
          <option value="">Selecione a Classe</option>
          <option value="Classe I">Classe I</option>
          <option value="Classe II">Classe II</option>
          <option value="Classe III">Classe III</option>
          <option value="Classe IV">Classe IV</option>
          <option value="Classe V">Classe V</option>
          <option value="Classe VI">Classe VI</option>
          <option value="Classe VII">Classe VII</option>
          <option value="Classe VIII">Classe VIII</option>
          <option value="Classe IX">Classe IX</option>
          <option value="Classe X">Classe X</option>
        </select>
      <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">Descreva a Ação ou Apoio:</label>
        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="desSuprimento" placeholder="Suprimento">
      <label for="aviacao" class="block mb-2 text-sm text-gray-900 dark:text-white">4) Aviação:</label>
        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="aviacao" name="aviacao">
          <option value="">Selecione a Classe</option> 
          <option value="Classe I">Classe I</option>
          <option value="Classe II">Classe II</option>
          <option value="Classe III">Classe III</option>
          <option value="Classe IV">Classe IV</option>
          <option value="Classe V">Classe V</option>
          <option value="Classe VI">Classe VI</option>
          <option value="Classe VII">Classe VII</option>
          <option value="Classe VIII">Classe VIII</option>
          <option value="Classe IX">Classe IX</option>
          <option value="Classe X">Classe X</option>
        </select>
      <label for="desAviacao" class="block mb-2 text-sm text-gray-900 dark:text-white">Descreva a Ação ou Apoio:</label>
        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="desAviacao" placeholder="Aviação">
    </div>

    <!-- recursos aprovisionados --> 
    <div class="conteudo" id="conteudo-4">
      <label for="recebidos" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">a. Recebidos:</label>
        <input value="R$:" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required type="number" name="recebidos" placeholder="recebidos">
      <label value="R$:" for="empenhados" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">b. Empenhados:</label>
        <input value="R$:" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required type="text" name="descentralizados" placeholder="descentralizados">
      <label for="liquidados" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">c. Liquidados:</label>  
        <input value="R$:" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required type="text" name="empenhados" placeholder="empenhados">
      <label for="devolvidos" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">d. Devolvidos:</label>
        <input value="R$:" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required type="text" name="devolvidos" placeholder="devolvidos">
        
    </div>

    <!-- otras informacoes --> 
    <div class="conteudo" id="conteudo-5">
      <div style="text-align:center;" class="content-center">
          <textarea class=" border-2 rounded-lg border-slate-950 w-10/12 h-36" name="outrasInfos" id="" placeholder="outras informações"></textarea>
      </div>
    </div>

    <!-- otras informacoes --> 
    <div class="conteudo" id="conteudo-6">       
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">a. Relatório Final:</label>
        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="relatorioFinal" type="file">
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">b. Relatório do Comando Logístico:</label>
        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="relatorioComando" type="file">
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">c. Fotos:</label>
        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="fotos" type="file">
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">d. Outros documentos:</label>
        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="outrasDocumentos" type="file">
      <div class="mt-2">
          <input type="submit" name="submit" value="SALVAR" class=" flex w-12/6 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"/>
      </div>
    </div>

  </form>

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