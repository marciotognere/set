@extends('portal')

@section('content')

  <br />
  <br />
  <br />

  <div class="container">
    <form method="POST" action="cadastrar/salvar">
      @csrf
      <h1 class="h3 mb-3 font-weight-normal text-center">Cadastro da Monitoria</h1>

      <div class="accordion" id="accordionExample">
        <?php
          $ultimoRegistro = count($disciplinas)-1;
          for ($x=0; $x <= $disciplinas[$ultimoRegistro]->periodoGrade; $x++) {
            ?>
            <div class="card">
              <div class="card-header" id="heading<?php echo $x; ?>">
                <h5 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $x; ?>" aria-expanded="true" aria-controls="collapse<?php echo $x; ?>">
                    <b><?php if($x == 0) echo "Optativas"; else echo $x."° Periodo"; ?></b>:
                  </button>
                </h5>
              </div>
              <div id="collapse<?php echo $x; ?>" class="collapse <?php if($x == 0)echo 'show'; else echo 'hide'; ?>" aria-labelledby="heading<?php echo $x; ?>" data-parent="#accordionExample">
                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Disciplinas</th>
                        <th scope="col">Carga Horária da Disciplina</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      for ($y=0; $y <= $ultimoRegistro; $y++) {
                        if ($disciplinas[$y]->periodoGrade == $x) {
                          ?>
                           <tr>
                             <th scope="row"><b><?php echo $disciplinas[$y]->codDisciplina; ?></b></th>
                             <td>
                               <div class="form-check">
                                 <input class="form-check-input" type="checkbox" value="<?php echo $disciplinas[$y]->codDisciplina; ?>" name="disciplina<?php echo $disciplinas[$y]->codDisciplina; ?>" id="flexCheckDefault">
                                 <?php echo $disciplinas[$y]->nomeDisciplina; ?>
                               </div>
                             </td>
                             <td>
                               <?php echo $disciplinas[$y]->cargaHorariaDisciplina; ?>
                             </td>
                           </tr>
                           <?php
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <?php
          }
        ?>

        <div class="form-group">
          <br />
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>

        <br />
        <br />
        <br />
        <br />
        <br />
    </form>
  </div>

@endsection
