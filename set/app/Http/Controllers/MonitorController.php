<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Curso;
use App\Models\Grade;
use App\Models\Disciplina;
use App\Models\Monitor;
use App\Models\Monitoria;
use App\Models\Aluno;
use Illuminate\Support\Facades\Crypt;

class MonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      /*$monitores = Aluno::with('monitores.disciplinas.grades.cursos')
                           ->get();*/
      $usuario = session()->get('cpfAluno');

      $monitores = Aluno::with('monitores.disciplinas.grades.cursos')
                          ->whereHas('monitores.disciplinas.grades.cursos', function($query) use($usuario) {
                            $query->where('aluno.cpfAluno', '!=', $usuario);
                          })->get();

      $cursoDisciplinas = Curso::with('grades.disciplinas')
                                ->get();

      //echo "<pre>".json_encode($monitores, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)."</pre>"; die();
      //echo json_encode($monitores);die();

      return view('monitor.listar')->with(array(
        'monitores'        => $monitores,
        'cursoDisciplinas' => $cursoDisciplinas
      ));
    }

    public function buscarDisciplinas($id)
    {
        $query = \DB::table('disciplina')
                              ->join('grade', 'disciplina.codDisciplina', '=', 'grade.codDisciplina')
                              ->join('curso', 'grade.codCurso', '=', 'curso.codCurso')
                              ->where('curso.codCurso', $id)->get();

        echo json_encode($query);
    }

    public function filtrarMonitores($codCurso,$codDisciplina)
    {
      if ($codDisciplina == 0) {
        //TODOS POR CURSOS
        $monitores = Aluno::with('monitores.disciplinas.grades.cursos')
                            ->whereHas('monitores.disciplinas.grades.cursos', function($query) use($codCurso){
                              $query->where('curso.codCurso', '=', $codCurso);
                            })->get();
      }
      if ($codDisciplina != 0 || $codCurso == 9999999){
        //TODOS POR DISCIPLINAS
        $monitores = Aluno::with('monitores.disciplinas.grades.cursos')
                            ->whereHas('monitores.disciplinas.grades.cursos', function($query) use($codDisciplina){
                              $query->where('monitor.codDisciplina', '=', $codDisciplina);
                            })->get();
      }
      if ($codCurso == 0){
        // $monitores = Aluno::with('monitores.disciplinas.grades.cursos')
        //                     ->get();
        $usuario = session()->get('cpfAluno');

        $monitores = Aluno::with('monitores.disciplinas.grades.cursos')
                            ->whereHas('monitores.disciplinas.grades.cursos', function($query) use($usuario) {
                              $query->where('aluno.cpfAluno', '!=', $usuario);
                            })->get();
      }

        //echo "<pre>".json_encode($monitores, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)."</pre>"; die();
        echo json_encode($monitores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function agendar($aluno)
     {
       $disciplinas = \DB::select(\DB::raw('SELECT di.codDisciplina,
                                                   di.nomeDisciplina
                                              FROM monitor mo,
                                                   disciplina di
                                              WHERE mo.codDisciplina = di.codDisciplina
                                                AND mo.cpfAluno = "'.$aluno.'"'));

       $aluno = \DB::select(\DB::raw('SELECT a.cpfAluno,
                                             a.nomeAluno
                                        FROM aluno a
                                        WHERE a.cpfAluno = "'.$aluno.'"'));

        $aluno[0]->cpfAluno = Crypt::encrypt($aluno[0]->cpfAluno);
        // echo dd($aluno);die();
        // echo "<pre>".json_encode($aluno, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)."</pre>"; die();
        //
        // echo "</br>";
        //
        // echo "<pre>".json_encode($aluno, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)."</pre>"; die();

       return view('monitor.agendar')->with(array(
         'aluno'       => $aluno,
         'disciplinas' => $disciplinas
       ));
     }

    public function agendarSalvar(Request $request){
      $monitoria = new Monitoria;

      $monitoria->codDisciplina = $request->input('disciplina');
      $monitoria->cpfMonitor    = Crypt::decrypt($request->input('aluno'));
      $monitoria->cpfAluno      = session()->get('cpfAluno');
      $monitoria->save();

      return "<script LANGUAGE='JavaScript'>
                window.alert('Agendamento da monitoria realizada com sucesso!');
                window.location.href='/portal';
              </script>";
    }

    public function create()
    {
        $disciplinas = \DB::select(\DB::raw('SELECT di.codDisciplina,
                                                    di.nomeDisciplina,
                                                    di.cargaHorariaDisciplina,
                                                    gr.periodoGrade
                                               FROM matricula ma,
                                                    curso cu,
                                                    grade gr,
                                                    disciplina di
                                               WHERE ma.codCurso = cu.codCurso
                                                 AND cu.codCurso = gr.codCurso
                                                 AND gr.codDisciplina = di.codDisciplina
                                                 AND ma.cpfAluno = "'.session()->get('cpfAluno').'"'));

        //print("<pre>".print_r($disciplinas,true)."</pre>");

        return view('monitor.adicionar')->with('disciplinas',$disciplinas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (count($request->input()) == 1) {
          return "<script LANGUAGE='JavaScript'>
                    window.alert('Cadastre ao menos uma disciplina para ser monitor!');
                    window.location.href='/portal/cadastrar';
                  </script>";
        }else {
          foreach($request->input() as $index => $key) {
            if($index === '_token') continue;

            $monitor = new Monitor;
            $monitor->cpfAluno      = session()->get('cpfAluno');
            $monitor->codDisciplina = $request->input($index);

            $verificaMonitor = \DB::select(\DB::raw('SELECT m.cpfAluno,
                                                            m.codDisciplina
                                                       FROM monitor m
                                                       WHERE m.codDisciplina = '.$request->input($index).'
                                                         AND m.cpfAluno      = "'.session()->get('cpfAluno').'"'));

            if (empty($verificaMonitor)) {
              $monitor->save();
            }
          }
        }

        return "<script LANGUAGE='JavaScript'>
                  window.alert('Cadastro de monitor realizado com sucesso!');
                  window.location.href='/portal/horario';
                </script>";
    }

    public function horario(){

      $disciplinas = \DB::select(\DB::raw('SELECT di.codDisciplina,
                                                  di.nomeDisciplina
                                             FROM monitor mo,
                                                  disciplina di
                                             WHERE mo.codDisciplina = di.codDisciplina
                                               AND mo.cpfAluno = "'.session()->get('cpfAluno').'"'));

      return view('monitor.disponibilidadehorario')->with('disciplinas',$disciplinas);
    }

    public function horarioSalvar(Request $request)
    {

      for ($i=1; $i <= $request->input('contador'); $i++) {

        Monitor::where('cpfAluno', session()->get('cpfAluno'))
                 ->where('codDisciplina', $request->input('codDisciplina'.$i))
                 ->update(['horaInicioMonitor'  => $request->input('horaInicio'.$i),
                           'horaTerminoMonitor' => $request->input('horaTermino'.$i),
                           'diaMonitor'         => $request->input('dia'.$i),
                           'numAlunoMonitor'    => $request->input('numAluno'.$i)]);
      }

      return "<script LANGUAGE='JavaScript'>
                window.alert('Cadastro de dia e horário da monitoria realizado com sucesso!');
                window.location.href='/portal';
              </script>";

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function agendamento()
    {
      $agendamentos = \DB::select(\DB::raw('SELECT al.cpfAluno,
                                                   al.nomeAluno,
                                                   mo.horaInicioMonitor,
                                                   mo.horaTerminoMonitor,
                                                   mo.diaMonitor,
                                                   di.nomeDisciplina,
                                                   di.codDisciplina
                                              FROM aluno al,
                                                   monitor mo,
                                                   disciplina di,
                                                   monitoria ma
                                              WHERE mo.cpfAluno = al.cpfAluno
                                                AND ma.cpfMonitor = mo.cpfAluno
                                                AND di.codDisciplina = mo.codDisciplina
                                                AND ma.codDisciplina = di.codDisciplina
                                                AND ma.cpfAluno = "'.session()->get('cpfAluno').'"'));
        //$agendamentos[0]->cpfAluno = Crypt::encrypt($agendamentos[0]->cpfAluno);

        foreach ($agendamentos as $agendamento) {
          $agendamento->cpfAluno = Crypt::encrypt($agendamento->cpfAluno);
        }

        //echo "<pre>".json_encode($agendamentos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)."</pre>"; die();
        return view('monitor.agendamento')->with('agendamentos',$agendamentos);
    }

    public function agendamentoDeletar($codDisciplina,$cpfMonitor)
    {
        $monitor = Crypt::decrypt($cpfMonitor);

        Monitoria::where('codDisciplina', '=', $codDisciplina)
                   ->where('cpfMonitor', '=', $monitor)
                   ->where('cpfAluno', '=', session()->get('cpfAluno'))
                   ->delete();

        return "<script LANGUAGE='JavaScript'>
                  window.alert('Agendamento desfeito!');
                  window.location.href='/portal/agendamento';
                </script>";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
