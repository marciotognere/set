<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Membro;

use App\Http\Requests\MembroRequest;

class MembroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($codGrupoEstudos)
    {
        $membros = \DB::table('membro')
                        ->join('aluno', 'aluno.cpfAluno', '=', 'membro.cpfAluno')
                        ->where('membro.codGrupoEstudo','=',$codGrupoEstudos)
                        ->get();

        return view('grupoestudo.membro.listar')->with(array(
          'membros' => $membros
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($codGrupoEstudos)
    {
      $rowGrupoEstudo = \DB::table('grupoestudo')
                      ->where('codGrupoEstudo', '=', $codGrupoEstudos)
                      ->get();

        // $seguidores = \DB::select(\DB::raw('SELECT a.cpfAluno,
        //                                           a.nomeAluno
        //                                       FROM set.seguidor s
        //                                       INNER JOIN set.aluno a ON a.cpfAluno = s.seguido
        //                                       WHERE s.cpfAluno = "'.session()->get('cpfAluno').'"
        //                                         AND s.seguido NOT IN (SELECT m.cpfAluno
        //                                   							                FROM set.membro m
        //                                   							                WHERE m.codGrupoEstudo = $codGrupoEstudos)'));

        $alunos = \DB::select(\DB::raw('SELECT al.cpfAluno,
                                               al.nomeAluno
                                          FROM aluno al
                                          WHERE al.cpfAluno NOT IN (SELECT cpfAluno
                                        							  FROM membro m
                                        							  WHERE m.codGrupoEstudo = '.$codGrupoEstudos.')'));


        return view('grupoestudo.membro.adicionar')->with(array(
          'rowGrupoEstudo' => $rowGrupoEstudo,
          'seguidores'     => $alunos
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MembroRequest $request)
    {
        $membro = new Membro;
        $membro->cpfAluno       = $request->aluno;
        $membro->codGrupoEstudo = $request->grupoEstudo;
        $membro->inicioMembro   = date("Y-m-d");
        $membro->admMembro      = $request->adm;
        $membro->save();

        return "<script LANGUAGE='JavaScript'>
                  window.alert('Membro adicionado com sucesso!');
                  window.location.href='/grupodeestudos/".$request->grupoEstudo."/membros';
                </script>";

        // return redirect('grupodeestudos'.'/'.$request->grupoEstudo.'/membros');
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
    public function destroy($grupoestudo,$aluno)
    {
        $aluno       = base64_decode($aluno);
        \DB::table('membro')
            ->where('membro.cpfAluno', '=', $aluno)
            ->where('membro.codGrupoEstudo', '=', $grupoestudo)->delete();

        return "<script LANGUAGE='JavaScript'>
                  window.alert('Membro deletado!');
                  window.location.href='/grupodeestudos/".$grupoestudo."/membros';
                </script>";

        //return redirect('/grupodeestudos/'.$grupoestudo.'/membros');
    }
}
