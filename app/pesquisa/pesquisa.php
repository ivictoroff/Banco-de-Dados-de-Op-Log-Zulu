<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">

        <?php

        // Conecta ao banco de dados
        include('bd.php');

        // Define os campos de pesquisa
        $campos = array('operacao', 'estado', 'missao', 'cma', 'rm', 'comandoOp', 'comandoApoio', 'inicioOp', 'fimOp');

        // Define a consulta SQL
        $query = "SELECT * FROM operacao WHERE ";

        // Verifica se as datas estão preenchidas
        foreach ($campos as $campo) {
          if (isset($campo)){
            @$query .= "$campo LIKE '%".$_POST[$campo]."%' AND ";
            
          }
      }

      if (!empty($_POST['inicioOp']) && !empty($_POST['fimOp'])) {
        $data_inicial =  $_POST['inicioOp'];
        $data_final =  $_POST['fimOp'];
        
        $query .= "inicioOp >= '".$data_inicial."' AND fimOp <= '".$data_final."'";
        
      }
      else{
        // Remove o último "OR"
        $query = substr($query, 0, -4);

      }
              // Executa a consulta
              $result = $mysqli->query($query);
              // Exibe os resultados
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      $ids[] = $row['opid'];
                      echo "ID: " . $row["opid"] . "<br>";
                      echo "operacao: " . $row["operacao"] . "<br>";
                      echo "rm: " . $row["rm"] . "<br>";
                      echo "missao: " . $row["missao"] . "<br>";
                      echo "estado: " . $row["estado"] . "<br>";
                      echo "cma: " . $row["cma"] . "<br><br>";
      
                  }
              } else {
                  echo "Nenhum resultado encontrado.";
              }
        
        foreach ($ids as $id){
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
          
                      @$recursos += $dados4['empenhados'];
          
                      @$efetivoEx += $dados2['participantesEb']; 
                      @$efetivoMb += $dados2['participantesMb']; 
                      @$efetivoFab += $dados2['participantesFab']; 
                      @$efetivoOutros += $dados2['participantesOs']; 
                      @$efetivoOutros += $dados2['participantesGov']; 
                      @$efetivoOutros += $dados2['participantesPv']; 
                      @$efetivoOutros += $dados2['participantesCv']; 
                      @$recursosRecebidos += $dados4['recebidos']; 
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


        echo "Total de operações: " . count($ids) . "<br>";
        echo "Recursos: " . $recursos . "<br>";
        echo "Efetivo empregado: " . $efetivoEx+ $efetivoMb + $efetivoFab +$efetivoOutros . "<br>";
        echo "Exército: " . $efetivoEx . "<br>";
        echo "Marinha: " . $efetivoMb . "<br>";
        echo "Força áerea: " . $efetivoFab . "<br>";
        echo "Outras forças: " . $efetivoOutros . "<br>";
        
        






        // Fecha a conexão
        $mysqli->close();
        ?>

    </div>
</div>