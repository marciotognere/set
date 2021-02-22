<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Disciplina;
use App\Models\Grupoestudo;
use App\Models\Membro;
use App\Models\Curso;

use App\Http\Requests\GrupoEstudoRequest;

class GrupoEstudoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $cursoDisciplinas = Curso::with('grades.disciplinas')
                                ->get();

      $grupoEstudos = \DB::select(\DB::raw('SELECT g.codGrupoEstudo  AS codGrupoEstudo,
                                                   g.nomeGrupoEstudo AS nomeGrupoEstudo,
                                                   i.nomeInstituicao AS instituicao,
                                                   d.nomeDisciplina  AS disciplina,
                                                   c.nomeCurso       AS nomeCurso,
                                                   (SELECT COUNT(*)
                                                      FROM set.membro mm
                                                      WHERE mm.codGrupoEstudo = m.codGrupoEstudo) AS numeroMembros,
                                            	   g.numVagasGrupoEstudo AS vagasGrupoEstudo
                                              FROM set.grupoestudo g,
                                                   set.disciplina d,
                                                   set.membro m,
                                                   set.aluno a,
                                                   set.grade gr,
                                                   set.curso c,
                                                   set.instituicao i
                                              WHERE g.codGrupoEstudo = m.codGrupoEstudo
                                                AND m.cpfAluno = a.cpfAluno
                                                AND g.codDisciplina = d.codDisciplina
                                                AND gr.codDisciplina = g.codDisciplina
                                                AND gr.codCurso = c.codCurso
                                                AND c.codInstituicao = i.codInstituicao
                                                AND a.cpfAluno = "'.session()->get('cpfAluno').'"'));

      return view('grupoestudo.listar')->with(array(
        'grupoEstudos'     => $grupoEstudos,
        'cursoDisciplinas' => $cursoDisciplinas
      ));
    }

    public function estiloGrupo($codGrupoEstudos)
    {
      $resultadoExame = \DB::select(\DB::raw('SELECT ti.nomeTipoEstilo AS NomeEstilo,
                                                     SUM(notaEstilo)   AS SomaNota,
                                                     EXTRACT(YEAR FROM es.dataEstilo) AS Ano
                                                FROM set.estilo es,
                                              	   set.exame ex,
                                              	   set.tipoestilo ti,
                                                   set.aluno al,
                                                   set.membro me,
                                                   set.grupoestudo gr
                                                WHERE es.codExame = ex.codExame
                                              	AND ex.codTipoEstilo = ti.codTipoEstilo
                                                AND al.cpfAluno = es.cpfAluno
                                                AND al.cpfAluno = me.cpfAluno
                                                AND me.codGrupoEstudo = gr.codGrupoEstudo
                                                AND gr.codGrupoEstudo = '.$codGrupoEstudos.'
                                                GROUP BY ti.nomeTipoEstilo, EXTRACT(YEAR FROM es.dataEstilo)
                                                ORDER BY Ano DESC,NomeEstilo ASC;'));

      return view('grupoestudo.home')->with(array(
        'codGrupoEstudos' => $codGrupoEstudos,
        'resultadoExame'  => $resultadoExame
      ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $disciplinas = Disciplina::orderBy('nomeDisciplina','asc')->get();

      $cursoDisciplinas = Curso::with('grades.disciplinas')
                                ->get();

      return view('grupoestudo.adicionar')->with(array(
        'disciplinas'      => $disciplinas,
        'cursoDisciplinas' => $cursoDisciplinas
      ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GrupoEstudoRequest $request)
    {
        $grupos = \DB::table('grupoestudo')
                    ->orderBy('codGrupoEstudo', 'desc')
                    ->first();

        if (empty($grupos)) {
          $novoCodGrupoEstudo = 1;
        }else{
          $novoCodGrupoEstudo = $grupos->codGrupoEstudo;
          $novoCodGrupoEstudo++;
        }

        $grupoEstudo = new Grupoestudo;
        $grupoEstudo->codGrupoEstudo      = $novoCodGrupoEstudo;
        $grupoEstudo->nomeGrupoEstudo     = $request->input('nome');
        $grupoEstudo->descrGrupoEstudo    = $request->input('descricao');
        $grupoEstudo->numVagasGrupoEstudo = $request->input('vagas');
        $grupoEstudo->codDisciplina       = $request->input('disciplina');
        $grupoEstudo->save();

        $membro = new Membro;
        $membro->cpfAluno       = session()->get('cpfAluno');
        $membro->codGrupoEstudo = $novoCodGrupoEstudo;
        $membro->inicioMembro   = date("Y-m-d");
        $membro->admMembro      = '1';
        $membro->save();

        return "<script LANGUAGE='JavaScript'>
                  window.alert('Grupo de estudos criado com sucesso!');
                  window.location.href='/grupodeestudos';
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
