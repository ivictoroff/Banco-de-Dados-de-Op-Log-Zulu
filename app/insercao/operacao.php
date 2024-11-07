<?php

//anexos

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $file = $_FILES["fileUpload"];

  $dirUploads = "../uploads";

  if (!is_dir($dirUploads)) {

      mkdir($dirUploads);

  }

  if (move_uploaded_file($file["tmp_name"], $dirUploads . DIRECTORY_SEPARATOR . $file["name"])) {

      echo "Upload realizado com sucesso!";
      $relatorioFinal = $file["name"];

  } else {

      throw new Exception("Não foi possível reaizar o upload.");

  }

}

//operação
$operacao = @$_REQUEST['operacao'];
$estado = @$_REQUEST['estado'];
$missao = @$_REQUEST['missao'];
$cma = @$_REQUEST['cma'];
$rm = @$_REQUEST['rm'];
$comandoOp = @$_REQUEST['comandoOp'];
$comandoApoio = @$_REQUEST['comandoApoiado'];
$inicioOp = @$_REQUEST['inicioOp'];
$fimOp = @$_REQUEST['fimOp'];

//efetivo
$participantes = @$_REQUEST['participantes'];
$participantesEb = @$_REQUEST['participantesEb'];
$participantesEb = @$_REQUEST['participantesMb'];
$participantesFab = @$_REQUEST['participantesFab'];
$participantesOs = @$_REQUEST['participantesOs'];
$participantesGov = @$_REQUEST['participantesGov'];
$participantesPv = @$_REQUEST['participantesPv'];
$participantesCv = @$_REQUEST['participantesCv'];

//tipos de operações
$tipoOp = @$_REQUEST['tipoOp'];
$acaoOuApoio = @$_REQUEST['acaoOuApoio'];
$apoioDesempenhado = @$_REQUEST['apoioDesempenhado'];

//recursos aprovisionados
$recebidos = @$_REQUEST['recebidos'];
$descentralizados = @$_REQUEST['descentralizados'];
$empenhados = @$_REQUEST['empenhados'];
$devolvidos = @$_REQUEST['devolvidos'];

//outras infos
$outrasInfos = @$_REQUEST['outrasInfos'];

// anexos 




$submit= @$_REQUEST['submit'];


