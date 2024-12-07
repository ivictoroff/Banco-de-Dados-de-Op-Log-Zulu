<?php

/** 
* NOTA!: não usar PDO para enviar dados para o banco de dados (somente *mysqli*) ;
**/


// Conecta ao banco de dados
require '../../acoes/bd.php';

// inicia a seçao

session_start();

if ((!isset($_SESSION['user'])== true) and (!isset($_SESSION['pass'])==true)){
  unset($_SESSION['user']);
  unset($_SESSION['pass']);
  header('Location: /banco/index.php');
} 
else {
  $usuario = $_SESSION['user'];
}

// verificacao de cargo de adm

$sql = "SELECT * FROM usuario WHERE usuario = '$usuario' and adm = 'Administrador' or adm = 'Gerente'";

$result = $mysqli -> query($sql);

if (mysqli_num_rows($result) < 1) {
  header('Location: /banco/app/pesquisa/operacao.php');
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
$liquidados = @$_REQUEST['liquidados'];
$devolvidos = @$_REQUEST['devolvidos'];

//outras infos

$outrasInfos = @$_REQUEST['outrasInfos'];

// anexos 

$submit= @$_REQUEST['submit'];

if ($submit) {

  /* insere os dados das operacoes */

  $sql = "INSERT INTO operacao (operador, operacao,estado, missao, cma, rm, comandoOp, comandoApoio, inicioOp, fimOp) VALUES ('$usuario', '$operacao', '$estado', '$missao','$cma', '$rm', '$comandoOp', '$comandoApoio', '$inicioOp', '$fimOp')";

  $mysqli->query($sql);

  /* insere os dados do efetivo */

  $sql = "INSERT INTO efetivo (participantes,participantesEb, participantesMb,participantesFab,participantesOs,participantesGov,participantesPv,participantesCv) VALUES ('$participantes','$participantesEb', '$participantesMb', '$participantesFab', '$participantesOs', '$participantesGov', '$participantesPv', '$participantesCv')";

  $mysqli->query($sql);

  /* insere os dados dos tipos de operacoes */

  $sql = "INSERT INTO tipoOp (tipoOp,acaoOuApoio, transporte, manutencao, suprimento, aviacao, desTransporte, desManutencao, desSuprimento, desAviacao) VALUES ('$tipoOp', '$acaoOuApoio', '$transporte', '$manutencao', '$suprimento', '$aviacao', '$desTransporte','$desManutencao', '$desSuprimento', '$desAviacao')";

  $mysqli->query($sql);

  /* insere os dados dos recursos aprovisionados */

  $sql = "INSERT INTO recursos (recebidos,descentralizados, liquidados, devolvidos) VALUES ('$recebidos', '$descentralizados', '$liquidados', '$devolvidos')";

  $mysqli->query($sql);

  /* insere os dados de outras informacoes */

  $sql = "INSERT INTO infos (outrasInfos) VALUES ('$outrasInfos')";

  $mysqli->query($sql);

    /* insere os dados dos anexos */

  $sql = "INSERT INTO anexos (relatorioFinal,relatorioComando,fotos,outrosDocumentos) VALUES ('$relatorioFinalName','$relatorioComandoName','$fotosName','$outrasDocumentosName')";

  $mysqli->query($sql);

  header("Location: /banco/app/pesquisa/operacao.php");
}

?>


<DOCTYPE html>
<html> 
<head>
  <title>colog</title>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="../../img/dmat.ico" type="favicon.ico">
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
  <!-- inicio sidebar --> 

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
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 17">
               <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
               <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8m0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5"/>
              </svg>
               <span class="ms-3">Dados da operação</span>
            </a>
         </li>
         <li>
            <a href="#" onclick="mostrarConteudo(2)" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
              <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
              </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Efetivo</span>
            </a>
         </li>
         <li>
            <a href="#" onclick="mostrarConteudo(3)" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                <path d="M11.5 4a.5.5 0 0 1 .5.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-4 0 1 1 0 0 1-1-1v-1h11V4.5a.5.5 0 0 1 .5-.5M3 11a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2m1.732 0h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4a2 2 0 0 1 1.732 1"/>
              </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Tipos de Operações</span>
            </a>
         </li>
         <li>
            <a href="#" onclick="mostrarConteudo(4)" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z"/>
              </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Recursos Aprovisionados</span>
            </a>
         </li>
         <li>
            <a href="#" onclick="mostrarConteudo(5)" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 0 .5m0 2A.5.5 0 0 1 .5 2h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m9 0a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-9 2A.5.5 0 0 1 .5 4h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m5 0a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m7 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-12 2A.5.5 0 0 1 .5 6h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8 0a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-8 2A.5.5 0 0 1 .5 8h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m7 0a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-7 2a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/>
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Outras Informações</span>
            </a>
         </li>
         <li>
            <a href="#" onclick="mostrarConteudo(6)" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 16">
                <path d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0z"/>
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Anexos</span>
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
   
  <!-- inicio formulario --> 
  <form method="POST" enctype="multipart/form-data">

    <!-- dados das operacoes -->
    <div class="conteudo ativo" id="conteudo-1">
      <div class="sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">a. Nome da Operação:</label>
              <input type="text" placeholder="Nome da Operação" name="operacao" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            <label for="estado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">b. Estado (UF):</label>
              <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required id="estado" name="estado" placeholder="estados">
                <option value="null">Selecione o estado</option>
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
          </div>
    </div>
    
    <!-- efetivo -->
    <div class="conteudo" id="conteudo-2">
      <div class="sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
          <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">a. Participantes:</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required type="text" name="participantes" placeholder="participantes">
          <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">b. Participantes do Exército brasileiro:</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required type="number" name="participantesEb" placeholder="participantes do exercito Brasileiro">
          <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">c. Participantes da Marinha do Brasil:</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" value="0" name="participantesMb" placeholder="participantes da marinha do Brasil">
          <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">d. Participantes da Força Aérea Brasileira:</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" value="0" name="participantesFab" placeholder="participantes da forca aérea Brasileira">
          <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">e. Participantes de Órgãos de Segurança e Ordenamento Pública:</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" value="0" name="participantesOs" placeholder="participantes de orgãos de Segurança e Ordem Pública">
          <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">f. Participantes de outras Agências Governamentais:</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" value="0" name="participantesGov" placeholder="participantes de outras agências governamentais">
          <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">g. Participantes de outras Agências Privadas:</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" value="0" name="participantesPv" placeholder="participantes de outras agências privadas">
          <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">h. Participantes de Organizações Não-Governamentais:</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" value="0" name="participantesCv" placeholder="participantes de organizações não governamentais">
        </div>
      </div>
    </div>

    <!-- tipos de operacoes -->
    <div class="conteudo" id="conteudo-3">
      <div class="sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">

          <label for="tipoOp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">a. Operação:</label>
            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required id="tipoOp" name="tipoOp">
              <option value="">Selecione o tipo de operação</option>
              <option value="Preparo">Preparo</option>
              <option value="Emprego">Emprego</option>
              <option value="Transporte">Transporte</option>
            </select>
          <label for="acaoOuApoio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">b. Tipo de de Ação ou Apoio:</label>
            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required id="acaoOuApoio" name="acaoOuApoio">
              <option value="">Selecione o tipo de Ação ou Apoio</option>
              <option value="Logística para Operações de Garantia da Soberania">Logística para Operações de Garantia da Soberania</option>
              <option value="Logística de apoio a operacoes garantia da lei e da ordem">Logística de apoio a operacoes garantia da lei e da ordem</option>
              <option value="Logística de apoio a garantia da votação e apuração">Logística de apoio a garantia da votação e apuração </option>
              <option value="Logística de apoio a defesa civil">Logística de apoio a defesa civil</option>
              <option value="Logística de apoio as ações subsidiarias">Logística de apoio as ações subsidiarias</option>
              <option value="Logística de apoio a operacoes internacionais">Logística de apoio a operacoes internacionais</option>
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
      </div>
    </div>

    <!-- recursos aprovisionados --> 
    <div class="conteudo" id="conteudo-4">
      <div class="sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
          <label for="recebidos" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">a. Recebidos:</label>
            <div class="relative">
              <div class="absolute text-sm text-sm inset-y-0 start-0 top-0 flex items-center ps-0 pointer-events-none">
                  <p>R$</p>
              </div>
              <input type="number" value="0" step="0.01" min="0" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-0 p-4  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Recebidos" name="recebidos" />
            </div>
          <label for="liquidados" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">b. Descentralizados:</label>
            <div class="relative">
              <div class="absolute text-sm inset-y-0 start-0 top-0.1 flex items-center ps-0 pointer-events-none">
                <p>R$</p>
              </div>
            <input type="number" value="0" step="0.01" min="0" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-0 p-4  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="descentralizados" name="descentralizados" />
            </div>
          <label for="liquidados" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">c. Liquidados:</label>  
            <div class="relative">
              <div class="absolute text-sm inset-y-0 start-0 top-0.1 flex items-center ps-0 pointer-events-none">
                <p>R$</p>
              </div>
            <input type="number" value="0" step="0.01" min="0" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-0 p-4  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Liquidados" name="liquidados" />
            </div>
          <label for="devolvidos" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">d. Devolvidos:</label>
            <div class="relative">
              <div class="absolute text-sm inset-y-0 start-0 top-0.1 flex items-center ps-0 pointer-events-none">
                <p>R$</p>
              </div>
            <input type="number" value="0" step="0.01" min="0" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-0 p-4  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Devolvido" name="devolvidos" />
            </div>

        </div>
      </div>
    </div>

    <!-- otras informacoes --> 
    <div class="conteudo" id="conteudo-5">
      <div class="sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
          <div style="text-align:center;" class="content-center">
          <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Outras informações:</label>
            <textarea class=" border-2 rounded-lg border-slate-950 w-10/12 h-36" name="outrasInfos" id="" placeholder="outras informações"></textarea>
          </div>
        </div>
      </div>
    </div>

    <!-- otras informacoes --> 
    <div class="conteudo" id="conteudo-6"> 
      <div class="sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">      
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
      </div>  
    </div>

  </form>

  <!-- script da navbar --> 
  <script src="/banco/src/navbar.js"></script>

</body>
</html>  