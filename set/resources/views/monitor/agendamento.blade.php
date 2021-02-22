@extends('portal')

@section('content')

  <h1 class="h3 mb-3 font-weight-normal text-center">Meus Agendamentos</h1>

  <table class="table">
  <thead>
    <tr>
      <th scope="col">Monitor</th>
      <th scope="col">Horário de Início</th>
      <th scope="col">Horário de Término</th>
      <th scope="col">Dia</th>
      <th scope="col">Disciplina</th>
      <th scope="col">Desmarcar</th>
    </tr>
  </thead>
  <tbody id="listaMonitores">
    @if (isset($agendamentos))


      @foreach ($agendamentos as $agendamento)
        <tr>
          <th>{{$agendamento->nomeAluno}}</th>
          <th>{{$agendamento->horaInicioMonitor}}</th>
          <th>{{$agendamento->horaTerminoMonitor}}</th>
          <th>{{ucfirst($agendamento->diaMonitor)}}</th>
          <th>{{$agendamento->nomeDisciplina}}</th>
          <th><a type="submit" class="btn btn-danger" href="agendamento/deletar/{{$agendamento->codDisciplina}}/{{$agendamento->cpfAluno}}">Desmarcar</a></br></th>
        </tr>

      @endforeach
    @endif

  </tbody>
</table>

</br></br></br></br></br></br></br>

@endsection
