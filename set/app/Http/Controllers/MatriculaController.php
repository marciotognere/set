<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Matricula;
use App\Models\Instituicao;
use App\Models\Curso;
use App\Models\Situacao;

use App\Http\Requests\MatriculaRequest;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //verifica se existe um registro de matricula na base de dados
      if (!Matricula::where('cpfAluno',session()->get('cpfAluno'))->get()->isEmpty()) {
        return redirect('portal');
      }

      $instituicoes = Instituicao::orderBy('nomeInstituicao','asc')->get();
      $cursos       = Curso::orderBy('nomeCurso','asc')->get();
      $situacoes    = Situacao::orderBy('nomeSituacao','asc')->get();

      return view('cadastroMatricula')->with(array(
        'instituicoes' => $instituicoes,
        'cursos'       => $cursos,
        'situacoes'    => $situacoes
      ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MatriculaRequest $request)
    {
      $matricula = new Matricula;
      $matricula->codCurso        = $request->input('curso');
      $matricula->cpfAluno        = session()->get('cpfAluno');//CPF do aluno logado
      $matricula->dataInicioCurso = $request->input('dataInicioCurso');
      $matricula->dataFimCurso    = $request->input('dataFimCurso');
      $matricula->codSituacao     = $request->input('situacaoMatricula');
      $matricula->save();

      //return redirect('matricula');
      return "<script LANGUAGE='JavaScript'>
                window.alert('Cadastro de matricula efetuada com sucesso!');
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
