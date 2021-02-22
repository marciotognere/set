<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Set</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Js -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('header')
  </head>
  <body>

    </br>
    <nav class="nav nav-pills nav-justified offset-md-3 col-md-6">
      <a class="nav-item nav-link active" href="{{ url('/portal') }}">Início</a>
      <a class="nav-item nav-link" href="{{ url('/grupodeestudos') }}">Grupo de Estudos</a>
      <a class="nav-item nav-link" href="{{ url('/atividades') }}">Minhas Atividades</a>
      <a class="nav-item nav-link" href="{{ url('/avaliacoes') }}">Minhas Avaliações</a>
      <a class="nav-item nav-link" href="{{ url('/acesso') }}">Sair</a>
    </nav>
    </br>

    <div class="container">
      @yield('content')
    </div>

  </body>

  <footer>
    <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
    @yield('footer')
  </footer>

</html>
