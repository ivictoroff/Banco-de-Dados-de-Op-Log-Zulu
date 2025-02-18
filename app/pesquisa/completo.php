<?php
session_start();

if ((!isset($_SESSION['user'])== true) and (!isset($_SESSION['pass'])==true)){
  unset($_SESSION['user']);
  unset($_SESSION['pass']);
  header('Location: /index.php');
} 
else {
  $usuario = $_SESSION['user'];
}

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

// Executa a consulta SQL
$query = "SELECT * FROM operacao WHERE opid = '$id'";
$result = $conn->query($query);

// Fecha a conexão com o banco de dados
$conn->close();

?>

<DOCTYPE html>
<html> 
<head>
  
  <title>Colog</title>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.1/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.1/dist/flowbite.min.js"></script>
  
  <link rel="shortcut icon" type="imagex/png" href="/img/colog.png">
  <style>
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
   
    .conteudo {
      display: none;
    }
    
    .conteudo.ativo {
      display: block;
    }
  </style> 

</head>
<body class="bg-white dark:bg-gray-800">

  <div class="conteudo ativo" id="conteudo-1">
  <aside id="separator-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
      <a href="#" class="flex items-center ps-1 mb-1">
        <img src="/img/colog.png" class="h-10 me-3 sm:h-20 center" alt="Logo" />
        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">B D Op Log ZULU</span>
      </a>
      <ul class="space-y-2 font-medium">
      <li>
      <a href="/acoes/cargo.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
          <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 16">
            <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z"/>
            <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z"/>
            <path d="M8.5 6.5a.5.5 0 0 0-1 0V8H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V9H10a.5.5 0 0 0 0-1H8.5z"/>
          </svg>  
            <span class="ms-3">Inserção</span>
        </a>
      </li>
      <li>
        <a href="/app/pesquisa/operacao.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
          <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
          </svg>
            <span class="ms-3">Pesquisa</span>
        </a>
      </li>
      <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
      <li>
        <a href="#" onclick="ocultar(2)" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
          <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 16">
          <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
          <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
          </svg>
            <span class="ms-1">Ocultar</span>
        </a>
      </li>
      <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
      <li>
            <a href="/app/adm/adm.php" class="flex items-center p-2 text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
               <svg class="flex-shrink-0 w-6 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 16">
               <path d="M8.39 12.648a1 1 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-1.046l.476-2.304a1 1 0 0 0 .016-.164.51.51 0 0 0-.516-.516.54.54 0 0 0-.539.43l-.523 2.554H7.617l.477-2.304c.008-.04.015-.118.015-.164a.51.51 0 0 0-.523-.516.54.54 0 0 0-.531.43L6.53 5.484H5.414c-.43 0-.617.22-.617.532s.187.539.617.539h.906l-.515 2.523H4.609c-.421 0-.609.219-.609.531s.188.547.61.547h.976l-.516 2.492c-.008.04-.015.125-.015.18 0 .305.21.508.5.508.265 0 .492-.172.554-.477l.555-2.703h2.242zm-1-6.109h2.266l-.515 2.563H6.859l.532-2.563z"/>
              </svg>
               <span class="ms-3">Administrador</span>
            </a>
         </li>
         <li>
            <a href="/acoes/sair.php" class="flex items-center p-2 text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
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
  </div>
  
  <!-- id da query sendo pesquisado -->
  <div class="vai sm:ml-64">
    <div class="relative overflow-x-auto  shadow-md sm:rounded-lg">
      <form action="/src/pdf/pdfCompleto.php" class="conteudo ativo" id="conteudo-1"  method="post">
        <input class="border-2 rounded-lg border-slate-800" name="id" value="<?php if(isset($id)) echo $id; ?>" placeholder="Digite os termos de pesquisa" type="text">
        <button type="submit" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Gerar PDF</button>
      </form>
       
      <!-- construcao da tabela para a exibicao -->
      <table  class= "w-full text-sm text-left rtl:text-right text-yellow-300 dark:text-yellow-300">
        <tr class="text-xs text-yellow-400 uppercase bg-gray-800 border-b border-gray-600 dark:text-yellow-400">
          <th scope="col" class="px-6 py-3">Operação</th>
          <th scope="col" class="px-6 py-3">Estado</th>
          <th scope="col" class="px-6 py-3">Missão</th>
          <th scope="col" class="px-6 py-3">Comando Militar de Área</th>
          <th scope="col" class="px-6 py-3">Região Militar</th>
          <th scope="col" class="px-6 py-3">Comando da Operação</th>
          <th scope="col" class="px-6 py-3">Comando Apoiado</th>
          <th scope="col" class="px-6 py-3">Inicio da Operação</th>
          <th scope="col" class="px-6 py-3">Fim da Operação</th> 
        </tr>
        <?php
          if (!isset($_GET['id'])) {
        ?>
        <tr>
          <td colspan="3">Digite algo para pesquisar...</td>
        </tr>
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
        <tr class="bg-gray-900 border-b border-gray-700 ">
          <th scope="row" class="px-6 py-4 font-medium text-yellow-300 whitespace-nowrap border border-slate-600"><?php echo $dados['operacao']; ?></th>
          <td class="px-6 py-4 border border-slate-600"><?php echo $dados['estado']; ?></td>
          <td class="px-6 py-4 border border-slate-600"><?php echo $dados['missao']; ?></td>
          <td class="px-6 py-4 border border-slate-600"><?php echo $dados['cma']; ?></td>
          <td class="px-6 py-4 border border-slate-600"><?php echo $dados['rm']; ?></td>
          <td class="px-6 py-4 border border-slate-600"><?php echo $dados['comandoOp']; ?></td>
          <td class="px-6 py-4 border border-slate-600"><?php echo $dados['comandoApoio']; ?></td>
          <td class="px-6 py-4 border border-slate-600"><?php echo $dados['inicioOp']; ?></td>
          <td class="px-6 py-4 border border-slate-600"><?php echo $dados['fimOp']; ?></td>
        </tr>
        <tr class="text-xs text-yellow-400 uppercase bg-gray-800 border-b border-gray-600 dark:text-yellow-400">
          <th scope="col" class="px-6 py-3">Participantes</th>
          <th scope="col" class="px-6 py-3">Participantes do Exército</th>
          <th scope="col" class="px-6 py-3">Participantes da Marinha</th>
          <th scope="col" class="px-6 py-3">Participantes da Força Aérea</th>
          <th scope="col" class="px-6 py-3">Participantes de Órgãos de Segurança Publica</th>
          <th scope="col" class="px-6 py-3">Participantes de outras Âgencias Governamentais</th>
          <th scope="col" class="px-6 py-3">Participantes de outras Âgencias Privadas</th>
          <th scope="col" class="px-6 py-3">Participantes de Organizações Não-Governamentais</th>
          <th scope="col" class="px-6 py-3">total de Participantes</th>
        </tr>
        <tr class="bg-gray-900 border-b border-gray-700">
          <td class="px-6 py-4 border border-slate-600 "><?php echo $dados2['participantes']; ?></td>
          <td class="px-6 py-4 border border-slate-600 "><?php echo $dados2['participantesEb']; ?></td>
          <td class="px-6 py-4 border border-slate-600 "><?php echo $dados2['participantesMb']; ?></td>
          <td class="px-6 py-4 border border-slate-600 "><?php echo $dados2['participantesFab']; ?></td>
          <td class="px-6 py-4 border border-slate-600 "><?php echo $dados2['participantesOs']; ?></td>
          <td class="px-6 py-4 border border-slate-600 "><?php echo $dados2['participantesGov']; ?></td>
          <td class="px-6 py-4 border border-slate-600 "><?php echo $dados2['participantesPv']; ?></td>
          <td class="px-6 py-4 border border-slate-600 "><?php echo $dados2['participantesCv']; ?></td>
          <td class="px-6 py-4 border border-slate-600 "><?php echo $dados2['participantesCv'] + $dados2['participantesPv']+ $dados2['participantesEb'] + $dados2['participantesMb'] + $dados2['participantesFab'] + $dados2['participantesOs'] + $dados2['participantesGov']; ?></td>
        </tr>
        <tr class="text-xs text-yellow-400 uppercase bg-gray-800 border-gray-600 dark:text-yellow-400">
          <th class="px-6 py-4 ">Operação</th>
          <th class="px-6 py-4 " colspan="2">Tipo de ação ou apoio</th>
        </tr>
        <tr class="bg-gray-900 border-b border-gray-700">
            <td class="px-6 py-4 border border-slate-600"><?php echo $dados3['tipoOp']; ?></td>
            <td class="px-6 py-4 border border-slate-600" colspan="2"><?php echo $dados3['acaoOuApoio']; ?></td>
        </tr>
        <tr class="text-xs text-yellow-400 uppercase bg-gray-800 border-gray-600 dark:text-yellow-400">
          <th class="px-6 py-4 ">Transporte</th>
          <th class="px-6 py-4 ">Manutenção</th>
          <th class="px-6 py-4 ">Suprimento</th>
          <th class="px-6 py-4 ">Aviação</th>
        </tr>
        <tr class="bg-gray-900  border-gray-700">
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados3['transporte']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados3['manutencao']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados3['suprimento']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo $dados3['aviacao']; ?>   </td>
        </tr>
        <tr class="text-xs text-yellow-400 uppercase bg-gray-800 border-gray-600 dark:text-yellow-400">
          <th class="px-6 py-4 ">Descrição das atividades de Transporte</th>
          <th class="px-6 py-4 ">Descrição das atividades de Manutenção</th>
          <th class="px-6 py-4 ">Descrição das atividades de Suprimento</th>
          <th class="px-6 py-4 ">Descrição das atividades de Aviação</th>
        </tr>
        <tr class="bg-gray-900 border-gray-700 text-xs text-yellow-400 uppercase bg-gray-800 border-gray-600 dark:text-yellow-400">
            <td class="px-6 py-4 border border-slate-600"><?php echo $dados3['desTransporte']; ?></td>
            <td class="px-6 py-4 border border-slate-600"><?php echo $dados3['desManutencao']; ?></td>
            <td class="px-6 py-4 border border-slate-600"><?php echo $dados3['desSuprimento']; ?></td>
            <td class="px-6 py-4 border border-slate-600"><?php echo $dados3['desAviacao']; ?></td>
        </tr>
        <tr class="text-xs text-yellow-400 uppercase bg-gray-800 border-gray-600 dark:text-yellow-400">
          <th class="px-6 py-4 ">Recebidos:</th>
          <th class="px-6 py-4 ">Descentralizados:</th>
          <th class="px-6 py-4 ">Liquidados:</th>
          <th class="px-6 py-4 ">Devolvidos:</th>
        </tr>
        <tr class="bg-gray-900  border-gray-700 text-xs text-yellow-400 uppercase bg-gray-800 border-gray-600 dark:text-yellow-400" >
            <td class="px-6 py-4 border border-slate-600 "><?php echo "R$:". $dados4['recebidos']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo "R$:". $dados4['descentralizados']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo "R$:". $dados4['liquidados']; ?></td>
            <td class="px-6 py-4 border border-slate-600 "><?php echo "R$:". $dados4['devolvidos']; ?></td>
        </tr>
        <tr class="text-xs text-yellow-400 uppercase bg-gray-800 border-gray-600 dark:text-yellow-400">
          <th class="px-6 py-4">Relatório Final</th>
          <th class="px-6 py-4">Relatório do Comando Logístico</th>
          <th class="px-6 py-4">Fotos</th>
          <th class="px-6 py-4">Outros documentos</th>
        </tr>
        <tr>
          <td style="color:gray-700;" class="px-6 py-4 border border-slate-600 "><a href="../../uploads/<?php echo $dados6['relatorioFinal'] ?>" target="_blank"><?php echo $dados6['relatorioFinal'] ?></a></td>
          <td style="color:gray-700;" class="px-6 py-4 border border-slate-600 "><a href="../../uploads/<?php echo $dados6['relatorioComando'] ?>" target="_blank"><?php echo $dados6['relatorioComando'] ?></a></td>
          <td style="color:gray-700;" class="px-6 py-4 border border-slate-600 "><a href="../../uploads/<?php echo $dados6['fotos'] ?>" target="_blank"><?php echo $dados6['fotos'] ?></a></td>
          <td style="color:gray-700;" class="px-6 py-4 border border-slate-600 "><a href="../../uploads/<?php echo $dados6['outrosDocumentos'] ?>" target="_blank"><?php echo $dados6['outrosDocumentos'] ?></a></td>
        </tr>
        <tr >
          <th class="text-xs text-white-400 uppercase bg-gray-800 border-gray-600 dark:text-white-400" colspan="9">Outras informações</th>
        </tr>
        <tr>
          <td class="px-6 py-4 border border-slate-600 "  colspan="9" rowspan="1" ><?php echo $dados5['outrasInfos'];?></td>
        </tr>
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
      </table>
    </div>
  </div>

  <!-- script da navbar --> 
  <script src="/src/navbar.js"></script>

</body>
</html>  
