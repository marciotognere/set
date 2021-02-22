<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Atividade;
use App\Models\Questao;
use App\Models\Avaliacao;
use App\Models\Respostaavaliacao;
use App\Models\Ranque;

class AvaliacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($codGrupoEstudos)
    {
      $atividades = \DB::select(\DB::raw('SELECT at.nomeAtividade,
                                                 at.codAtividade,
                                                 ge.nomeGrupoEstudo,
                                                 al.nomeAluno,
                                                 (SELECT COUNT(*)
                                                    FROM questao qt
                                          		  WHERE qt.codAtividade = qu.codAtividade) AS quantQuestoes
                                            FROM set.atividade at,
                                          	     set.grupoestudo ge,
                                                 set.questao qu,
                                                 set.aluno al
                                            WHERE at.codGrupoEstudo = ge.codGrupoEstudo
                                              AND qu.codAtividade   = at.codAtividade
                                              AND al.cpfAluno       = at.cpfAluno
                                              AND ge.codGrupoEstudo = "'.$codGrupoEstudos.'"
                                            GROUP BY at.codAtividade,at.nomeAtividade,ge.nomeGrupoEstudo,al.nomeAluno'));

      return view('grupoestudo.avaliacao.listar')->with(array(
        'atividades'     => $atividades,
        'codGrupoEstudo' => $codGrupoEstudos
      ));
    }

    public function minhasAvaliacoes()
    {
      $atividades = \DB::select(\DB::raw('SELECT at.nomeAtividade,
                                                 at.codAtividade,
                                                 ge.nomeGrupoEstudo,
                                                 al.nomeAluno,
                                                 (SELECT COUNT(*)
                                                    FROM questao qt
                                          		  WHERE qt.codAtividade = qu.codAtividade) AS quantQuestoes
                                            FROM set.atividade at,
                                          	     set.grupoestudo ge,
                                                 set.questao qu,
                                                 set.aluno al
                                            WHERE at.codGrupoEstudo = ge.codGrupoEstudo
                                              AND qu.codAtividade   = at.codAtividade
                                              AND al.cpfAluno       = at.cpfAluno
                                              AND al.cpfAluno       = '.session()->get('cpfAluno').'
                                            GROUP BY at.codAtividade,at.nomeAtividade,ge.nomeGrupoEstudo,al.nomeAluno'));

      return view('grupoestudo.avaliacao.listar')->with(array(
        'atividades' => $atividades
      ));
    }

    // public function minhasAvaliacoes()
    // {
    //   $atividades = \DB::table('atividade')
    //                       ->join('aluno','atividade.cpfAluno','=','aluno.cpfAluno')
    //                       ->where('atividade.cpfAluno','=','99999999999')
    //                       ->get();
    //
    //   return view('grupoestudo.atividade.listar')->with(array(
    //     'atividades' => $atividades
    //   ));
    // }

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
        $codGrupoEstudo = $request->input('codGrupoEstudo');
        $codAtividade   = $request->input('codAtividade');

        $teste = Avaliacao::where('codAtividade','=',$codAtividade)
                   ->where('cpfAluno','=',session()->get('cpfAluno'))
                   ->where('codGrupoEstudo','=',88)
                   ->get();

        if ($teste->isEmpty()) {
          return "<script LANGUAGE='JavaScript'>
                    window.alert('Avaliação já realizada!');
                    window.location.href='/grupodeestudos/$codGrupoEstudo/avaliacoes';
                  </script>";
        }

        $avaliacao = new Avaliacao;
        $avaliacao->codAtividade = $codAtividade;
        $avaliacao->cpfAluno = session()->get('cpfAluno');
        $avaliacao->codGrupoEstudo = $codGrupoEstudo;
        $avaliacao->save();
        //echo "<pre>".json_encode($avaliacao, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)."</pre>";die();

        for ($x=1; $x < 200; $x++) {

          for ($y=1; $y < 50; $y++) {
            if (isset($request["checkboxQ".$x."A".$y])) {
              $resposta = new Respostaavaliacao;
              $resposta->codAlternativa = $y;
              $resposta->codAtividade = $codAtividade;
              $resposta->cpfAluno = session()->get('cpfAluno');
              $resposta->codGrupoEstudo = $codGrupoEstudo;
              $resposta->save();
            }
          }
        }

        $ranque = new Ranque;
        $ranque->cpfAluno       = session()->get('cpfAluno');
        $ranque->codGrupoEstudo = $avaliacao->codGrupoEstudo;
        $ranque->pontoRanque    = 15;
        $ranque->save();

        return "<script LANGUAGE='JavaScript'>
                  window.alert('Avaliação realizada com sucesso!');
                  window.location.href='/grupodeestudos/$codGrupoEstudo/avaliacoes';
                </script>";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($codGrupo,$codAtividade)
    {
      $avaliacoes = Atividade::with('questaos.alternativas')
                               ->where('atividade.codGrupoEstudo','=',$codGrupo)
                               ->where('atividade.codAtividade','=',$codAtividade)
                               ->get();

      //echo "<pre>".json_encode($avaliacoes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)."</pre>"; die();

      return view('grupoestudo.avaliacao.adicionar')->with(array(
        'avaliacoes'     => $avaliacoes,
        'codGrupoEstudo' => $codGrupo
      ));
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
