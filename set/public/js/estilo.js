function apertaBotao(id) {
  var questao = "";

  switch (id.length) {
    case 2:
      questao = id.substr(0,1);
      break;
    case 3:
      questao = id.substr(0,2);
      break;
    default:
      console.log('erro no length da id do botão de nota!');
  }

  var botao1 = $('#'+questao+'1').removeClass('btn-primary');
  var botao2 = $('#'+questao+'2').removeClass('btn-primary');
  var botao3 = $('#'+questao+'3').removeClass('btn-primary');
  var botao4 = $('#'+questao+'4').removeClass('btn-primary');
  var botao1 = $('#'+questao+'1').addClass('btn-light');
  var botao2 = $('#'+questao+'2').addClass('btn-light');
  var botao3 = $('#'+questao+'3').addClass('btn-light');
  var botao4 = $('#'+questao+'4').addClass('btn-light');

  var novo = $('#'+id).removeClass('btn-light');
  var novo = $('#'+id).addClass('btn-primary');
}
