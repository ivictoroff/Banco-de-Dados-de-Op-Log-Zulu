<!DOCTYPE html>
<html>
<head>
  <title>Paginacao de Campos</title>
  <style>
    /* Estilo para os tabs */
    .tabs {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }
    
    .tab {
      width: 50%;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      cursor: pointer;
    }
    
    .tab.active {
      background-color: #f0f0f0;
    }
    
    .conteudo {
      display: none;
    }
    
    .conteudo.ativo {
      display: block;
    }
  </style>
</head>
<body>
  <div class="tabs">
    <div class="tab active" onclick="mostrarConteudo(1)">Página 1</div>
    <div class="tab" onclick="mostrarConteudo(2)">Página 2</div>
    <div class="tab" onclick="mostrarConteudo(3)">Página 3</div>
  </div>
  
  <div class="conteudo ativo" id="conteudo-1">
    <h2>Página 1</h2>
    <form>
      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome"><br><br>
      <label for="email">E-mail:</label>
      <input type="email" id="email" name="email"><br><br>
    </form>
  </div>
  
  <div class="conteudo" id="conteudo-2">
    <h2>Página 2</h2>
    <form>
      <label for="telefone">Telefone:</label>
      <input type="text" id="telefone" name="telefone"><br><br>
      <label for="endereco">Endereço:</label>
      <input type="text" id="endereco" name="endereco"><br><br>
    </form>
  </div>
  
  <div class="conteudo" id="conteudo-3">
    <h2>Página 3</h2>
    <form>
      <label for="cidade">Cidade:</label>
      <input type="text" id="cidade" name="cidade"><br><br>
      <label for="estado">Estado:</label>
      <input type="text" id="estado" name="estado"><br><br>
      <button>Enviar</button>
    </form>
  </div>
  
  <script>
    // Função para mostrar o conteúdo
    function mostrarConteudo(pagina) {
      // Esconde todos os conteúdos
      document.querySelectorAll('.conteudo').forEach(conteudo => {
        conteudo.classList.remove('ativo');
      });
      
      // Mostra o conteúdo selecionado
      document.getElementById(`conteudo-${pagina}`).classList.add('ativo');
      
      // Adiciona classe active ao tab selecionado
      document.querySelectorAll('.tab').forEach(tab => {
        tab.classList.remove('active');
      });
      document.querySelector(`.tab:nth-child(${pagina})`).classList.add('active');
    }
  </script>
</body>
</html>
