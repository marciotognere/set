@extends('portal')

@section('content')
  <div class="container">
    <form method="POST" action="adicionar/store">
      @csrf
      <h1 class="h3 mb-3 font-weight-normal text-center">Adicionar Membros</h1>
      <div class="form-group">
        <label for="grupoEstudo">Grupo de Estudo</label>
        <select class="form-control" id="grupoEstudo" name="grupoEstudo">
          <option value="{{$rowGrupoEstudo[0]->codGrupoEstudo}}">{{$rowGrupoEstudo[0]->nomeGrupoEstudo}}</option>
        </select>
      </div>
      @if(isset($errors) and $errors->has('grupoEstudo'))
        <div class="alert alert-danger">
          <label>{{ $errors->first('grupoEstudo') }}</label>
        </div>
      @endif
      <div class="form-group">
        <label for="aluno">Aluno</label>
        <select class="form-control" id="aluno" name="aluno">
          <option value="">-- Selecione --</option>
          @foreach ($seguidores as $seguidor)
            <option value="{{$seguidor->cpfAluno}}">{{$seguidor->nomeAluno}}</option>
          @endforeach
        </select>
      </div>
      @if(isset($errors) and $errors->has('aluno'))
        <div class="alert alert-danger">
          <label>{{ $errors->first('aluno') }}</label>
        </div>
      @endif
      <div class="form-group">
        <label for="adm">Administrador</label>
        <select class="form-control" id="adm" name="adm">
          <option value="">-- Selecione --</option>
          <option value="1">Sim</option>
          <option value="0">Não</option>
        </select>
      </div>
      @if(isset($errors) and $errors->has('adm'))
        <div class="alert alert-danger">
          <label>{{ $errors->first('adm') }}</label>
        </div>
      @endif
      <div class="form-group">
        <br />
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    </form>
  </div>
@endsection
