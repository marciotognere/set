@extends('portal')

@section('content')
  <div class="container">
    </br>
    <a href="agendamento/adicionar" class="btn btn-primary">Adicionar</a>
    </br></br>
    <h1>Agendamentos do Grupo de Estudos</h1>
    </br>
    <div class="row">

      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome do Agendamento</th>
            <th scope="col">Descrição do Agendamento</th>
            <th scope="col">Data do Agendamento</th>
            <th scope="col">Horário</th>
            <th scope="col">Local</th>
            <th scope="col">Monitor</th>
            <th scope="col">Remover</th>
          </tr>
        </thead>
        <tbody>
          @php
            $contador = 1;
          @endphp
          @foreach ($agendamentos as $agendamento)
            <tr>
              <th scope="row">{{$contador}}</th>
              <td>{{$agendamento->nomeAgendamento}}</td>
              <td>{{$agendamento->descrAgendamento}}</td>
              <td>{{date("d/m/Y", strtotime($agendamento->dataAgendamento))}}</td>
              <td>{{$agendamento->horaAgendamento}}</td>
              <td>{{$agendamento->nomeLocal}}</td>
              <td>
                @if (empty($agendamento->nomeAluno))
                  {{"Sem monitor"}}
                @else
                  {{ucwords($agendamento->nomeAluno)}}
                @endif

              </td>
              <td><a href="agendamento/destroy/{{base64_encode($agendamento->codAgendamento)}}&&{{base64_encode($agendamento->codLocal)}}" class="btn btn-danger">Remover</a></td>
            </tr>
            @php
              $contador++;
            @endphp
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
