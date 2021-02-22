@extends('portal')

@section('content')
    <div class="container">
      <form method="POST" action="/grupodeestudos/avaliacao/adicionar/store">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal text-center">Realização de Avaliação</h1>

        {{-- @php
          echo "<pre>".json_encode($avaliacoes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)."</pre>";die();
        @endphp --}}

        <input type="hidden" name="codGrupoEstudo" value="{{$avaliacoes[0]->codGrupoEstudo}}">
        <input type="hidden" name="codAtividade" value="{{$avaliacoes[0]->codAtividade}}">

        <div class="form-group">
          <label for="nomeAtividade"><b>Data da Atividade:</b> {{date("d/m/Y", strtotime($avaliacoes[0]->dataAtividade))}}</label>
        </div>
        <div class="form-group">
          <label for="nomeAtividade"><b>Nome da Atividade:</b> {{$avaliacoes[0]->nomeAtividade}}</label>
        </div>
        <div class="form-group">
          <label for="descrAtividade"><b>Descrição da Atividade:</b> {{$avaliacoes[0]->descrAtividade}}</label>
        </div>

        <div class="msgErroRemoverAlternativaQ1"></div>

        @php
          $i = 1;
        @endphp
        @foreach ($avaliacoes as $avaliacao)

          @foreach ($avaliacao->questaos as $questao)
            {{-- {{$questao->codQuestao}} --}}
            <fieldset class="border p-2">
              <legend class="scheduler-border">Questão {{$i++}}</legend>
              {{-- <div class="form-group">
                <label for=""><b>Imagem da Questão:</b> {{$questao->imagemQuestao}}</label>
              </div> --}}
              <div class="form-group">
                <label for=""><b>Descrição da Questão:</b> {{$questao->descrQuestao}}</label>
              </div>
              @php
                $contaAlternativa = 1;
              @endphp
              @foreach ($questao->alternativas as $alternativa)
                {{-- {{$alternativa->codAlternativa}} --}}
                <div class="form-group">
                  <div class="row">
                    <div class="col-1">
                      <label for="">{{$alternativa->letraAlternativa}}</label>
                    </div>
                    <div class="col-9">
                      <label for=""><b>Descrição da Alternativa:</b> {{$alternativa->descrAlternativa}}</label>
                    </div>
                    <div class="col-1">
                      <div class="row">
                        {{-- <div class="col-2"></div> --}}
                        <div class="col-1">
                          <input type="checkbox" name="checkboxQ{{$i-1}}A{{$alternativa->codAlternativa}}">
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
                @php
                  $contaAlternativa++;
                @endphp
              @endforeach
            </fieldset>
          @endforeach
        @endforeach

        {{-- @if(isset($errors) and $errors->has('local'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('local') }}</label>
					</div>
				@endif --}}
        <div class="form-group">
          <br />
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </div>
@endsection
