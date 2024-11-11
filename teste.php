<?php

//anexos

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $relatorioFinal = $_FILES["relatorioFinal"];
  $relatorioComando = $_FILES["relatorioComando"];
  $fotos = $_FILES["fotos"];
  $outrasDocumentos = $_FILES["outrasDocumentos"];

  $dirUploads = "../uploads";

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


$conn = new PDO ("mysql:dbname=dbmat;host=localhost", "root", "");
if ($submit) {

    $stmt = $conn->prepare("INSERT INTO operacao (operacao,estado, missao, cma, rm, comandoOp, comandoApoio, inicioOp, fimOp) VALUES (:OPERACAO, :ESTADO, :MISSAO, :CMA, :RM, :COMANDOOP, :COMANDOAPOIO, :INICIOOP, :FIMOP)");

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

    $stmt = $conn->prepare("INSERT INTO recursos (recebidos,descentralizados, empenhados, devolvidos) VALUES (:RECEBIDOS, :DESCENTRALIZADO, :EMPENHADOS, :DEVOLVIDOS)");
    $stmt -> bindParam(":RECEBIDOS", $recebidos);
    $stmt -> bindParam(":DESCENTRALIZADO", $descentralizados);
    $stmt -> bindParam(":EMPENHADOS", $empenhados);
    $stmt -> bindParam(":DEVOLVIDOS", $devolvidos);

    $stmt -> execute();

    $stmt = $conn->prepare("INSERT INTO infos (outrasInfos) VALUES (:OUTRASINFOS)");
    $stmt -> bindParam(":OUTRASINFOS", $outrasInfos);

    $stmt -> execute();

    $stmt = $conn->prepare("INSERT INTO anexos (relatorioFinal,relatorioComando,fotos,outrosDocumentos) VALUES (:RELATORIOFINAL,:RELATORIOCOMANDO,:FOTOS,:OUTROSDOCUMENTOS)");
    $stmt -> bindParam(":RELATORIOFINAL", $relatorioFinalName);
    $stmt -> bindParam(":RELATORIOCOMANDO", $relatorioComandoName);
    $stmt -> bindParam(":FOTOS", $fotosName);
    $stmt -> bindParam(":OUTROSDOCUMENTOS", $outrasDocumentosName);

    $stmt -> execute();

  header("Location: /app/pesquisa/operacao.php");
}

?>




