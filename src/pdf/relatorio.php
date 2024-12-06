<?php 
 include_once 'gerar_pdf.php'; 

 // Incluir conexao com BD
include_once '../../acoes/bd.php';


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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    table {
      background-color:#fefefe;
      border-radius: 5px;
      border: 1px solod #ccc;
      text-align: center;
      width: 100%;
    }
    table td,
    table th{
      border:1px solid #ccc;
    }
    table th{
      font-weight:bold;
      background-color:#bbbbbb;
      padding:10px;
    }
    hr{
      border:1px solid #ccc;
      margin: 20px;
    }
  </style>
</head>
<body>
  
<table border="1">
  <tr class="">
    <th class=" border border-slate-600"> <?php echo "Total de operações: " . count($array) ; ?></th>
    <th class=" border border-slate-600"> <?php echo "Recursos Liquidados: " . $recursosLiquidados ; ?> </th>
  </tr>
  <tr>
    <td class="border border-slate-600"> <?php echo "Efetivo empregado: " . $efetivoEx+ $efetivoMb + $efetivoFab +$efetivoOutros . "<br>"; ?>
    <?php echo "Exército: " . $efetivoEx . "<br>"; ?>
    <?php echo "Marinha: " . $efetivoMb . "<br>"; ?>
    <?php echo "Força áerea: " . $efetivoFab . "<br>"; ?>
    <?php echo "Outras forças: " . $efetivoOutros . "<br>"; ?></td>
    <td class="border border-slate-600"><?php echo "Recursos Recebidos: " . $recursosRecebidos . "<br>";
      echo "Recursos Devolvidos: " . $recursosDevolvidos . "<br>";
      echo "Recursos Descentralizados: " . $recursosDescentralizados . "<br>";
    ?></td>
  </tr>
</table>

<?php

echo "<hr>";

while($row_usuario = $result_usuarios->fetch_assoc()) {
  //var_dump ($row_usuario);
  echo "Operação:" . $row_usuario['operacao'] . "<br>";
  echo "missão:" . $row_usuario['missao'] . "<br>"; 
  echo "estado:" . $row_usuario['estado'] . "<br>"; 
  echo "inicioOp:" . date_format(date_create_from_format('Y-m-d', $row_usuario["inicioOp"]), 'd/m/Y') . "<br>";
  echo "fimOp:" . date_format(date_create_from_format('Y-m-d', $row_usuario["fimOp"]), 'd/m/Y') . "<br>";
  echo "cma:" . $row_usuario['cma'] . "<br>"; 
  
  echo "<hr>";
}

?>


</body>
</html>
  