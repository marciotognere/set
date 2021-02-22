@extends('portal')

@section('content')
  <div class="container">
    <form method="POST" action="adicionar/store">
      @csrf
      <h1 class="h3 mb-3 font-weight-normal text-center">Criar Grupo de Estudos</h1>
      <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome">
      </div>
      @if(isset($errors) and $errors->has('nome'))
        <div class="alert alert-danger">
          <label>{{ $errors->first('nome') }}</label>
        </div>
      @endif
      <div class="form-group">
        <label for="descricao">Descrição</label>
        <input type="text" class="form-control" id="descricao" name="descricao">
      </div>
      @if(isset($errors) and $errors->has('descricao'))
        <div class="alert alert-danger">
          <label>{{ $errors->first('descricao') }}</label>
        </div>
      @endif
      <div class="form-group">
        <label for="vagas">Nº de Vagas</label>
        <input type="text" class="form-control" id="vagas" name="vagas">
      </div>
      @if(isset($errors) and $errors->has('vagas'))
        <div class="alert alert-danger">
          <label>{{ $errors->first('vagas') }}</label>
        </div>
      @endif
      <div class="form-group">
        <label for="disciplina">Curso</label>
        <select class="form-control" id="listaCursos">
          <option value="0">Curso - Todos</option>
          @foreach ($cursoDisciplinas as $cursoDisciplina)
            <option value="{{$cursoDisciplina->codCurso}}">{{$cursoDisciplina->nomeCurso}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="disciplina">Disciplina</label>
        <select class="form-control" id="listaDisciplinas" name="disciplina">
          <option value="0" disabled selected>Disciplina</option>
        </select>
      </div>
      @if(isset($errors) and $errors->has('disciplina'))
        <div class="alert alert-danger">
          <label>{{ $errors->first('disciplina') }}</label>
        </div>
      @endif
      <div class="form-group">
        <br />
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    </form>
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
          url: '/buscarDisciplinas/' + id,
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
          url: '/filtrarMonitores/'+id+'/'+'0',
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
                conteudo += `<span class="badge badge-primary">`+item['horaInicioMonitor']+`</span>&nbsp`;
                conteudo += `<span class="badge badge-danger">`+item['horaTerminoMonitor']+`</span>&nbsp`;
                conteudo += `<span class="badge badge-warning">`+item['diaMonitor']+`</span>&nbsp`;
                conteudo += `<span class="badge badge-success">`+item['disciplinas']['nomeDisciplina']+`</span>&nbsp</br>`;

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
