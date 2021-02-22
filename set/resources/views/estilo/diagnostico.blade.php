@extends('home')

@section('head')
  <script src="{{ asset('js/estilo.js') }}"></script>
  <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
@endsection

@section('content')
  <form method="POST" action="estilo/salvar">
    @csrf
    <div class="container">
      <h1 class="h3 mb-3 font-weight-normal text-center">Diagnóstico do Estilo de Aprendizagem</h1>
      @if (isset($msgErro))
        <div class="alert alert-warning">
          <label>{{ $msgErro }}</label><br/>
        </div>
      @endif

      @if (isset($questoes))
        @foreach ($questoes as $questao)
          <div class="card">
            <div class="row align-items-center">
              {{-- <div class="card-body" id="myDIV" style="border: 1px solid red; float:left"> --}}
                <div class="col-8"><!-- style="border: 2px solid orange">-->
                  {{$questao->codExame}}
                  {{$questao->descrExame}}
                  {{-- {{$questao->codTipoEstilo}} --}}
                </div>
                <div class="col-4 nota"><!-- style="border: 2px solid blue">-->
                  <div data-toggle="buttons" class="btn-group-toggle"><!-- style="border: 2px solid red"> <!- - class="btn-group-toggle" -->
                    <label class="btn btn-light" id="{{$questao->codExame}}1">
                      <input type="radio" name="questao{{$questao->codExame}}" onclick="apertaBotao('{{$questao->codExame}}1')" value="1"> 1
                    </label>
                    <label class="btn btn-light" id="{{$questao->codExame}}2">
                      <input type="radio" name="questao{{$questao->codExame}}" onclick="apertaBotao('{{$questao->codExame}}2')" value="2"> 2
                    </label>
                    <label class="btn btn-light" id="{{$questao->codExame}}3">
                      <input type="radio" name="questao{{$questao->codExame}}" onclick="apertaBotao('{{$questao->codExame}}3')" value="3"> 3
                    </label>
                    <label class="btn btn-light" id="{{$questao->codExame}}4">
                      <input type="radio" name="questao{{$questao->codExame}}" onclick="apertaBotao('{{$questao->codExame}}4')" value="4"> 4
                    </label>
                  </div>
                </div>
              {{-- </div> --}}
            </div>
          </div>
        @endforeach
      @endif
      <div class="alert alert-danger">
        <label>Responda todas as perguntas para diagnosticar seu estilo de aprendizagem.</label><br/>
      </div>
      <button type="submit" class="btn btn-primary">Diagnosticar Estilo</button>
    </div>
  </form>
@endsection
