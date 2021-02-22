@extends('portal')

@section('content')
  <div class="container">
    </br>
    <a href="membros/adicionar" class="btn btn-primary">Adicionar</a>
    </br></br>
    <h1>Membros do Grupo de Estudos</h1>
    </br>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nome do Aluno</th>
          <th scope="col">Data de Ingresso no Grupo</th>
          <th scope="col">Administrador</th>
          <th scope="col">Remover</th>
        </tr>
      </thead>
      <tbody>

        @php
          $contador = 1;
        @endphp
        @foreach ($membros as $membro)

          <tr>
            <th>{{$contador}}</th>
            <td>{{$membro->nomeAluno}}</td>
            <td>{{date("d/m/Y", strtotime($membro->inicioMembro))}}</td>
            <td>
              <label for="">
                @if ($membro->admMembro == 1)
                  Sim
                @else
                  Não
                @endif
              </label>
            </td>
            <td><a href="membros/destroy/{{base64_encode($membro->cpfAluno)}}" class="btn btn-danger">Remover</a></td>
          </tr>
          @php
            $contador++;
          @endphp
        @endforeach

      </tbody>
    </table>
  </div>
@endsection
