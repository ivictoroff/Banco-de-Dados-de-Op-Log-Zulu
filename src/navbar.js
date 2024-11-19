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
};

// ocultar navbar

function ocultar(pagina) {
    // Esconde todos os conteúdos
    document.querySelectorAll('.conteudo').forEach(conteudo => {
      conteudo.classList.remove('ativo');
  
      document.querySelectorAll('.vai').forEach(conteudo => {
      conteudo.classList.remove('sm:ml-64');
  
    });
    });
      
    // Mostra o conteúdo selecionado
    document.getElementById(`conteudo-${pagina}`).classList.add('ativo');
    
    // Adiciona classe active ao tab selecionado
    document.querySelectorAll('.tab').forEach(tab => {
      tab.classList.remove('active');
    });
    document.querySelector(`.tab:nth-child(${pagina})`).classList.add('active');
  
  };