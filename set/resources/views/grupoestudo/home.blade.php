@extends('portal')

@section('header')
  <script src="{{ asset('js/chart.min.js') }}"></script>
@endsection

@section('content')
  <nav class="nav nav-pills nav-justified">
    <a class="nav-item nav-link active" href="/grupodeestudos/{{$codGrupoEstudos}}/membros">Membros</a>
    <a class="nav-item nav-link" href="/grupodeestudos/{{$codGrupoEstudos}}/atividades">Atividades</a>
    <a class="nav-item nav-link" href="/grupodeestudos/{{$codGrupoEstudos}}/avaliacoes">Avaliação</a>
    <a class="nav-item nav-link" href="/grupodeestudos/{{$codGrupoEstudos}}/ranque">Ranque do Grupo</a>
    <a class="nav-item nav-link" href="/grupodeestudos/{{$codGrupoEstudos}}/agendamento">Agendamentos</a>
  </nav>



  @php
    $agruparPorAno = [];

    foreach ($resultadoExame as $value) {
      $agruparPorAno[$value->Ano][] = $value->Ano;
      $agruparPorAno[$value->Ano][] = $value->NomeEstilo;
      $agruparPorAno[$value->Ano][] = $value->SomaNota;
    }
    function coresDinamicas() {
      $r = (int)(("0.".substr(rand(),0,3))*255);
      $g = (int)(("0.".substr(rand(),0,3))*255);
      $b = (int)(("0.".substr(rand(),0,3))*255);
        return $r . "," . $g . "," . $b;
    }
  @endphp
</br></br>
  <h1 class="h3 mb-3 font-weight-normal text-center">Estilo de Aprendizagem do Grupo de Estudos</h1>

  <canvas id="myChart"></canvas>
  <style media="screen">
    canvas{
      width:100% !important;
      height:auto !important;
    }
  </style>
  <script>
    var ctx = document.getElementById('myChart');

    new Chart(ctx,{
      type:'radar',
      data:{
        labels:["Ativo","Reflexivo","Teórico","Pragmático"],
        datasets:[
          @php
            foreach ($agruparPorAno as $resul){
              $cores = coresDinamicas();
              echo '{
                label:"'.$resul[0].'",
                data:['.$resul[2].','.$resul[8].','.$resul[11].','.$resul[5].'],
                fill:true,
                backgroundColor:"rgba('.$cores.',0.2)",
                borderColor:"rgb('.$cores.')",
                pointBackgroundColor:"rgb('.$cores.')",
                pointBorderColor:"#fff",
                pointHoverBackgroundColor:"#fff",
                pointHoverBorderColor:"rgb('.$cores.')"
              },';
            }
          @endphp
        ]},
        options:{
          elements:{
            line:{
              tension:0,
              borderWidth:3
            }
          },
          scale: {
            ticks: {
                suggestedMin: 5,
                suggestedMax: 20
            }
          }
        }
      });
  </script>

  @php
    $ativo      = null;
    $pragmatico = null;
    $reflexivo  = null;
    $teorico    = null;

    foreach ($agruparPorAno as $resul){
      $total = $resul[2] + $resul[5] + $resul[8] + $resul[11];
      $ativo      = $resul[2]  * 100 / $total;
      $pragmatico = $resul[5]  * 100 / $total;
      $reflexivo  = $resul[8]  * 100 / $total;
      $teorico    = $resul[11] * 100 / $total;
    }
  @endphp

    </br>
    <div class="alert alert-danger" role="alert">
      O estilo de aprendizagem desse grupo de estudos se evidência no gráfico acima. Abaixo segue algumas estratégias que o monitor pode aplicar nesse grupo.
    </div>
    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              <b>Ativo</b>: {{(int)$ativo}}%
            </button>
          </h5>
        </div>
        <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample"> {{--show--}}
          <div class="card-body">
            <div class="list-group">
              <a href="#" class="list-group-item list-group-item-action">Wikis</a>
              <a href="#" class="list-group-item list-group-item-action">Plataformas educativas</a>
              <a href="#" class="list-group-item list-group-item-action">Ilustrações</a>
              <a href="#" class="list-group-item list-group-item-action">Brainstorming</a>
              <a href="#" class="list-group-item list-group-item-action">RPG</a>
              <a href="#" class="list-group-item list-group-item-action">Portfólios</a>
              <a href="#" class="list-group-item list-group-item-action">Debate</a>
              <a href="#" class="list-group-item list-group-item-action">Ler em voz alta</a>
              <a href="#" class="list-group-item list-group-item-action">Busca de informações</a>
              <a href="#" class="list-group-item list-group-item-action">Revisão</a>
              <a href="#" class="list-group-item list-group-item-action">Palavras cruzadas</a>
              <a href="#" class="list-group-item list-group-item-action">Revisão de aprendizagem</a>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingTwo">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              <b>Reflexivo</b>: {{(int)$reflexivo}}%
            </button>
          </h5>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
          <div class="card-body">
            <div class="card-body">
              <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">Organizadores gráficos</a>
                <a href="#" class="list-group-item list-group-item-action">Mapa mental</a>
                <a href="#" class="list-group-item list-group-item-action">Diagrama</a>
                <a href="#" class="list-group-item list-group-item-action">Redes sistemáticas</a>
                <a href="#" class="list-group-item list-group-item-action">Mapas conceituais</a>
                <a href="#" class="list-group-item list-group-item-action">Mapas cognitivos</a>
                <a href="#" class="list-group-item list-group-item-action">Perguntas</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingThree">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              <b>Teórico</b>: {{(int)$teorico}}%
            </button>
          </h5>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
          <div class="card-body">
            <div class="list-group">
              <a href="#" class="list-group-item list-group-item-action">Analogías</a>
              <a href="#" class="list-group-item list-group-item-action">Quadros sinópticos</a>
              <a href="#" class="list-group-item list-group-item-action">Pistas tipográficas</a>
              <a href="#" class="list-group-item list-group-item-action">Resumo</a>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingFour">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              <b>Pragmático</b>: {{(int)$pragmatico}}%
            </button>
          </h5>
        </div>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
          <div class="card-body">
            <div class="list-group">
              <a href="#" class="list-group-item list-group-item-action">Atividades de repetição e prática Enquadramento Método de casos</a>
              <a href="#" class="list-group-item list-group-item-action">Estratégias para orientar a atenção dos alunos</a>
              <a href="#" class="list-group-item list-group-item-action">Objetivos ou intenções Situação problema</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    </br></br>



@endsection
