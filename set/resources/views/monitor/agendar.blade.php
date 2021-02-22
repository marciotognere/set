@extends('portal')

@section('content')
  </br>
  <h1 class="h3 mb-3 font-weight-normal text-center">Agendamento de Monitoria</h1>
  <div class="container">
    <form method="POST" action="salvar">
      @csrf
      <select class="form-control" id="listaCursos" name="aluno">
        <option value="{{$aluno[0]->cpfAluno}}">{{$aluno[0]->nomeAluno}}</option>
      </select>
      </br>
      <select class="form-control" id="listaCursos" name="disciplina">
        @foreach ($disciplinas as $disciplina)
          <option value="{{$disciplina->codDisciplina}}">{{$disciplina->nomeDisciplina}}</option>
        @endforeach
      </select>
      </br>
      <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
  </div>

@endsection
