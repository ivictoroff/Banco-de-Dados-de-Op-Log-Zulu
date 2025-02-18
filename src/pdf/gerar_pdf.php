<?php

// Carregar o Composer
require './vendor/autoload.php';


$array = $_POST['ids'];

if (isset($_POST['teste'])){
    $campos = $_POST['teste'];
  }
  else{
    header ('location: /banco/app/pesquisa/operacao.php');
  }
  //var_dump($campos);

// Referenciar o namespace Dompdf
use Dompdf\Dompdf;
use Dompdf\Options;

//Instancia de Options

$options = new Options();
$options->setChroot(__DIR__);

// Instanciar e usar a classe dompdf
$dompdf = new Dompdf($options);

// Instanciar o metodo loadHtml e enviar o conteudo do PDF
//$dompdf->loadHtml($dados);


ob_start();
require_once('relatorio.php');
$html = ob_get_contents();
ob_end_clean();
$dompdf->load_html($html);

$options = new Options();
 $options->set('isPhpEnabled', true);

// Configurar o tamanho e a orientacao do papel
// landscape - Imprimir no formato paisagem
//$dompdf->setPaper('A4', 'landscape');
// portrait - Imprimir no formato retrato
$dompdf->setPaper('A4', 'portrait');

// Renderizar o HTML como PDF
$dompdf->render();

//header('Content-type:application/pdf');

//echo $dompdf->output();

// Gerar o PDF
$dompdf->stream('Relatorio.pdf');

?>

