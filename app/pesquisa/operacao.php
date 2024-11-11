<?php
include('bd.php');

?>



<DOCTYPE html>
    <html> 
        <head><title>colog</title>
          <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
           <link rel="shortcut icon" type="imagex/png" href="./dmat.png">
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
        <input class="border-2 rounded-lg border-slate-800" name="busca" value="<?php if(isset($_GET['busca'])) echo $_GET['busca']; ?>" placeholder="Digite os termos de pesquisa" type="text">
        <button class="border-2 rounded-lg border-slate-800" type="submit">Pesquisar</button>
    </form>
    <br>
    <table  class= " border border-slate-600">
        <tr style="margin-right: 150px;" class=" border border-slate-600">
            <th class="border border-slate-600">Operação</th>
            <th class="border border-slate-600">Missão</th>
            <th class="border border-slate-600">Estado</th>
            <th class="border border-slate-600">Comando Militar de Área</th>
            <th class="border border-slate-600">Região Militar</th>
            <th class="border border-slate-600">Comando da Operação</th>
            <th class="border border-slate-600">Comando Apoiado</th>
            <th class="border border-slate-600">Inicio da Operação</th>
            <th class="border border-slate-600">Fim da Operação</th> 
            <th>completo</th>


        </tr>
        <?php
        if (!isset($_GET['busca'])) {
            ?>
        <tr>
            <td colspan="3">Digite algo para pesquisar...</td>
        </tr>
        <?php
        } else {
            $pesquisa = $mysqli->real_escape_string($_GET['busca']);
            $sql_code = "SELECT * 
                FROM operacao 
                WHERE operacao LIKE '%$pesquisa%' 
                OR missao LIKE '%$pesquisa%'
                OR estado LIKE '%$pesquisa%'
                OR cma LIKE '%$pesquisa%'
                OR rm LIKE '%$pesquisa%'
                OR comandoOp LIKE '%$pesquisa%'
                OR comandoApoio LIKE '%$pesquisa%'
                OR inicioOp LIKE '%$pesquisa%'
                OR fimOp LIKE '%$pesquisa%'
                or opid LIKE '%$pesquisa%'";

            $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error); 
            
            if ($sql_query->num_rows == 0) {
                ?>
            <tr>
                <td colspan="3">Nenhum resultado encontrado...</td>
            </tr>
            <?php
            } else {
                while($dados = $sql_query->fetch_assoc()) {
                    ?>
                    <tr class=" border border-slate-600 ">
                        <td class=" border border-slate-600"><?php echo $dados['operacao']; ?></td>
                        <td class=" border border-slate-600 "><?php echo $dados['missao']; ?></td>
                        <td class=" border border-slate-600 "><?php echo $dados['estado']; ?></td>
                        <td class=" border border-slate-600 "><?php echo $dados['cma']; ?></td>
                        <td class=" border border-slate-600 "><?php echo $dados['rm']; ?></td>
                        <td class=" border border-slate-600 "><?php echo $dados['comandoOp']; ?></td>
                        <td class=" border border-slate-600 "><?php echo $dados['comandoApoio']; ?></td>
                        <td class=" border border-slate-600 "><?php echo $dados['inicioOp']; ?></td>
                        <td class=" border border-slate-600 "><?php echo $dados['fimOp']; ?></td>
                        <td><button onclick="abrirPesquisa(<?php echo $dados['opid']; ?>)">abrir</button></td>
                    </tr>

                    <?php
                }
            }
            ?>
            
        <?php
        } ?>
        <script>
          function abrirPesquisa(id) {
              window.open('/app/pesquisa/completo.php?id=' + id, '_blank');
          }

        </script>
    </table>
    <footer id="rodape">
          <h1>Exército Brasileiro Comando Logístico Diretoria de Material SMU, Bloco C, Térreo. CEP: 70630-901 Divisão de Tecnologia e Informação - Ramal 5451</h1>
        </footer> 
</body>

</html>  
