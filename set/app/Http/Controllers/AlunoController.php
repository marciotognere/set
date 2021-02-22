<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Aluno;
use App\Models\Cidade;
use App\Models\Estado;

use App\Http\Requests\NovaContaRequest;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $cidades = Cidade::orderBy('nomeCidade','asc')->get();
      $estados = Estado::orderBy('ufEstado','asc')->get();

      return view('cadastroAluno')->with(array(
        'cidades' => $cidades,
        'estados' => $estados
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
    public function store(NovaContaRequest $request)
    {
      $aluno = new Aluno;
      $aluno->cpfAluno      = $request->input('cpf');
      $aluno->nomeAluno     = $request->input('nome');
      $aluno->emailAluno    = $request->input('email');
      $aluno->celularAluno  = $request->input('celular');
      $aluno->senhaAluno    = $request->input('senha');
      $aluno->dataNascAluno = $request->input('dataNascimento');
      $aluno->cepAluno      = $request->input('cep');
      $aluno->codCidade     = $request->input('cidade');
      $aluno->save();

      return "<script LANGUAGE='JavaScript'>
                window.alert('Usuário cadastrado com sucesso!');
                window.location.href='/acesso';
              </script>";
      //return redirect('acesso');
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
