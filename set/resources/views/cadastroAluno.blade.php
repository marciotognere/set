@extends('home')

@section('content')
    <div class="container">
      <form method="POST" action="novaconta/store">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal text-center">Cadastro do Aluno</h1>
        <div class="form-group">
          <label for="cpf">Cpf</label>
          <input type="text" class="form-control" id="cpf" name="cpf" maxlength="11">
        </div>
        @if(isset($errors) and $errors->has('cpf'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('cpf') }}</label>
					</div>
				@endif
        <div class="form-group">
          <label for="nome">Nome</label>
          <input type="text" class="form-control" id="nome" name="nome">
          <!--<small id="cpfHelp" class="form-text text-muted">Preencha seus dados corretamente.</small>-->
        </div>
        @if(isset($errors) and $errors->has('nome'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('nome') }}</label>
					</div>
				@endif
        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="email" class="form-control" id="email" name="email">
        </div>
        @if(isset($errors) and $errors->has('email'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('email') }}</label>
					</div>
				@endif
        <div class="form-group">
          <label for="celular">Celular</label>
          <input type="text" class="form-control" id="celular" name="celular">
        </div>
        @if(isset($errors) and $errors->has('celular'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('celular') }}</label>
					</div>
				@endif
        <div class="form-group">
          <label for="senha">Senha</label>
          <input type="password" class="form-control" id="senha" name="senha">
        </div>
        @if(isset($errors) and $errors->has('senha'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('senha') }}</label>
					</div>
				@endif
        <div class="form-group">
          <label for="dataNascimento">Data de Nascimento</label>
          <input type="text" class="form-control" id="dataNascimento" name="dataNascimento">
        </div>
        @if(isset($errors) and $errors->has('dataNascimento'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('dataNascimento') }}</label>
					</div>
				@endif
        <div class="form-group">
          <label for="cep">Cep</label>
          <input type="text" class="form-control" id="cep" name="cep">
        </div>
        @if(isset($errors) and $errors->has('cep'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('cep') }}</label>
					</div>
				@endif
        <div class="form-group">
          <label for="estado">Estado</label>
          <select class="form-control" id="estado" name="estado">
            <option value="">-- Selecione --</option>
            @foreach($estados as $estado)
						<option value="{{ $estado->ufEstado }}"> {{ $estado->ufEstado }} </option>
            @endforeach
          </select>
        </div>
        @if(isset($errors) and $errors->has('estado'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('estado') }}</label>
					</div>
				@endif
        <div class="form-group">
          <label for="cidade">Cidade</label>
          <select class="form-control" id="cidade" name="cidade">
            <option value="">-- Selecione --</option>
            @foreach($cidades as $cidade)
						<option value="{{ $cidade->codCidade }}"> {{ $cidade->nomeCidade }} </option>
            @endforeach
          </select>
        </div>
        @if(isset($errors) and $errors->has('cidade'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('cidade') }}</label>
					</div>
				@endif
        <div class="form-group">
          <br />
          <a type="submit" class="btn btn-primary" href="{{ url('/acesso') }}">Voltar</a>
          <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
      </form>
    </div>
@endsection