<!DOCTYPE html>
<html>
<head>
	<title>Paginacao</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
	<style>
		/* Estilo para a paginacao */
		.paginacao {
			display: none;
		}
		
		/* Estilo para o botão de próxima página */
		.proxima-pagina {
			display: block;
		}
	</style>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
	<!-- Página 1 -->
	<div class="paginacao" id="pagina-1">
		<h2>Página 1</h2>
          <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">a. Nome da Operação:</label>
            <input type="text" name="operacao" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required />
          <label for="estado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">b. Estado (UF):</label>
            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="estado" name="estado" placeholder="estados">
              <option value="null">selecione o estado</option>
              <option value="AC">Acre</option>
              <option value="AL">Alagoas</option>
              <option value="AP">Amapá</option>
              <option value="AM">Amazonas</option>
              <option value="BA">Bahia</option>
              <option value="CE">Ceará</option>
              <option value="DF">Distrito Federal</option>
              <option value="ES">Espírito Santo</option>
              <option value="GO">Goiás</option>
              <option value="MA">Maranhão</option>
              <option value="MT">Mato Grosso</option>
              <option value="MS">Mato Grosso do Sul</option>
              <option value="MG">Minas Gerais</option>
              <option value="PA">Pará</option>
              <option value="PB">Paraíba</option>
              <option value="PR">Paraná</option>
              <option value="PE">Pernambuco</option>
              <option value="PI">Piauí</option>
              <option value="RJ">Rio de Janeiro</option>
              <option value="RN">Rio Grande do Norte</option>
              <option value="RS">Rio Grande do Sul</option>
              <option value="RO">Rondônia</option>
              <option value="RR">Roraima</option>
              <option value="SC">Santa Catarina</option>
              <option value="SP">São Paulo</option>
              <option value="SE">Sergipe</option>
              <option value="TO">Tocantins</option>
              <option value="EX">Estrangeiro</option>
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
              <option value="primeira">1ª região militar</option>
              <option value="segunda">2ª região militar</option>
              <option value="terceira">3ª região militar</option>
              <option value="quarta">4ª região militar</option>
              <option value="quinta">5ª região militar</option>
              <option value="sexta">6ª região militar</option>
              <option value="setima">7ª região militar</option>
              <option value="oitava">8ª região militar</option>
              <option value="nona">9ª região militar</option>
              <option value="decima">10ª região militar</option>
              <option value="decima-primeira">11ª região militar</option>
              <option value="decima-segunda">12ª região militar</option>
            </select>

          <label for="ComandoOp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">g. Comando da Operação:</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="comandoOp" placeholder="comando da operação">
          <label for="comandoApoiado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">h. Organização apoiada:</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="comandoApoiado" placeholder="comando apoiado">
          <label for="ini" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">i. Início da Operação:</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="date" id="ini" name="inicioOp" placeholder="inicio da operação">
          <label for="fimOp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">j. Término da Operação:</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="date" id="fim" name="fimOp" placeholder="término da operação">
            <button class="proxima-pagina" onclick="mostrarPagina(2)">Próxima página</button>
            </div>
	</div>
	
	<!-- Página 2 -->
	<div class="paginacao" id="pagina-2" style="display:none;">
		<h2>Página 2</h2>
            <div id class="mt-6">
            <header class="block bg-neutral-950 shadow-xl shadow-slate-400 px-8 py-4 justify-between sticky top-0 z-10"> 
                <div style="text-align:center;">
                <h1 style="text-align: center;">EFETIVO</h1>
                </div>
              </header>
            </div>
            <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">a. Participantes:</label>
              <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="participantes" placeholder="participantes">
            <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">b. participantes do Exército brasileiro:</label>
              <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" name="participantesEb" placeholder="participantes do exercito Brasileiro">
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
              <button class="proxima-pagina" onclick="mostrarPagina(3)">Próxima página</button>
	</div>
	
	<!-- Página 3 -->
	<div class="paginacao" id="pagina-3" style="display:none;">
		<h2>Página 3</h2>
            
            <label for="tipoOp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">a. Operação:</label>
              <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="tipoOp" name="tipoOp">
                <option value="Preparo">PREPARO</option>
                <option value="Emprego">EMPREGO</option>
                </select>
            <label for="acaoOuApoio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">b. Tipo de de Ação ou Apoio:</label>
              <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="acaoOuApoio" name="acaoOuApoio">
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
                <option value="Classe I">Classe I</option>
                <option value="Classe II">Classe II</option>
                <option value="Classe II">Classe III</option>
                <option value="Classe II">Classe IV</option>
                <option value="Classe II">Classe V</option>
                <option value="Classe II">Classe VI</option>
                <option value="Classe II">Classe VII</option>
                <option value="Classe II">Classe VIII</option>
                <option value="Classe II">Classe IX</option>
                <option value="Classe II">Classe X</option>
              </select>
              <label for="apoioDesempenhado" class="block mb-2 text-sm text-gray-900 dark:text-white">Descreva a Ação ou Apoio:</label>
              <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="desTransporte" placeholder="Transporte">
            <label for="manutencao" class="block mb-2 text-sm text-gray-900 dark:text-white">2) Manutenção:</label>
              <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="manutencao" name="manutencao">
                <option value="Classe I">Classe I</option>
                <option value="Classe II">Classe II</option>
                <option value="Classe II">Classe III</option>
                <option value="Classe II">Classe IV</option>
                <option value="Classe II">Classe V</option>
                <option value="Classe II">Classe VI</option>
                <option value="Classe II">Classe VII</option>
                <option value="Classe II">Classe VIII</option>
                <option value="Classe II">Classe IX</option>
                <option value="Classe II">Classe X</option>
              </select>
              <label for="desManutencao" class="block mb-2 text-sm text-gray-900 dark:text-white">Descreva a Ação ou Apoio:</label>
              <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="desManutencao" placeholder="Manutenção">
            <label for="suprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">3) Suprimento:</label>
              <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="suprimento" name="suprimento">
                <option value="Classe I">Classe I</option>
                <option value="Classe II">Classe II</option>
                <option value="Classe II">Classe III</option>
                <option value="Classe II">Classe IV</option>
                <option value="Classe II">Classe V</option>
                <option value="Classe II">Classe VI</option>
                <option value="Classe II">Classe VII</option>
                <option value="Classe II">Classe VIII</option>
                <option value="Classe II">Classe IX</option>
                <option value="Classe II">Classe X</option>
              </select>
              <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">Descreva a Ação ou Apoio:</label>
              <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="desSuprimento" placeholder="Suprimento">
            <label for="aviacao" class="block mb-2 text-sm text-gray-900 dark:text-white">4) Aviação:</label>
              <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="aviacao" name="aviacao">
                <option value="Classe I">Classe I</option>
                <option value="Classe II">Classe II</option>
                <option value="Classe II">Classe III</option>
                <option value="Classe II">Classe IV</option>
                <option value="Classe II">Classe V</option>
                <option value="Classe II">Classe VI</option>
                <option value="Classe II">Classe VII</option>
                <option value="Classe II">Classe VIII</option>
                <option value="Classe II">Classe IX</option>
                <option value="Classe II">Classe X</option>
              </select>
              <label for="desAviacao" class="block mb-2 text-sm text-gray-900 dark:text-white">Descreva a Ação ou Apoio:</label>
              <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="desAviacao" placeholder="Aviação">
              <button class="proxima-pagina" onclick="mostrarPagina(4)">Próxima página</button>
            </div>

    <div class="paginacao" id="pagina-4" style="display:none;">
          <label for="recebidos" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">a. Recebidos:</label>
            <input value="R$:" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="recebidos" placeholder="recebidos">
          <label value="R$:" for="empenhados" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">b. Empenhados:</label>
            <input value="R$:" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="descentralizados" placeholder="descentralizados">
          <label for="liquidados" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">c. liquidados:</label>  
            <input value="R$:" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="empenhados" placeholder="empenhados">
          <label for="devolvidos" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">d. Devolvidos:</label>
            <input value="R$:" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="devolvidos" placeholder="devolvidos">
            <button class="proxima-pagina" onclick="mostrarPagina(5)">Próxima página</button>
        </div>

    <div class="paginacao" id="pagina-5" style="display:none;">
        <div style="text-align:center;" class="content-center">
            <textarea class=" border-2 rounded-lg border-slate-950 w-10/12 h-36" name="outrasInfos" id="" placeholder="outras informações"></textarea>
            <button class="proxima-pagina" onclick="mostrarPagina(6)">Próxima página</button>
        </div>
    </div>
    <div class="paginacao" id="pagina-6" style="display:none;">
              
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">a. Relatório Final:</label>
                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="relatorioFinal" type="file">
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">b. Relatório do Comando Logístico:</label>
                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="relatorioComando" type="file">
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">c. Fotos:</label>
                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="fotos" type="file">
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">d. Outros documentos:</label>
                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="outrasDocumentos" type="file">

    </div>
    <input type="submit" name="submit" value="Logar" class="border border-slate-300 hover:border-slate-400 " />
	</form>
	<script>
		// Função para mostrar a próxima página
		function mostrarPagina(pagina) {
			// Esconde a página atual
			document.getElementById("pagina-" + (pagina - 1)).style.display = "none";
			
			// Mostra a próxima página
			document.getElementById("pagina-" + pagina).style.display = "block";
		}
		
		// Mostra a primeira página
		document.getElementById("pagina-1").style.display = "block";
	</script>
</body>
</html>
