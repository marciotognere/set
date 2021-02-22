@extends('portal')

@section('content')
  <div class="container">
    </br>

    @if (isset($codGrupoEstudo))
      <a href="/grupodeestudos/{{$codGrupoEstudo}}/avaliacoes/{{$atividades[0]->codAtividade}}" class="btn btn-primary">Adicionar</a>
    @endif

    </br></br>
    <h1>Avaliações</h1>
    </br>
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Nome da Avaliação</th>
          <th>Nome do Grupo</th>
          <th>Autor</th>
          <th>Nº de Questões</th>
          {{-- <th>Entrar</th> --}}
        </tr>
      </thead>
      <tbody>
        @php
          $contador = 1;
        @endphp
        @foreach ($atividades as $atividade)
          <tr>
            <th>{{$contador}}</th>
            <td>{{$atividade->nomeAtividade}}</td>
            <td>{{$atividade->nomeGrupoEstudo}}</td>
            <td>{{$atividade->nomeAluno}}</td>
            <td>{{$atividade->quantQuestoes}}</td>
            {{-- <td><a href="avaliacoes/{{$atividade->codAtividade}}" class="btn btn-primary">Entrar</a> </td> --}}
          </tr>
          @php
            $contador++;
          @endphp
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
