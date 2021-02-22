@extends('portal')

@section('content')



  <div class="container">
  <div class="row">
    <div class="col-sm-2">
      <a type="submit" class="btn btn-primary" href="{{ url('/portal/cadastrar') }}">Seja Monitor</a></br>
    </div>
    <div class="col-sm-4">
      <a type="submit" class="btn btn-primary" href="{{ url('/portal/agendamento') }}">Meus Agendamentos</a></br>
    </div>
  </div>
</div>

  </br>
  <select class="form-control" id="listaCursos">
    <option value="0">Curso - Todos</option>
    @foreach ($cursoDisciplinas as $cursoDisciplina)
      <option value="{{$cursoDisciplina->codCurso}}">{{$cursoDisciplina->nomeCurso}}</option>
    @endforeach
  </select>
  </br>
  <select class="form-control" id="listaDisciplinas">
    <option value="0" disabled selected>Disciplina</option>
  </select>
  </br>

  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Monitor</th>
      <th scope="col">Curso</th>
      <th scope="col">Agendamento</th>
    </tr>
  </thead>
  <tbody id="listaMonitores">
    @if (isset($monitores))
      @php
        $salvaCurso = null;
        $contador = 1;
      @endphp

      @foreach ($monitores as $monitor)
        <tr>
          <th scope="row">{{$contador}}</th>
          <td>{{ucwords($monitor->nomeAluno)}}</br>
            @foreach ($monitor->monitores as $disciplina)
              <span class="badge badge-primary">{{$disciplina->horaInicioMonitor}}</span>
              <span class="badge badge-danger">{{$disciplina->horaTerminoMonitor}}</span>
              <span class="badge badge-warning">{{$disciplina->diaMonitor}}</span>
              <span class="badge badge-success">{{$disciplina->disciplinas->nomeDisciplina}}</span>
              @foreach ($disciplina->disciplinas->grades as $curso)
                @php
                  $salvaCurso = $curso->cursos->nomeCurso;
                @endphp
              @endforeach
            </br>
            @endforeach
          </td>
          <td>
            {{$salvaCurso}}
          </td>
          <th><a type="submit" class="btn btn-primary" onclick="hashMd5('tognere')" href="/portal/agendar/<?php echo $monitor->cpfAluno; ?>">Agendar</a></br></th>
        </tr>

        @php
          $contador++;
        @endphp
      @endforeach
    @endif

  </tbody>
</table>

</br></br></br></br></br></br></br>




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
      /////////////////////////////////////////////////////////////////////////////////
      $('#listaDisciplinas').on('change', function () {

        let id = $(this).val();

        $.ajax({
          type: 'GET',
          url: 'filtrarMonitores/9999999/'+id,
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
////////////////
    });

  </script>
@endsection
