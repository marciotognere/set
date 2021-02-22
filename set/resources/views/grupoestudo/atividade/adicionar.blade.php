@extends('portal')

@section('header')
  <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
@endsection

@section('content')
  <div class="container">
    <form method="POST" action="adicionar/store">
      @csrf
      <h1 class="h3 mb-3 font-weight-normal text-center">Adicionar Atividades</h1>
      <div class="form-group">
        <label for="grupoEstudo">Grupo de Estudo</label>
        <select class="form-control" id="grupoEstudo" name="grupoEstudo">
          <option value="{{$grupos[0]->codGrupoEstudo}}">{{$grupos[0]->nomeGrupoEstudo}}</option>
        </select>
      </div>
      @if(isset($errors) and $errors->has('grupoEstudo'))
        <div class="alert alert-danger">
          <label>{{ $errors->first('grupoEstudo') }}</label>
        </div>
      @endif

      <div class="form-group">
        <label for="nomeAtividade">Nome da Atividade</label>
        <input type="input" class="form-control" id="nomeAtividade" name="nomeAtividade" required>
      </div>

      <div class="form-group">
        <label for="descrAtividade">Descrição da Atividade</label>
        <input type="text" class="form-control" id="descrAtividade" name="descrAtividade" required>
      </div>

      <div id="blocoQuestoes">
        <fieldset class="border p-2 QuantQuestoesTodas" id="Q1">
          <legend class="scheduler-border">Questão 01</legend>
          {{-- <div class="form-group">
            <label for="imgQuestaoQ1">Imagem da Questão</label>
            <input type="file" class="form-control" id="imgQuestaoQ1" name="imgQuestaoQ1">
          </div> --}}
          <div class="form-group">
            <label for="descrQuestaoQ1">Descrição da Questão</label>
            <input type="text" class="form-control" id="descrQuestaoQ1" name="descrQuestaoQ1">
          </div>

          <div id="blocoAlternativasQ1">
            <div class="form-group QuantAlternativaQ1" id="Q1A1">
              <div class="row">
                <div class="col-1">
                  <label for="">A</label>
                  <input type="hidden" name="letraAlternativaQ1A1" value="A">
                </div>
                <div class="col-9">
                  <input type="text" class="form-control" id="inputTextQ1A1" name="inputTextQ1A1">
                </div>
                <div class="col-1">
                  <div class="row">
                    {{-- <div class="col-2"></div> --}}
                    <div class="col-1">
                      <input type="checkbox" name="checkboxQ1A1" value="0" onclick="mudaValorCheckbox('checkboxQ1A1')">
                    </div>
                    <div class="col-2">
                      <label for="">Correta</label>
                    </div>
                  </div>
                </div>
                <div class="col-1">
                </div>
              </div>
            </div>
          </div>

          <div class="msgErroRemoverAlternativaQ1"></div>

          <button type="button" class="btn btn-primary" value="Q1" onclick="adicionarAlternativa(this.value)">Adicionar Alternativa</button>
        </fieldset>
      </div>

      <button type="button" class="btn btn-primary" id="adicionarQuestoes">Adicionar Questão</button>

      <div class="form-group">
        <br />
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    </form>
  </div>

@endsection

