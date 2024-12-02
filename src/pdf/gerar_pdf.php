<?php

// Carregar o Composer
require './vendor/autoload.php';

// Incluir conexao com BD
include_once './conexao.php';

require '../../acoes/bd.php';

$array = $_POST['ids'];

// Verifica se as datas estão preenchidas
foreach ($array as $id){
  $pesquisa = $mysqli->real_escape_string($id);
  $sql_code = "SELECT * 
    FROM operacao 
    WHERE opid LIKE '%$pesquisa%'";
    $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error); 
    while($dados = $sql_query->fetch_assoc()) {
      $idas [] = $dados['opid'];
    }
  }

  // QUERY para recuperar os registros do banco de dados
$query_usuarios = "SELECT id, nome, email FROM usuarios";

// Prepara a QUERY
$result_usuarios = $conn->prepare($query_usuarios);

// Executar a QUERY
$result_usuarios->execute();

// Informacoes para o PDF
$dados = "<!DOCTYPE html>";
$dados .= "<html lang='pt-br'>";
$dados .= "<head>";
$dados .= "<meta charset='UTF-8'>";
$dados .= "<link rel='stylesheet' href='http://localhost/celke/css/custom.css'";
$dados .= "<title> COLOG </title>";
$dados .= "</head>";
$dados .= "<body>";

// Ler os registros retornado do BD
while($row_usuario = $result->fetch_assoc()){
    //var_dump($row_usuario);
    extract($row_usuario);
    $dados .= "Operação: $operacao <br>";
    $dados .= "missão: $missao <br>";
    $dados .= "estado: $estado <br>";
    $dados .= "inicioOp: $inicioOp <br>";
    $dados .= "fimOp: $fimOp <br>";
    $dados .= "cma: $cma <br>";

    $dados .= "<hr>";
}



// Referenciar o namespace Dompdf
use Dompdf\Dompdf;

// Instanciar e usar a classe dompdf
$dompdf = new Dompdf(['enable_remote' => true]);

// Instanciar o metodo loadHtml e enviar o conteudo do PDF
$dompdf->loadHtml($dados);

// Configurar o tamanho e a orientacao do papel
// landscape - Imprimir no formato paisagem
//$dompdf->setPaper('A4', 'landscape');
// portrait - Imprimir no formato retrato
$dompdf->setPaper('A4', 'portrait');

// Renderizar o HTML como PDF
$dompdf->render();

// Gerar o PDF
$dompdf->stream();
