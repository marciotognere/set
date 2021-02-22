@extends('portal')

@section('content')
  <h1 class="h3 mb-3 font-weight-normal text-center">Agendamento de Monitoria</h1>

  <div class="container">
    <form method="POST" action="horario/salvar">
      @csrf

        @php
          $contador = 1;
        @endphp

        @foreach ($disciplinas as $disciplina)

          <div class="card">
            <div class="card-header">
            <b>{{$disciplina->nomeDisciplina}}</b>
            </div>
            <div class="card-body">

              <input type="hidden" class="form-control" name="codDisciplina{{$contador}}" value="{{$disciplina->codDisciplina}}">

              <label for="">Hora de Início</label>
              <input type="time" class="form-control" name="horaInicio{{$contador}}" required>
              <label for="">Hora de Término</label>
              <input type="time" class="form-control" name="horaTermino{{$contador}}" required>

              <label for="">Dia</label>
              <select class="form-control" id="listaCursos" name="dia{{$contador}}" required>
                  <option disabled selected>Escolha</option>
                  <option value="domingo">Domingo</option>
                  <option value="segunda">Segunda</option>
                  <option value="terca">Terça</option>
                  <option value="quarta">Quarta</option>
                  <option value="quinta">Quinta</option>
                  <option value="sexta">Sexta</option>
                  <option value="sabado">Sábado</option>
              </select>
              <label for="">N° Máximo de Alunos</label>
              <input type="number" class="form-control" name="numAluno{{$contador}}" required>

            </div>
          </div>

        </br>
        @php
          $contador++;
        @endphp
        @endforeach
      <input type="hidden" class="form-control" name="contador" value="{{$contador-1}}">
      <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
  </div>

@endsection
