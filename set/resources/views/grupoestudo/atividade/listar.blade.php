@extends('portal')

@section('content')
  <div class="container">
    </br>
    @if (isset($codGrupoEstudos))
      <a href="/grupodeestudos/{{$codGrupoEstudos}}/atividade/adicionar" class="btn btn-primary">Adicionar</a>
    @endif
    
    </br></br>
    <h1>Atividades</h1>
    </br>
    <div class="row">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Data da Atividade</th>
            <th scope="col">Nome da Atividade</th>
            <th scope="col">Descrição da Atividade</th>
            <th scope="col">Criador</th>
          </tr>
        </thead>
        <tbody>
          @php
            $contador = 1;
          @endphp
          @foreach ($atividades as $atividade)
            <tr>
              <th>{{$contador}}</th>
              <td>{{date("d/m/Y", strtotime($atividade->dataAtividade))}}</td>
              <td>{{$atividade->nomeAtividade}}</td>
              <td>{{$atividade->descrAtividade}}</td>
              <td>{{$atividade->nomeAluno}}</td>
            </tr>
            @php
              $contador++;
            @endphp
          @endforeach
        </tbody>
      </table>
  </div>

@endsection
