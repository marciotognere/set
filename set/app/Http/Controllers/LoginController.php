<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use App\Models\Aluno;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RecuperarSenhaRequest;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    public function recuperarSenha()
    {
        return view('recuperarSenha');
    }

    public function enviarSenha(RecuperarSenhaRequest $request)
    {
      return "<script LANGUAGE='JavaScript'>
                window.alert('Senha enviada por e-mail!');
                window.location.href='/acesso';
              </script>";
    }

    public function verificarUsuario(LoginRequest $resquest){

      //echo "<pre>".json_encode(Session::all(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)."</pre>"; die();

      //verifica se existe algum dado na tabela
      if (Aluno::get()->isEmpty()) {
        return "<script LANGUAGE='JavaScript'>
                  window.alert('Usuário não encontrado!');
                  window.location.href='/acesso';
                </script>";
      }

      $aluno = Aluno::where('cpfAluno',$resquest->cpf)->first();

      if (empty($aluno)) {
        return "<script LANGUAGE='JavaScript'>
                  window.alert('Usuário não encontrado!');
                  window.location.href='/acesso';
                </script>";
      }else {
        //"aluno encontrado
        if ($aluno->senhaAluno === $resquest->input('senha')) {
          Session::put('cpfAluno',$aluno->cpfAluno);
          return redirect('estilo');
        }else {
          //senha errada
          return redirect('acesso');
        }
      }
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
    public function store(Request $request)
    {
        //
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