$conn = new PDO ("mysql:dbname=dbmat;host=localhost", "root", "");
if ($submit) {

  if($operacao == "" || $missao == ""){
    echo "<script:alert('Por favor, preencha todos os campos!');</script>";
  }
  else {
    $stmt = $conn->prepare("INSERT INTO operacao (operacao,estado, missao, cma, rm, comandoOp, comandoApoio, inicioOp, fimOp) VALUES (:OPERACAO, :ESTADO, :MISSAO, :CMA, :RM, :COMANDOOP, :COMANDOAPOIO, :INICIOOP, :FIMOP)");

    $stmt -> bindParam(":OPERACAO", $operacao);
    $stmt -> bindParam(":ESTADO", $estado);
    $stmt -> bindParam(":MISSAO", $missao);
    $stmt -> bindParam(":CMA", $cma);
    $stmt -> bindParam(":RM", $rm);
    $stmt -> bindParam(":COMANDOOP", $comandoOp);
    $stmt -> bindParam(":COMANDOAPOIO", $comandoApoio);
    $stmt -> bindParam(":INICIOOP", $inicioOp);
    $stmt -> bindParam(":FIMOP", $fimOp);

    $stmt->execute();

    $stmt = $conn->prepare("INSERT INTO efetivo (participantes,participantesEb, participantesMb,participantesFab,participantesOs,participantesGov,participantesPv,participantesCv) VALUES (:PARTICIPANTES, :PARTICIPANTESEB, :PARTICIPANTESMB, :PARTICIPANTESFAB, :PARTICIPANTESOS, :PARTICIPANTESGOV, :PARTICIPANTESPV, :PARTICIPANTESCV)");
    $stmt -> bindParam(":PARTICIPANTES", $participantes);
    $stmt -> bindParam(":PARTICIPANTESEB", $participantesEb);
    $stmt -> bindParam(":PARTICIPANTESMB", $participantesMb);
    $stmt -> bindParam(":PARTICIPANTESFAB", $participantesFab);
    $stmt -> bindParam(":PARTICIPANTESOS", $participantesOs);
    $stmt -> bindParam(":PARTICIPANTESGOV", $participantesGov);
    $stmt -> bindParam(":PARTICIPANTESPV", $participantesPv);
    $stmt -> bindParam(":PARTICIPANTESCV", $participantesCv);

    $stmt -> execute();

    $stmt = $conn->prepare("INSERT INTO tipoOp (tipoOp,acaoOuApoio, apoioDesempenhado) VALUES (:TIPOOP, :ACAOOUAPOIO, :APOIODESEMPENHADO)");
    $stmt -> bindParam(":TIPOOP", $tipoOp);
    $stmt -> bindParam(":ACAOOUAPOIO", $acaoOuApoio);
    $stmt -> bindParam(":APOIODESEMPENHADO", $apoioDesempenhado);

    $stmt -> execute();

    $stmt = $conn->prepare("INSERT INTO recursos (recebidos,descentralizados, empenhados, devolvidos) VALUES (:RECEBIDOS, :DESCENTRALIZADO, :EMPENHADOS, :DEVOLVIDOS)");
    $stmt -> bindParam(":RECEBIDOS", $recebidos);
    $stmt -> bindParam(":DESCENTRALIZADO", $descentralizados);
    $stmt -> bindParam(":EMPENHADOS", $empenhados);
    $stmt -> bindParam(":DEVOLVIDOS", $devolvidos);

    $stmt -> execute();

    $stmt = $conn->prepare("INSERT INTO infos (outrasInfos) VALUES (:OUTRASINFOS)");
    $stmt -> bindParam(":OUTRASINFOS", $outrasInfos);

    $stmt -> execute();

    $stmt = $conn->prepare("INSERT INTO anexos (relatorioFinal) VALUES (:RELATORIOFINAL)");
    $stmt -> bindParam(":RELATORIOFINAL", $relatorioFinal);

    $stmt -> execute();

  }
  header("Location: operacao.php");
}

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
             
            </style> 
        </head>
    <body>
      
      <header class="flex bg-neutral-950 shadow-xl shadow-slate-400 px-8 py-4 justify-between sticky top-0 z-10"> 
        <div id= "area-principal">
            <a href="" id="atual">inserir dados</a>
            <a href="/app/pesquisa/operacao.php">pesquisar</a>
        </div>
      </header>

            <header class="block bg-neutral-950 shadow-xl shadow-slate-400 px-8 py-4 justify-between sticky top-0 z-10"> 
