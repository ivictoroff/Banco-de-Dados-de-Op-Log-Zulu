

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RELATORIO</title>
</head>
<body>
<?php
// Incluir conexao com BD
include_once '../../acoes/bd.php';

$array = $_POST['ids'];

// QUERY para recuperar os registros do banco de dados
// Define a consulta SQL
if (count($array) > 1){
    $query_usuarios = "SELECT * FROM operacao WHERE opid in (";
}else{
    $query_usuarios = "SELECT * FROM operacao WHERE ";
}


// Verifica se as datas estão preenchidas
foreach ($array as $campo) {
    if (count($array) > 1){
        $query_usuarios .= "'$campo',";
    }
    else{
        $query_usuarios .= "opid LIKE '%".$campo."%' ";
    }

}


// Remove o último "OR"
if (count($array) > 1){
$query_usuarios = substr($query_usuarios, 0, -1);
$query_usuarios .= ")";
}
//print_r($query_usuarios);

// Prepara a QUERY
$result_usuarios = $mysqli->query($query_usuarios);

foreach ($array as $id){
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
  
              @$recursosLiquidados += $dados4['liquidados'];
              @$recursosRecebidos += $dados4['recebidos'];
              @$recursosDescentralizados += $dados4['descentralizados']; 
              @$recursosDevolvidos += $dados4['devolvidos']; 
  
              @$efetivoEx += $dados2['participantesEb']; 
              @$efetivoMb += $dados2['participantesMb']; 
              @$efetivoFab += $dados2['participantesFab']; 
              @$efetivoOutros += $dados2['participantesOs']; 
              @$efetivoOutros += $dados2['participantesGov']; 
              @$efetivoOutros += $dados2['participantesPv']; 
              @$efetivoOutros += $dados2['participantesCv']; 
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

  $dados .= "<h2> RESUMO </h2>";
  $dados .= "<hr>";
  $dados .= "Total de operações: " . count($array) . "<br>";
  $dados .= "Efetivo empregado: " . $efetivoEx+ $efetivoMb + $efetivoFab +$efetivoOutros . "<br>";
  $dados .= "Exército: " . $efetivoEx . "<br>";
  $dados .= "Marinha: " . $efetivoMb . "<br>";
  $dados .= "Força áerea: " . $efetivoFab . "<br>";
  $dados .= "Outras forças: " . $efetivoOutros . "<br>";
  $dados .= "Recursos Recebidos: " . "R$:". $recursosRecebidos . "<br>";
  $dados .= "Recursos Devolvidos: ". "R$:" . $recursosDevolvidos . "<br>";
  $dados .= "Recursos Descentralizados: " . "R$:". $recursosDescentralizados . "<br>";
  $dados .= "<hr>";
  $dados .= "<h2> Operações Relacionadas </h2>";
  $dados .= "<hr>";

  while($row_usuario = $result_usuarios->fetch_assoc()) {
    //var_dump ($row_usuario);
    $dados .= "Operação: " . $row_usuario['operacao'] . "<br>";
    $dados .= "Missão: " . $row_usuario['missao'] . "<br>"; 
    $dados .= "Estado: " . $row_usuario['estado'] . "<br>"; 
    $dados .= "Inicio da operação: " . date_format(date_create_from_format('Y-m-d', $row_usuario["inicioOp"]), 'd/m/Y') . "<br>";
    $dados .= "Fim da operação: " . date_format(date_create_from_format('Y-m-d', $row_usuario["fimOp"]), 'd/m/Y') . "<br>";
    $dados .= "Comando Militar de Área: " . $row_usuario['cma'] . "<br>"; 
    
    $dados .= "<hr>";
}
    ?>

</body>
</html>