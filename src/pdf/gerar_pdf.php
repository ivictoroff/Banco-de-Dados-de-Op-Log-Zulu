<?php

// Carregar o Composer
require './vendor/autoload.php';








// Informacoes para o PDF
$dados = "<!DOCTYPE html>";
$dados .= "<html lang='pt-br'>";
$dados .= "<head>";
$dados .= "<meta charset='UTF-8'>";
$dados .= "<link rel='stylesheet' href='http://localhost/celke/css/custom.css'";
$dados .= "<title>COLOG</title>";
$dados .= "</head>";
$dados .= "<body>";




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
 require 'relatorio.php';
 $html = ob_get_clean();

$fileContent = file_get_contents($html);
require ''.$_SERVER['DOCUMENT_ROOT'].'/modules/dompdf/autoload.inc.php';

$options = new Options();
 $options->set('isPhpEnabled', true);
 $dompdf->loadHtml(file_get_contents('relatorio.php'));




// Configurar o tamanho e a orientacao do papel
// landscape - Imprimir no formato paisagem
//$dompdf->setPaper('A4', 'landscape');
// portrait - Imprimir no formato retrato
$dompdf->setPaper('A4', 'portrait');

// Renderizar o HTML como PDF
$dompdf->render();

header('Content-type:application/pdf');

echo $dompdf->output();

// Gerar o PDF
//$dompdf->stream();
