@extends('portal')

@section('content')
    <div class="container">
      <form method="POST" action="adicionar/store">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal text-center">Cadastro de Agendamento</h1>
        <div class="form-group">
          <label for="local">Local do Agendamento</label>
          <select class="form-control" id="local" name="local">
            <option value="">-- Selecione --</option>
            @foreach($locais as $local)
						<option value="{{ $local->codLocal }}"> {{ $local->nomeLocal }} </option>
            @endforeach
          </select>
        </div>
        @if(isset($errors) and $errors->has('local'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('local') }}</label>
					</div>
				@endif
        <div class="form-group">
          <label for="grupoEstudo">Grupo de Estudos</label>
          <select class="form-control" id="grupoEstudo" name="grupoEstudo">
            @foreach($grupos as $grupo)
						<option value="{{ $grupo->codGrupoEstudo }}"> {{ $grupo->nomeGrupoEstudo }} </option>
            @endforeach
          </select>
        </div>
        @if(isset($errors) and $errors->has('grupoEstudo'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('grupoEstudo') }}</label>
					</div>
				@endif
        <div class="form-group">
          <label for="dataAgendamento">Data do Agendamento</label>
          <input type="date" class="form-control" id="dataAgendamento" name="dataAgendamento">
        </div>
        @if(isset($errors) and $errors->has('dataAgendamento'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('dataAgendamento') }}</label>
					</div>
				@endif
        <div class="form-group">
          <label for="horaAgendamento">Horário do Agendamento</label>
          <input type="time" class="form-control" id="horaAgendamento" name="horaAgendamento">
        </div>
        @if(isset($errors) and $errors->has('horaAgendamento'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('horaAgendamento') }}</label>
					</div>
				@endif
        <div class="form-group">
          <label for="nomeAgendamento">Nome do Agendamento</label>
          <input type="text" class="form-control" id="nomeAgendamento" name="nomeAgendamento">
        </div>
        @if(isset($errors) and $errors->has('nomeAgendamento'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('nomeAgendamento') }}</label>
					</div>
				@endif
        <div class="form-group">
          <label for="descrAgendamento">Descrição do Agendamento</label>
          <input type="text" class="form-control" id="descrAgendamento" name="descrAgendamento">
        </div>
        @if(isset($errors) and $errors->has('descrAgendamento'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('descrAgendamento') }}</label>
					</div>
				@endif
        <div class="form-group">
          <label for="descrAgendamento">Monitor</label>
          <select class="form-control" id="" name="cpfAluno">
            <option value="0" selected>Agendamento Presença de Monitor</option>
            @foreach ($monitores as $monitor)
                <option value="{{$monitor->cpfAluno}}">{{$monitor->nomeAluno}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <br />
          <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
      </form>
    </div>
@endsection