@section('footer')
  <script type="text/javascript">
    function adicionarAlternativa(identificacao) {
        var novaalternativa = '';
        novaalternativa += '<div class="form-group QuantAlternativa'+identificacao+'" id="'+identificacao+'A'+(quantidadeAlternativas(identificacao) + 1)+'">';
        novaalternativa += '  <div class="row">';
        novaalternativa += '    <div class="col-1">';
        novaalternativa += '      <label for="">'+converteParaLetra(quantidadeAlternativas(identificacao))+'</label>';
        novaalternativa += '      <input type="hidden" name="letraAlternativa'+identificacao+'A'+(quantidadeAlternativas(identificacao) + 1)+'" value="'+converteParaLetra(quantidadeAlternativas(identificacao))+'">';
        novaalternativa += '    </div>';
        novaalternativa += '    <div class="col-9">';
        novaalternativa += '      <input type="text" class="form-control" id="inputText'+identificacao+'A'+(quantidadeAlternativas(identificacao) + 1)+'" name="inputText'+identificacao+'A'+(quantidadeAlternativas(identificacao) + 1)+'">';
        novaalternativa += '    </div>';
        novaalternativa += '    <div class="col-1">';
        novaalternativa += '      <div class="row">';
        novaalternativa += '        {{-- <div class="col-2"></div> --}}';
        novaalternativa += '        <div class="col-1">';
        novaalternativa += '          <input type="checkbox" name="checkbox'+identificacao+'A'+(quantidadeAlternativas(identificacao) + 1)+'" value="0" onclick="mudaValorCheckbox(\'checkbox'+identificacao+'A'+(quantidadeAlternativas(identificacao) + 1)+'\')">';
        novaalternativa += '        </div>';
        novaalternativa += '        <div class="col-2">';
        novaalternativa += '          <label for="">Correta</label>';
        novaalternativa += '        </div>';
        novaalternativa += '      </div>';
        novaalternativa += '    </div>';
        novaalternativa += '    <div class="col-1">';
        novaalternativa += '      <button type="button" class="btn btn-danger" value="'+identificacao+'A'+(quantidadeAlternativas(identificacao) + 1)+'" onclick="removerQuestao(this.value)">-</button>';
        novaalternativa += '    </div>';
        novaalternativa += '  </div>';
        novaalternativa += '</div>';

        $("#blocoAlternativas"+identificacao).append(novaalternativa);

    }

    function quantidadeAlternativas(identificacao) {
        return $(".QuantAlternativa"+identificacao).length;
    }

    function quantidadeQuestoes() {
        return $("#blocoQuestoes .QuantQuestoesTodas").length;
    }

    function converteParaLetra(letra) {
      var alfabeto = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      return alfabeto[letra];
    }

    function converteParaNumero(letras) {
      var alfabeto = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      var codigos = [];
      for (var i in letras) {
        codigos.push(alfabeto.indexOf(letras[i].toUpperCase()));
      }
      return codigos;
    }

    function removerQuestao(identificacao) {
      var questao     = identificacao.substr(0, 2);
      var alternativa = identificacao.substr(2, 2);

      if (alternativa[1] < quantidadeAlternativas(questao)) {
        showMsgErroRemoverAlternativa(questao);
      }else if(questao[1] < quantidadeQuestoes()){
        showMsgErroRemoverQuestao(questao);
      }else {
        $('#'+identificacao).remove();
      }
    }

    $("#adicionarQuestoes").click(function(){
      var novaquestao = '';
      novaquestao += '<fieldset class="border p-2 QuantQuestoesTodas" id="Q'+(quantidadeQuestoes()+1)+'">';
      novaquestao += '  <legend class="scheduler-border">Questão '+(quantidadeQuestoes()+1)+'</legend>';
      novaquestao += '  <div class="form-group">';
      novaquestao += '    <label for="imgQuestaoQ'+(quantidadeQuestoes() + 1)+'">Imagem da Questão</label>';
      novaquestao += '    <input type="file" class="form-control" id="imgQuestaoQ'+(quantidadeQuestoes() + 1)+'" name="imgQuestaoQ'+(quantidadeQuestoes() + 1)+'">';
      novaquestao += '  </div>';
      novaquestao += '  <div class="form-group">';
      novaquestao += '    <label for="descrQuestaoQ'+(quantidadeQuestoes() + 1)+'">Descrição da Questão</label>';
      novaquestao += '    <input type="text" class="form-control" id="descrQuestaoQ'+(quantidadeQuestoes() + 1)+'" name="descrQuestaoQ'+(quantidadeQuestoes() + 1)+'">';
      novaquestao += '  </div>';

      novaquestao += '        <div id="blocoAlternativasQ'+(quantidadeQuestoes()+1)+'">';
      novaquestao += '          <div class="form-group QuantAlternativaQ'+(quantidadeQuestoes() + 1)+'" id="Q'+(quantidadeQuestoes() + 1)+'A'+(quantidadeAlternativas() + 1)+'">';
      novaquestao += '            <div class="row">';
      novaquestao += '              <div class="col-1">';
      novaquestao += '                <label for="">A</label>';
      novaquestao += '                <input type="hidden" name="letraAlternativaQ'+(quantidadeQuestoes() + 1)+'A'+(quantidadeAlternativas() + 1)+'" value="A">';
      novaquestao += '              </div>';
      novaquestao += '              <div class="col-9">';
      novaquestao += '                <input type="text" class="form-control" id="inputTextQ'+(quantidadeQuestoes() + 1)+'A'+(quantidadeAlternativas() + 1)+'" name="inputTextQ'+(quantidadeQuestoes() + 1)+'A'+(quantidadeAlternativas() + 1)+'">';
      novaquestao += '              </div>';
      novaquestao += '              <div class="col-1">';
      novaquestao += '                <div class="row">';
      novaquestao += '                  {{-- <div class="col-2"></div> --}}';
      novaquestao += '                  <div class="col-1">';
      novaquestao += '                    <input type="checkbox" name="checkboxQ'+(quantidadeQuestoes() + 1)+'A'+(quantidadeAlternativas() + 1)+'" value="0" onclick="mudaValorCheckbox(\''+"checkboxQ"+(quantidadeQuestoes() + 1)+'A'+(quantidadeAlternativas() + 1)+'\')">';
      novaquestao += '                  </div>';
      novaquestao += '                  <div class="col-2">';
      novaquestao += '                    <label for="">Correta</label>';
      novaquestao += '                  </div>';
      novaquestao += '                </div>';
      novaquestao += '              </div>';
      novaquestao += '              <div class="col-1">';
      novaquestao += '              </div>';
      novaquestao += '            </div>';
      novaquestao += '          </div>';
      novaquestao += '        </div>';
      novaquestao += '  <div class="msgErroRemoverAlternativaQ'+(quantidadeQuestoes() + 1)+'"></div>';
      novaquestao += '  <button type="button" class="btn btn-primary" value="Q'+(quantidadeQuestoes() + 1)+'" onclick="adicionarAlternativa(this.value)">Adicionar Alternativa</button>';
      novaquestao += '  <button type="button" class="btn btn-primary" value="Q'+(quantidadeQuestoes() + 1)+'" onclick="removerQuestao(this.value)">Remover Questão</button>';
      novaquestao += '</fieldset>';
      novaquestao += '<div class="msgErroRemoverQuestaoQ'+(quantidadeQuestoes() + 1)+'"></div>';

      $("#blocoQuestoes").append(novaquestao);

    });

    function mudaValorCheckbox(nomeCheckbox) {
      var valor = $("input[name="+nomeCheckbox+"]").val();

      if (valor == "0") {
        $("input[name="+nomeCheckbox+"]").attr('value',1);
      }else {
        $("input[name="+nomeCheckbox+"]").attr('value',0);
      }
    }

    function showMsgErroRemoverAlternativa(questao) {
      var mensagem = '';
      mensagem += '<div class="alert alert-danger showMsgErroRemoverAlternativa'+questao+'" role="alert">';
      mensagem += '  Apenas é possível remover alternativas mais recentes para as mais antigas!';
      mensagem += '</div>';

      $(".msgErroRemoverAlternativa"+questao).append(mensagem);

      $('.showMsgErroRemoverAlternativa'+questao).fadeOut(10000, function() {
          $('.showMsgErroRemoverAlternativa'+questao).remove();
      });
    }

    function showMsgErroRemoverQuestao(questao) {
      var mensagem = '';
      mensagem += '<div class="alert alert-danger showMsgErroRemoverQuestao'+questao+'" role="alert">';
      mensagem += '  Apenas é possível remover questões mais recentes para as mais antigas!';
      mensagem += '</div>';

      $(".msgErroRemoverQuestao"+questao).append(mensagem);

      $('.showMsgErroRemoverQuestao'+questao).fadeOut(10000, function() {
          $('.showMsgErroRemoverQuestao'+questao).remove();
      });
    }

  </script>
@endsection
