@extends('portal')

@section('content')
  <div class="container">
    <a href="#" class="btn btn-primary">Adicionar</a>
    <h1>Minhas Atividades</h1>
    <div class="row">
      <div class="col-3">
        <label for=""><b>Nome da Atividade</b></label>
      </div>
      <div class="col-3">
        <label for=""><b>Nome do Grupo</b></label>
      </div>
      <div class="col-3">
        <label for=""><b>Nome do Aluno</b></label>
      </div>
      <div class="col-3">
        <label for=""><b>Nº de Questões</b></label>
      </div>
    </div>
    <div class="row">
      <div class="col-3">
        <label for="">Lista de Derivadas</label>
      </div>
      <div class="col-3">
        <label for="">Desesperados por números</label>
      </div>
      <div class="col-3">
        <label for="">Nome do Aluno</label>
      </div>
      <div class="col-3">
        <label for="">1/12</label>
      </div>
    </div>
    <div class="row">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
@endsection
