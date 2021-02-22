@extends('portal')

@section('content')
  <div class="container">
    </br></br>
    <a href="{{ url('/grupodeestudos/adicionar') }}" class="btn btn-primary">Adicionar</a>
    </br></br>
    <h1>Grupo de Estudos</h1>
    </br>
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Nome do Grupo</th>
          <th>Curso</th>
          <th>Disciplina</th>
          <th>Nº de Membros</th>
          <th>Entrar</th>
        </tr>
      </thead>
      <tbody>
        @php
          $contador = 1;
        @endphp
        @foreach ($grupoEstudos as $grupoEstudo)
          <tr>
            <th>{{$contador}}</th>
            <td>{{$grupoEstudo->nomeGrupoEstudo}}</td>
            <td>{{$grupoEstudo->nomeCurso}}</td>
            <td>{{$grupoEstudo->disciplina}}</td>
            <td>{{$grupoEstudo->numeroMembros.' / '.$grupoEstudo->vagasGrupoEstudo}}</td>
            <td><a href="grupodeestudos/{{$grupoEstudo->codGrupoEstudo}}" class="btn btn-primary">Entrar</a> </td>
          </tr>
          @php
            $contador++;
          @endphp
        @endforeach
      </tbody>
    </table>


  </div>

@endsection

@section('footer')
  <script type="text/javascript">
    $(document).ready(function () {
      $('#listaCursos').on('change', function () {
        let id = $(this).val();
        $('#listaDisciplinas').empty();
        $('#listaDisciplinas').append('<option value="0" disabled selected>Processando...</option>');
        $.ajax({
          type: 'GET',
          url: 'buscarDisciplinas/' + id,
          success: function (response) {
            var response = JSON.parse(response);
            //console.log(response);
            $('#listaDisciplinas').empty();
            $('#listaDisciplinas').append('<option value="0" disabled selected>Disciplina</option>');
            response.forEach(element => {
              $('#listaDisciplinas').append(`<option value="${element['codDisciplina']}">${element['nomeDisciplina']}</option>`);
            });
          }
        });

        $.ajax({
          type: 'GET',
          url: 'filtrarMonitores/'+id+'/'+'0',
          success: function (response) {
            var response = JSON.parse(response);
            //console.log(response);
            var contador = 1;
            var salvarCurso;
            var conteudo;
            $('#listaMonitores').empty();
            //$('#listaDisciplinas').append('<option value="0" disabled selected>Disciplina</option>');
            response.forEach(element => {

              conteudo = `<tr>
                            <th>`+contador+`</th>
                            <td>${element['nomeAluno']}</br>`;

              element['monitores'].forEach((item, i) => {
                conteudo += `<span class="badge badge-success">`+item['disciplinas']['nomeDisciplina']+`</span>&nbsp`;

                item['disciplinas']['grades'].forEach((item1, i) => {
                  salvarCurso = item1['cursos']['nomeCurso'];
                });
              });

              conteudo += `</td>`;
              conteudo += `<td>`+salvarCurso+`</td>`;
              conteudo += `<td><a type="submit" class="btn btn-primary" href="/portal/agendar/${element['cpfAluno']}">Agendar</a></br></td></tr>`;

              $('#listaMonitores').append(conteudo);
              contador++;
            });
          }
        });

      });

      });

  </script>
@endsection
