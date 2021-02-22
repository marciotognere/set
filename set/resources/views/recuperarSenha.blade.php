@extends('home')

@section('content')
    <div class="container">
      <form method="POST" action="enviarsenha">
        @csrf
        </br></br></br>
        <h1 class="h3 mb-3 font-weight-normal text-center">Recuperar Senha</h1>
        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="text" class="form-control" id="email" name="email">
        </div>
        @if(isset($errors) and $errors->has('email'))
					<div class="alert alert-danger">
						<label>{{ $errors->first('email') }}</label>
					</div>
				@endif
        <div class="form-group">
          <br />
          <a type="submit" class="btn btn-primary" href="{{ url('/acesso') }}">Voltar</a>
          <button type="submit" class="btn btn-primary">Recuperar</button>
        </div>
      </form>
    </div>
@endsection
