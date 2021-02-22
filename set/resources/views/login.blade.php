@extends('home')

@section('content')
    <div class="container">
      <form method="POST" action="acesso/verificar">
        @csrf
        </br></br></br>
        <h1 class="h3 mb-3 font-weight-normal text-center">Acesso a Plataforma</h1>
        <div class="form-group">
          <label for="cpf">Cpf</label>
          <input type="text" class="form-control" id="cpf" aria-describedby="cpf" name="cpf" value="" maxlength="11">
          <!--<small id="cpf" class="form-text text-muted">Preencha seus dados corretamente.</small>-->
        </div>
        @if(isset($errors) and $errors->has('cpf'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('cpf') }}</label>
					</div>
				@endif
        <div class="form-group">
          <label for="senha">Senha</label>
          <input type="password" class="form-control" id="senha" name="senha" value="">
        </div>
        @if(isset($errors) and $errors->has('senha'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('senha') }}</label>
					</div>
				@endif
        <a href="{{ url('acesso/novaconta') }}">Criar Nova Conta</a>
        <a href="{{ url('acesso/recuperarsenha') }}">Esqueci minha senha</a>
        <!-- <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Lembre-me</label>
        </div> -->
        <div class="form-group">
          <br />
          <button type="submit" class="btn btn-primary">Entrar</button>
        </div>
        <p class="mt-5 mb-3 text-muted text-center">© 2020</p>
      </form>
    </div>
@endsection
