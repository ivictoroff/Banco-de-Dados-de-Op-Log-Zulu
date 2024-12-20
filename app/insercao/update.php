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

$oper = @$_REQUEST['operador'];

// Conecta ao banco de dados
require '../../acoes/bd.php';

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
$comandoApoio = @$_REQUEST['comandoApoio'];
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

$idd = @$_REQUEST['idd'];

//outras infos

$outrasInfos = @$_REQUEST['outrasInfos'];

// anexos 

// Executa a consulta SQL
$query = "SELECT * FROM operacao WHERE opid = '$id'";
$result = $conn->query($query);


$submit= @$_REQUEST['submit'];

$conn = new PDO ("mysql:dbname=dbmat;host=localhost", "root", "@160l0nc3t");

$sql = "SELECT * FROM operacao WHERE opid = '$id' and operador = '$usuario'";

$result = $mysqli -> query($sql);

$sql = "SELECT * FROM usuario WHERE usuario = '$usuario' and adm = 'Administrador'";

$result2 = $mysqli -> query($sql);

if (mysqli_num_rows($result) < 1 && mysqli_num_rows($result2)<1 ) {
    header('Location: /banco/app/pesquisa/operacao.php');
}

if ($submit) {

  /* insere os dados das operacoes */

  $sqlOp = "UPDATE operacao SET operacao= :OPERACAO, estado= :ESTADO, missao= :MISSAO, cma= :CMA, rm= :RM, comandoOp=:COMANDOOP, comandoApoio=:COMANDOAPOIO,inicioOp=:INICIOOP,fimOp=:FIMOP, tipoop=:TIPOOP   WHERE opid=:ID";
  $stmt = $conn->prepare ($sqlOp);
  $stmt -> bindParam(":OPERACAO", $operacao);
  $stmt -> bindParam(":ESTADO", $estado);
  $stmt -> bindParam(":MISSAO", $missao);
  $stmt -> bindParam(":CMA", $cma);
  $stmt -> bindParam(":RM", $rm);
  $stmt -> bindParam(":COMANDOOP", $comandoOp);
  $stmt -> bindParam(":COMANDOAPOIO", $comandoApoio);
  $stmt -> bindParam(":INICIOOP", $inicioOp);
  $stmt -> bindParam(":FIMOP", $fimOp);
  $stmt -> bindParam(":TIPOOP", $tipoOp);

  $stmt -> bindParam(":ID", $idd);

  $stmt->execute();


  $sqlE = "UPDATE efetivo SET participantes= :PARTICIPANTES, participantesEb= :PARTICIPANTESEB, participantesMb= :PARTICIPANTESMB, participantesFab= :PARTICIPANTESFAB, participantesOs= :PARTICIPANTESOS, participantesGov=:PARTICIPANTESGOV, participantesPv=:PARTICIPANTESPV,participantesCv=:PARTICIPANTESCV  WHERE eid=:ID";
  
  $stmt = $conn->prepare ($sqlE);
  $stmt -> bindParam(":PARTICIPANTES", $participantes);
  $stmt -> bindParam(":PARTICIPANTESEB", $participantesEb);
  $stmt -> bindParam(":PARTICIPANTESMB", $participantesMb);
  $stmt -> bindParam(":PARTICIPANTESFAB", $participantesFab);
  $stmt -> bindParam(":PARTICIPANTESOS", $participantesOs);
  $stmt -> bindParam(":PARTICIPANTESGOV", $participantesGov);
  $stmt -> bindParam(":PARTICIPANTESPV", $participantesPv);
  $stmt -> bindParam(":PARTICIPANTESCV", $participantesCv);

  $stmt -> bindParam(":ID", $idd);

  $stmt->execute();


  $sqlT = "UPDATE tipoOp SET tipoOp= :TIPOOP, acaoOuApoio= :ACAOOUAPOIO, transporte= :TRANSPORTE, manutencao= :MANUTENCAO, suprimento= :SUPRIMENTO, aviacao=:AVIACAO, desTransporte=:DESTRANSPORTE,desManutencao=:DESMANUTENCAO, desSuprimento =:DESSUPRIMENTO, desAviacao= :DESAVIACAO  WHERE tid=:ID";
  $stmt = $conn->prepare ($sqlT);

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

  $stmt -> bindParam(":ID", $idd);

  $stmt->execute();


  $sqlr = "UPDATE recursos SET recebidos= :RECEBIDOS, descentralizados= :DESCENTRALIZADO, liquidados= :liquidados, devolvidos= :DEVOLVIDOS WHERE rid=:ID";
  $stmt = $conn->prepare ($sqlr);
  
  $stmt -> bindParam(":RECEBIDOS", $recebidos);
  $stmt -> bindParam(":DESCENTRALIZADO", $descentralizados);
  $stmt -> bindParam(":liquidados", $liquidados);
  $stmt -> bindParam(":DEVOLVIDOS", $devolvidos);

  $stmt -> bindParam(":ID", $idd);

  $stmt->execute();


  $sqlr = "UPDATE infos SET outrasInfos= :OUTRASINFOS WHERE iid=:ID";
  $stmt = $conn->prepare ($sqlr);
  
  $stmt -> bindParam(":OUTRASINFOS", $outrasInfos);

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
               <span class="ms-3">Nome da operação</span>
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

  <div class="sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">

  
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
        <?php $operador = $dados['operador']; ?>
      <input type="text" class="conteudo" name="idd" value="<?php echo $dados['opid'];?>"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
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
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">a. Participantes:</label>  
      <input type="text" name="participantes" value="<?php echo $dados2['participantes']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">b. Participantes do Exército:</label>
      <input type="text" name="participantesEb" value="<?php echo $dados2['participantesEb']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">c. Participantes da Marinha:</label>
      <input type="text" name="participantesMb" value="<?php echo $dados2['participantesMb']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">d. Participantes da Força Aérea:</label>
      <input type="text" name="participantesFab" value="<?php echo $dados2['participantesFab']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">e. Participantes de Órgãos de Segurança e Ordenamento Pública:</label>
      <input type="text" name="participantesOs" value="<?php echo $dados2['participantesOs']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">f. Participantes de outras Agências Governamentais:</label>
      <input type="text" name="participantesGov" value="<?php echo $dados2['participantesGov']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">g. Participantes de outras Agências Privadas:</label>
      <input type="text" name="participantesPv" value="<?php echo $dados2['participantesPv']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">h. Participantes de Organizações Não-Governamentais:</label>
      <input type="text" name="participantesCv" value="<?php echo $dados2['participantesCv']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      </div>

    <div class="conteudo" id="conteudo-3">
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">a. operacao</label>
      <input type="text" name="tipoOp" value="<?php echo $dados3['tipoOp']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">b. Tipo de Ação ou Apoio: </label>
      <input type="text" name="acaoOuApoio" value="<?php echo $dados3['acaoOuApoio']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">1) Transporte</label>
      <input type="text" name="transporte" value="<?php echo $dados3['transporte']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">2) Manutenção</label>
      <input type="text" name="manutencao" value="<?php echo $dados3['manutencao']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">3) Suprimento</label>
      <input type="text" name="suprimento" value="<?php echo $dados3['suprimento']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">4) Aviação</label>
      <input type="text" name="aviacao" value="<?php echo $dados3['aviacao']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">Descrição Transportes </label>
      <input type="text" name="desTransporte" value="<?php echo $dados3['desTransporte']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">Descrição Manutenção</label>
      <input type="text" name="desManutencao" value="<?php echo $dados3['desManutencao']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">Descrição Suprimentos</label>
      <input type="text" name="desSuprimento" value="<?php echo $dados3['desSuprimento']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">Descrição Aviação</label>
      <input type="text" name="desAviacao" value="<?php echo $dados3['desAviacao']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>

    <div class="conteudo" id="conteudo-4">
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">a. recebidos</label>
      <input type="text" name="recebidos" value="<?php echo $dados4['recebidos']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">b. Descentralizaddos</label>
      <input type="text" name="descentralizados" value="<?php echo $dados4['descentralizados']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">c. Liquidados</label>
      <input type="text" name="liquidados" value="<?php echo $dados4['liquidados']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <label for="desSuprimento" class="block mb-2 text-sm text-gray-900 dark:text-white">d. Devolvidos</label>
      <input type="text" name="devolvidos" value="<?php echo $dados4['devolvidos']; ?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      
    </div>

    <div class="conteudo" id="conteudo-5">
    <div style="text-align:center;" class="content-center">
      <label for="operacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Outras informações:</label>
          <input type="text" name="outrasInfos" value="<?php echo $dados5['outrasInfos']; ?>" class=" border-2 rounded-lg border-slate-950 w-10/12 h-36" name="outrasInfos" id="" placeholder="outras informações"></textarea>
      </div>
    </div>
    <div class="mt-2">
          <input type="submit" name="submit" value="SALVAR" class=" flex w-12/6 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"/>
      </div>
    
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
  <script src="/banco/src/navbar.js"></script>

</body>
</html>  