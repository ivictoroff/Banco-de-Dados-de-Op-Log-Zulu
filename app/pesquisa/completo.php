<?php
include('bd.php');
// Pega o ID da URL
$id = $_GET['id'];

// Conecta ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbmat";

$conn = new mysqli($servername, $username, $password, $dbname);



// Executa a consulta SQL
$query = "SELECT * FROM operacao WHERE opid = '$id'";
$result = $conn->query($query);


// Fecha a conexão com o banco de dados
$conn->close();



?>



<DOCTYPE html>
    <html> 
        <head><title>dmat</title>
          <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
           <link rel="shortcut icon" type="imagex/png" href="../dmat.png">
           <style>
                .alinhar{
                  display: flex;
                }
                
                .produto{
                    border: 1px solid #ccc;
                    padding: 20px;
                    margin: 5px;
                    float: left; 
                    width: 200px; 
                }

                #rodape {
                  background-color: #f0f0f0;
                  padding: 20px;
                  text-align: center;
                  position: fixed;
                  bottom: 0;
                  width: 100%;
                }
                #atual {
	                color: #f7b600;
                }
                td {
                  background-color: #DFDFDF;
                  text-align:center;
                }
                tr {
                  background-color: #C3C3C3;
                }
             
            </style> 
        </head>
    <body>
      
      <header class="flex bg-neutral-950 shadow-xl shadow-slate-400 px-8 py-4 justify-between sticky top-0 z-10"> 
        <div id= "area-principal">
            <a href="/app/insercao/operacao.php" >inserir dados</a>
            <a href="" id="atual">pesquisar</a>
        </div>
        <a href="/">
        </a>
        <div class="text-white flex gap-2 items-end mx-2">
          </a>
          <a href="/index.php">
            <button class="mr-2 text-pink-600"> Log Out <i class="fa-solid fa-user"></i></button>
          </a>
        </div>
      </header>
      
      
    <form action="">
        <input disabled class="border-2 rounded-lg border-slate-800" name="busca" value="<?php if(isset($id)) echo $id; ?>" placeholder="Digite os termos de pesquisa" type="text">
    </form>
    <br>
    <table  class= " border border-slate-600">
        <tr style="margin-right: 150px;" class=" border border-slate-600">
            <th class=" border border-slate-600">operacao</th>
            <th class="  border border-slate-600">missao</th>
            <th class="  border border-slate-600">estado</th>
            <th class="  border border-slate-600">cma</th>
            <th class="  border border-slate-600">rm</th>
            <th class="  border border-slate-600">comando da operacao</th>
            <th class="  border border-slate-600">comando apoiado</th>
            <th class="  border border-slate-600">inicio da operacao</th>
            <th class="  border border-slate-600">fim da operacao</th> 
        </tr>
        <?php
        if (!isset($_GET['id'])) {
            ?>
        <tr>
            <td colspan="3">Digite algo para pesquisar...</td>
        </tr>
        <?php
        } else {
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
            } else {
                while($dados = $sql_query->fetch_assoc()) {
                  while ($dados2 = $sql_query2->fetch_assoc()) {
                    while ($dados3 = $sql_query3->fetch_assoc()) {
                      while ($dados4 = $sql_query4->fetch_assoc()) {
                        while ($dados5 = $sql_query5->fetch_assoc()) {
                          while ($dados6 = $sql_query6->fetch_assoc()) {
                    ?>
                    <tr class=" border border-slate-600 ">
                        <td class=" border border-slate-600"><?php echo $dados['operacao']; ?></td>
                        <td class=" border border-slate-600 "><?php echo $dados['estado']; ?></td>
                        <td class=" border border-slate-600 "><?php echo $dados['missao']; ?></td>
                        <td class=" border border-slate-600 "><?php echo $dados['cma']; ?></td>
                        <td class=" border border-slate-600 "><?php echo $dados['rm']; ?></td>
                        <td class=" border border-slate-600 "><?php echo $dados['comandoOp']; ?></td>
                        <td class=" border border-slate-600 "><?php echo $dados['comandoApoio']; ?></td>
                        <td class=" border border-slate-600 "><?php echo $dados['inicioOp']; ?></td>
                        <td class=" border border-slate-600 "><?php echo $dados['fimOp']; ?></td>
                    </tr>
                    <tr>
                      <th class="border border-slate-600 bg-blend-darken">participantes</th>
                      <th class="border border-slate-600 bg-blend-darken">participantes exercito</th>
                      <th class="border border-slate-600 bg-blend-darken">participantes marinha</th>
                      <th class="border border-slate-600 bg-blend-darken">participantes forca aérea</th>
                      <th class="border border-slate-600 bg-blend-darken">participantes órgãos de segurança publica</th>
                      <th class="border border-slate-600 bg-blend-darken">participantes de outras âgencias governamentais</th>
                      <th class="border border-slate-600 bg-blend-darken">participantes de outras âgencias privadas</th>
                      <th class="border border-slate-600 bg-blend-darken">participantes de organizações não governamentais</th>
                      <th class="border border-slate-600 bg-blend-darken">total de participantes</th>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 "><?php echo $dados2['participantes']; ?></td>
                        <td class="border border-slate-600 "><?php echo $dados2['participantesEb']; ?></td>
                        <td class="border border-slate-600 "><?php echo $dados2['participantesMb']; ?></td>
                        <td class="border border-slate-600 "><?php echo $dados2['participantesFab']; ?></td>
                        <td class="border border-slate-600 "><?php echo $dados2['participantesOs']; ?></td>
                        <td class="border border-slate-600 "><?php echo $dados2['participantesGov']; ?></td>
                        <td class="border border-slate-600 "><?php echo $dados2['participantesPv']; ?></td>
                        <td class="border border-slate-600 "><?php echo $dados2['participantesCv']; ?></td>
                        <td class="border border-slate-600 "><?php echo $dados2['participantesCv'] + $dados2['participantesPv']+ $dados2['participantesEb'] + $dados2['participantesMb'] + $dados2['participantesFab'] + $dados2['participantesOs'] + $dados2['participantesGov']; ?></td>
                    </tr>
                    <tr style="margin-right: 150px;">
                      <th style="margin-right: 150px;" class="border border-slate-600 bg-blend-darken">operação</th>
                      <th class="border border-slate-600 bg-blend-darken" colspan="2">tipo de ação ou apoio</th>
                      <th class="border border-slate-600 bg-blend-darken">ação ou apoio desempenhado</th>
                      <th class="border border-slate-600 bg-blend-darken">anexos</th>
                    </tr>
                    
                    <tr>
                        <td class="border border-slate-600 "><?php echo $dados3['tipoOp']; ?></td>
                        <td class="border border-slate-600 " colspan="2"><?php echo $dados3['acaoOuApoio']; ?></td>
                        <td class="border border-slate-600 "><?php echo $dados3['apoioDesempenhado']; ?></td>
                        <td class="border border-slate-600 "><a href="../uploads/<?php echo $dados6['relatorioFinal'] ?>" target="_blank"><?php echo $dados6['relatorioFinal'] ?></a></td>
                    </tr>
                    <tr>
                      <th class="border border-slate-600 bg-blend-darken">recebidos</th>
                      <th class="border border-slate-600 bg-blend-darken">descentralizados</th>
                      <th class="border border-slate-600 bg-blend-darken">empenhados</th>
                      <th class="border border-slate-600 bg-blend-darken">devolvidos</th>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 "><?php echo $dados4['recebidos']; ?></td>
                        <td class="border border-slate-600 "><?php echo $dados4['descentralizados']; ?></td>
                        <td class="border border-slate-600 "><?php echo $dados4['empenhados']; ?></td>
                        <td class="border border-slate-600 "><?php echo $dados4['devolvidos']; ?></td>
                    </tr>
                    <tr >
                      <th class="border border-slate-600 bg-blend-darken" colspan="9">outras informações</th>
                    </tr>
                    <tr>
                    <td class="border border-slate-600 " colspan="9"><?php echo $dados5['outrasInfos'];?></td>
                    </tr>

                    
                    
                    <?php
                  }
                }
              }
            }
              }
            }
          }
            ?>
            
        <?php
        } ?>
    </table>
    <footer id="rodape">
          <h1>Exército Brasileiro Comando Logístico Diretoria de Material SMU, Bloco C, Térreo. CEP: 70630-901 Divisão de Tecnologia e Informação - Ramal 5451</h1>
        </footer> 
</body>
</html>  
