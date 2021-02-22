@extends('portal')

@section('content')
  <div class="container">
    </br></br>
    <h1>Ranque</h1>
    </br>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Aluno</th>
          <th scope="col">Pontos</th>
        </tr>
      </thead>
      <tbody>
        @php
          $contador = 1;
        @endphp
        @foreach ($ranques as $ranque)
          <tr>
            <th>{{$contador}}</th>
            <td>{{$ranque->nomeAluno}}</td>
            <td>{{$ranque->pontos}}</td>
          </tr>
          @php
            $contador++;
          @endphp
        @endforeach

      </tbody>
    </table>


  </div>
@endsection