<div style="text-align:center;">
                <h1 style="text-align: center;">OPERAÇÃO</h1>
                </div>
              </header>
      
      <section>
      <form method="POST" enctype="multipart/form-data">
          <div id="operacao">
            <input required class="border-2 rounded-lg border-slate-800" type="text" id="operacao" name="operacao" placeholder="nome da operação">
            <select class="border-2 rounded-lg border-slate-800" id="estado" name="estado" placeholder="estados">
              <option value="null">selecione o estado</option>
              <option value="AC">Acre</option>
              <option value="AL">Alagoas</option>
              <option value="AP">Amapá</option>
              <option value="AM">Amazonas</option>
              <option value="BA">Bahia</option>
              <option value="CE">Ceará</option>
              <option value="DF">Distrito Federal</option>
              <option value="ES">Espírito Santo</option>
              <option value="GO">Goiás</option>
              <option value="MA">Maranhão</option>
              <option value="MT">Mato Grosso</option>
              <option value="MS">Mato Grosso do Sul</option>
              <option value="MG">Minas Gerais</option>
              <option value="PA">Pará</option>
              <option value="PB">Paraíba</option>
              <option value="PR">Paraná</option>
              <option value="PE">Pernambuco</option>
              <option value="PI">Piauí</option>
              <option value="RJ">Rio de Janeiro</option>
              <option value="RN">Rio Grande do Norte</option>
              <option value="RS">Rio Grande do Sul</option>
              <option value="RO">Rondônia</option>
              <option value="RR">Roraima</option>
              <option value="SC">Santa Catarina</option>
              <option value="SP">São Paulo</option>
              <option value="SE">Sergipe</option>
              <option value="TO">Tocantins</option>
              <option value="EX">Estrangeiro</option>
            </select>
            <input class="border-2 rounded-lg border-slate-800" type="text" name="missao" placeholder="missão">
            <select class="border-2 rounded-lg border-slate-800" id="cma" name="cma" placeholder="comando militar de area">
              <option > selecione o comando militar de área</option>
              <option value="CMN">Comando Militar do Norte</option>
              <option value="CMA">Comando Militar da Amazônia</option>
              <option value="CMO">Comando Militar do Oeste</option>
              <option value="CMS">Comando Militar do Sul</option>
              </select>

            <select class="border-2 rounded-lg border-slate-800" id="rm" name="rm">
              <option value="null"> selecione a regiao militar</option>
              <option value="primeira">1ª região militar</option>
              <option value="segunda">2ª região militar</option>
              <option value="terceira">3ª região militar</option>
              <option value="quarta">4ª região militar</option>
              <option value="quinta">5ª região militar</option>
              <option value="sexta">6ª região militar</option>
              <option value="setima">7ª região militar</option>
              <option value="oitava">8ª região militar</option>
              <option value="nona">9ª região militar</option>
              <option value="decima">10ª região militar</option>
              <option value="decima-primeira">11ª região militar</option>
              <option value="decima-segunda">12ª região militar</option>
            </select>

            <input class="border-2 rounded-lg border-slate-800" type="text" name="comandoOp" placeholder="comando da operação">
            <input class="border-2 rounded-lg border-slate-800" type="text" name="comandoApoiado" placeholder="comando apoiado"><br>
            <label for="ini">ininio da operação</label>
            <input class="border-2 rounded-lg border-slate-800" type="date" id="ini" name="inicioOp" placeholder="inicio da operação">
            <label for="fim">fim da operação</label>
            <input class="border-2 rounded-lg border-slate-800" type="date" id="fim" name="fimOp" placeholder="término da operação">

            </div>
          <div id="efetivo">
            <div id class="mt-6">
            <header class="block bg-neutral-950 shadow-xl shadow-slate-400 px-8 py-4 justify-between sticky top-0 z-10"> 
                <div style="text-align:center;">
                <h1 style="text-align: center;">EFETIVO</h1>
                </div>
              </header>
            </div>
              <input class="border-2 rounded-lg border-slate-800" type="text" name="participantes" placeholder="participantes">
              <input class="border-2 rounded-lg border-slate-800" type="number" name="participantesEb" placeholder="participantes do exercito Brasileiro">
              <input class="border-2 rounded-lg border-slate-800" type="number" name="participantesMb" placeholder="participantes da marinha do Brasil">
              <input class="border-2 rounded-lg border-slate-800" type="number" name="participantesFab" placeholder="participantes da forca aérea Brasileira">
              <input class="border-2 rounded-lg border-slate-800" type="number" name="participantesOs" placeholder="participantes de orgãos de Segurança e Ordem Pública">
              <input class="border-2 rounded-lg border-slate-800" type="number" name="participantesGov" placeholder="participantes de outras agências governamentais">
              <input class="border-2 rounded-lg border-slate-800" type="number" name="participantesPv" placeholder="participantes de outras agências privadas">
              <input class="border-2 rounded-lg border-slate-800" type="number" name="participantesCv" placeholder="participantes de organizações não governamentais">
            </div>
          <div id="tipos de operacoes">

            <header class="flex bg-neutral-950 shadow-xl shadow-slate-400 px-8 py-4 justify-between sticky top-0 z-10"> 
            </div>
                <h1 style="text-align:center;">TIPOS DE OPERAÇÕES</h1>
              <div class="text-white flex gap-2 items-end mx-2">

              </div>
              </header>
            <select class="border-2 rounded-lg border-slate-800" id="tipoOp" name="tipoOp">
              <option value="REAL">Real</option>
              <option value="EXERCICIO">Exercicio</option>
              </select>
            <select class="border-2 rounded-lg border-slate-800" id="acaoOuApoio" name="acaoOuApoio">
              <option value="logística para Operações de Garantia da Soberania">logística para Operações de Garantia da Soberania</option>
              <option value="GLO">logística de apoio a operacoes garantia da lei e da ordem</option>
              <option value="GVA">logística de apoio a garantia da votação e apuração </option>
              <option value="logística de apoio a defesa civil">logística de apoio a defesa civil</option>
              <option value="logística de apoio as ações subsidiarias">logística de apoio as ações subsidiarias</option>
              <option value="logística de apoio a operacoes internacionais">logística de apoio a operacoes internacionais</option>
              </select>
            <select class="border-2 rounded-lg border-slate-800" id="apoioDesempenhado" name="apoioDesempenhado">
              <option value="transporte">transporte</option>
              <option value="manutencao">manutencao</option>
              <option value="outro">outro</option>
              </select>
              <input class="border-2 rounded-lg border-slate-800" type="text" name="apoioDesempenhado" placeholder="outros" id="out">
            </div>
          <div id="recursos aprovisionados">

            <header class="flex bg-neutral-950 shadow-xl shadow-slate-400 px-8 py-4 justify-between sticky top-0 z-10"> 

              </div>
                <h1 style="text-align:center;">RECURSOS APROVISIONADOS</h1>
              <div class="text-white flex gap-2 items-end mx-2">
                </a>
              </div>
              </header>
            <input class="border-2 rounded-lg border-slate-800" type="text" name="recebidos" placeholder="recebidos">
            <input class="border-2 rounded-lg border-slate-800" type="text" name="descentralizados" placeholder="descentralizados">
            <input class="border-2 rounded-lg border-slate-800" type="text" name="empenhados" placeholder="empenhados">
            <input class="border-2 rounded-lg border-slate-800" type="text" name="devolvidos" placeholder="devolvidos">
            </div>

          <div id="outrasInfos">

            <header class="block bg-neutral-950 shadow-xl shadow-slate-400 px-8 py-4 justify-between sticky top-0 z-10"> 

              </div>
                <h1 style="text-align:center;">OUTRAS INFORMAÇÕES</h1>
              <div class="text-white flex gap-2 items-end mx-2">
                </a>
              </div>
              </header>
            <textarea name="outrasInfos" id="" placeholder="outras informações"></textarea>
            </div>
          <div id="anexos">
                
            <header class="flex bg-neutral-950 shadow-xl shadow-slate-400 px-8 py-4 justify-between sticky top-0 z-10"> 
                <a href="/">
                </a>
              <div class="text-white flex gap-2 items-end mx-2">
                </a>
              </div>
              </header>
              
              </div>
              <input type="file" name="fileUpload">
          
              <input type="submit" name="submit" value="Logar" class="border border-slate-300 hover:border-slate-400 " />
          </form>


      <script>
        //desabilita o botão no início
        document.getElementById("out").disabled = true;
        //cria um event listener que escuta mudanças no input
        document.getElementById("apoioDesempenhado").addEventListener("input", function(event){
          //busca conteúdo do input
            var conteudo = document.getElementById("apoioDesempenhado").value;
            //valida conteudo do input 
            if (conteudo == "outro") {
              //habilita o botão
              document.getElementById("out").disabled = false;
            } else {
              //desabilita o botão se o conteúdo do input ficar em branco
              document.getElementById("out").disabled = true;
            }
        });
        </script>
   </body>
</html>  