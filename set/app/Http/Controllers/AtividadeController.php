<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Atividade;
use App\Models\Questao;
use App\Models\Alternativa;
use App\Models\Ranque;

//use App\Http\Requests\AtividadeRequest;

class AtividadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($codGrupoEstudos)
    {
      $atividades = \DB::table('atividade')
                         ->join('aluno','atividade.cpfAluno','=','aluno.cpfAluno')
                          ->where('atividade.codGrupoEstudo','=',$codGrupoEstudos)
                          ->get();

      return view('grupoestudo.atividade.listar')->with(array(
        'atividades' => $atividades,
        'codGrupoEstudos' => $codGrupoEstudos
      ));
    }

    public function minhasAtividades()
    {
      $atividades = \DB::table('atividade')
                          ->join('aluno','atividade.cpfAluno','=','aluno.cpfAluno')
                          ->where('atividade.cpfAluno','=',session()->get('cpfAluno'))
                          ->get();
      //echo "<pre>".json_encode($atividades, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)."</pre>"; die();
      return view('grupoestudo.atividade.listar')->with(array(
        'atividades' => $atividades
      ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($codGrupoEstudos)
    {
        $grupos = \DB::table('grupoestudo')
                        ->where('codGrupoEstudo', '=', $codGrupoEstudos)
                        ->get();

        $atividades = Atividade::get();

        return view('grupoestudo.atividade.adicionar')->with(array(
          'grupos'     => $grupos,
          'atividades' => $atividades
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $atividades = \DB::table('atividade')
                           ->orderBy('codAtividade', 'desc')
                           ->first();

        if (empty($atividades)) {
          $novoCodAtividade = 1;
        }else{
          $novoCodAtividade = $atividades->codAtividade;
          $novoCodAtividade++;
        }

        $atividade = new Atividade;
        $atividade->codAtividade   = $novoCodAtividade;
        $atividade->nomeAtividade  = $request->nomeAtividade;
        $atividade->descrAtividade = $request->descrAtividade;
        $atividade->dataAtividade  = date("Y-m-d");
        $atividade->cpfAluno       = session()->get('cpfAluno');
        $atividade->codGrupoEstudo = $request->grupoEstudo; // CORRIGIR
        $atividade->save();

        //echo "<pre>".json_encode($atividade, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)."</pre>"; die();

        for ($x=1; $x < 200; $x++) {

            if (empty($request["inputTextQ1A$x"])) {
              break;
            }

            $questoes = \DB::table('questao')
                             ->orderBy('codQuestao', 'desc')
                             ->first();

            if (empty($questoes)) {
              $novoCodQuestao = 1;
            }else{
              $novoCodQuestao = $questoes->codQuestao;
              $novoCodQuestao++;
            }

            $questao = new Questao;
            $questao->codQuestao   = $novoCodQuestao;
            $questao->descrQuestao = $request["descrQuestaoQ".$x];
            $questao->codAtividade = $novoCodAtividade;

            if (empty($request["imgQuestaoQ".$x])) {

              $questao->imagemQuestao = null;

            }else{

              $questao->imagemQuestao = $request["imgQuestaoQ".$x];

            }

            $questao->save();

            //echo $questao;

            for ($y=1; $y < 50; $y++) {

                $alternativas = \DB::table('alternativa')
                                     ->orderBy('codAlternativa', 'desc')
                                     ->first();

                if (empty($alternativas)) {
                  $novoCodAlternativa = 1;
                }else{
                  $novoCodAlternativa = $alternativas->codAlternativa;
                  $novoCodAlternativa++;
                }

                $alternativa = new Alternativa;
                $alternativa->codAlternativa = $novoCodAlternativa;
                $alternativa->codQuestao     = $novoCodQuestao;

                if (!empty($request["inputTextQ".$x."A".$y])) {
                  $alternativa->letraAlternativa = $request["letraAlternativaQ".$x."A".$y];
                  $alternativa->descrAlternativa = $request["inputTextQ".$x."A".$y];

                  if (!empty($request["checkboxQ".$x."A".$y])) {
                    $alternativa->certaAlternativa = $request["checkboxQ".$x."A".$y];
                  }else{
                    $alternativa->certaAlternativa = 0;
                  }
                  $alternativa->save();
                }else {
                  break;
                }
                //echo $alternativa;
            }
        }

        $ranque = new Ranque;
        $ranque->cpfAluno       = session()->get('cpfAluno');
        $ranque->codGrupoEstudo = $atividade->codGrupoEstudo;
        $ranque->pontoRanque    = 20;
        $ranque->save();

        return "<script LANGUAGE='JavaScript'>
                  window.alert('Atividade criada com sucesso!');
                  window.location.href='/grupodeestudos/".$request->grupoEstudo."/atividades';
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
    // public function destroy($codAtividade)
    // {
    //     $codAtividade = base64_decode($codAtividade);
    //
    //     $atividade = Atividade::find($codAtividade);
    //     //echo $atividade;
    //     $atividade->onDelete('cascade');
    // }
}
