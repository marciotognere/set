@extends('home')

@section('content')
    <div class="container">
      <form method="POST" action="matricula/store">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal text-center">Cadastro de Matricula</h1>
        <div class="form-group">
          <label for="instituicao">Instituição</label>
          <select class="form-control" id="instituicao" name="instituicao">
            <option value="">-- Selecione --</option>
            @foreach($instituicoes as $instituicao)
						<option value="{{ $instituicao->codInstituicao }}"> {{ $instituicao->nomeInstituicao }} </option>
            @endforeach
          </select>
        </div>
        @if(isset($errors) and $errors->has('instituicao'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('instituicao') }}</label>
					</div>
				@endif
        <div class="form-group">
          <label for="curso">Curso</label>
          <select class="form-control" id="curso" name="curso">
            <option value="">-- Selecione --</option>
            @foreach($cursos as $curso)
						<option value="{{ $curso->codCurso }}"> {{ $curso->nomeCurso }} </option>
            @endforeach
          </select>
        </div>
        @if(isset($errors) and $errors->has('curso'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('curso') }}</label>
					</div>
				@endif
        <div class="form-group">
          <label for="dataInicioCurso">Data de Início do Curso</label>
          <input type="date" class="form-control" id="dataInicioCurso" name="dataInicioCurso">
        </div>
        @if(isset($errors) and $errors->has('dataInicioCurso'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('dataInicioCurso') }}</label>
					</div>
				@endif
        <div class="form-group">
          <label for="dataFimCurso">Data de Fim do Curso</label>
          <input type="date" class="form-control" id="dataFimCurso" name="dataFimCurso">
        </div>
        @if(isset($errors) and $errors->has('dataFimCurso'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('dataFimCurso') }}</label>
					</div>
				@endif
        <div class="form-group">
          <label for="situacaoMatricula">Situação da Matricula</label>
          <select class="form-control" id="situacaoMatricula" name="situacaoMatricula">
            <option value="">-- Selecione --</option>
            @foreach($situacoes as $situacao)
						<option value="{{ $situacao->codSituacao }}"> {{ $situacao->nomeSituacao }} </option>
            @endforeach
          </select>
        </div>
        @if(isset($errors) and $errors->has('situacaoMatricula'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('situacaoMatricula') }}</label>
					</div>
				@endif
        <div class="form-group">
          <br />
          <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
      </form>
    </div>
@endsection
