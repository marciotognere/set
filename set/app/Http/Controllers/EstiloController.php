<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Estilo;
use App\Models\Exame;

use Validator;

class EstiloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $verifica = \DB::select(\DB::raw('SELECT COUNT(*) AS Quantidade,
                                                 max(dataEstilo) AS UltimaData
                                            FROM set.estilo
                                            WHERE cpfAluno = "'.session()->get('cpfAluno').'"
                                              AND YEAR(CURDATE()) = YEAR(dataEstilo)'));

        //print("<pre>".print_r($verifica,true)."</pre>");die();

        foreach ($verifica as $verifics) {
          if ($verifics->UltimaData > date("Y-m-d", strtotime('-7 days')) OR $verifics->Quantidade == 80) {
            return redirect('portal');
          }
        }

        $data = date("d/m/Y");

        $questoes = \DB::select(\DB::raw('SELECT ex.codExame,
                                                 ex.descrExame,
                                                 ex.codTipoEstilo
                                            FROM (SELECT *
                                                    FROM (SELECT ex.codExame,
                                                                 ex.descrExame,
                                                                 ex.codTipoEstilo
                                                            -- FROM (SELECT * FROM set.estilo WHERE cpfAluno = "99999999999") es
                                                            FROM (SELECT * FROM set.estilo WHERE cpfAluno = "'.session()->get('cpfAluno').'") es
                                          				  RIGHT JOIN set.exame ex ON es.codExame = ex.codExame
                                                            -- WHERE (EXTRACT(YEAR FROM dataEstilo) < YEAR("2021-01-01")
                                                            WHERE (EXTRACT(YEAR FROM dataEstilo) < YEAR('.$data.')
                                          					 OR es.codExame IS NULL)
                                                              AND ex.codTipoEstilo = 1
                                                              AND NOT EXISTS (SELECT *
                                          									  FROM set.estilo
                                          									  -- WHERE EXTRACT(YEAR FROM dataEstilo) = YEAR("2021-01-01")
                                                              WHERE EXTRACT(YEAR FROM dataEstilo) = YEAR('.$data.')
                                          										AND codExame = ex.codExame
                                          										AND cpfAluno = es.cpfAluno)
                                                            LIMIT 5) ex1
                                                  UNION ALL
                                                  SELECT *
                                                    FROM (SELECT ex.codExame,
                                                                 ex.descrExame,
                                                                 ex.codTipoEstilo
                                                            FROM (SELECT * FROM set.estilo WHERE cpfAluno = "'.session()->get('cpfAluno').'") es
                                          				  RIGHT JOIN set.exame ex ON es.codExame = ex.codExame
                                                            -- WHERE (EXTRACT(YEAR FROM dataEstilo) < YEAR("2021-01-01")
                                                            WHERE (EXTRACT(YEAR FROM dataEstilo) < YEAR('.$data.')
                                          					 OR es.codExame IS NULL)
                                                              AND ex.codTipoEstilo = 2
                                                              AND NOT EXISTS (SELECT *
                                          									  FROM set.estilo
                                          									  -- WHERE EXTRACT(YEAR FROM dataEstilo) = YEAR("2021-01-01")
                                                              WHERE EXTRACT(YEAR FROM dataEstilo) = YEAR('.$data.')
                                          										AND codExame = ex.codExame
                                          										AND cpfAluno = es.cpfAluno)
                                                            LIMIT 5) ex2
                                          		UNION ALL
                                                  SELECT *
                                                    FROM (SELECT ex.codExame,
                                                                 ex.descrExame,
                                                                 ex.codTipoEstilo
                                                            FROM (SELECT * FROM set.estilo WHERE cpfAluno = "'.session()->get('cpfAluno').'") es
                                          				  RIGHT JOIN set.exame ex ON es.codExame = ex.codExame
                                                            -- WHERE (EXTRACT(YEAR FROM dataEstilo) < YEAR("2021-01-01")
                                                            WHERE (EXTRACT(YEAR FROM dataEstilo) < YEAR('.$data.')
                                          					 OR es.codExame IS NULL)
                                                              AND ex.codTipoEstilo = 3
                                                              AND NOT EXISTS (SELECT *
                                          									  FROM set.estilo
                                          									  -- WHERE EXTRACT(YEAR FROM dataEstilo) = YEAR("2021-01-01")
                                                              WHERE EXTRACT(YEAR FROM dataEstilo) = YEAR('.$data.')
                                          										AND codExame = ex.codExame
                                          										AND cpfAluno = es.cpfAluno)
                                                            LIMIT 5) ex3
                                                  UNION ALL
                                                  SELECT *
                                                    FROM (SELECT ex.codExame,
                                                                 ex.descrExame,
                                                                 ex.codTipoEstilo
                                                            FROM (SELECT * FROM set.estilo WHERE cpfAluno = "'.session()->get('cpfAluno').'") es
                                          				  RIGHT JOIN set.exame ex ON es.codExame = ex.codExame
                                                            -- WHERE (EXTRACT(YEAR FROM dataEstilo) < YEAR("2021-01-01")
                                                            WHERE (EXTRACT(YEAR FROM dataEstilo) < YEAR('.$data.')
                                          					 OR es.codExame IS NULL)
                                                              AND ex.codTipoEstilo = 4
                                                              AND NOT EXISTS (SELECT *
                                          									  FROM set.estilo
                                          									  -- WHERE EXTRACT(YEAR FROM dataEstilo) = YEAR("2021-01-01")
                                                              WHERE EXTRACT(YEAR FROM dataEstilo) = YEAR('.$data.')
                                          										AND codExame = ex.codExame
                                          										AND cpfAluno = es.cpfAluno)
                                                            LIMIT 5) ex4
                                          		) ex
                                            ORDER BY ex.codExame ASC'));

        //print("<pre>".print_r($questoes,true)."</pre>");

        return view('estilo/diagnostico')->with('questoes',$questoes);
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
        $numQuestoesRespondidaAnoAtual = \DB::table('aluno')
                                            ->rightJoin('estilo', 'aluno.cpfAluno', '=', 'estilo.cpfAluno')
                                            //->whereYear('dataEstilo', '=', '2021')
                                            ->whereYear('dataEstilo', '=', date("Y"))
                                            ->where('estilo.cpfAluno','=',session()->get('cpfAluno'))
                                            ->count();

        $etapa = null;

        switch ($numQuestoesRespondidaAnoAtual) {
          case 0:
            $etapa = 1;
            break;
          case 20:
            $etapa = 2;
            break;
          case 40:
            $etapa = 3;
            break;
          case 60:
            $etapa = 4;
            break;
          default:
            $etapa = 666; //COLOCAR MENSAGEM DE ERRO
            break;
        }

        //Verifica se foi respondidas todas as perguntas do teste de estilo de aprendizagem
        if (count($request->input()) == 21) {
          foreach($request->input() as $index => $key) {
            if($index === '_token') continue;

            $estilo = new Estilo;
            $estilo->cpfAluno    = session()->get('cpfAluno'); //PEGAR CPF DO USUARIO DA SESSION
            $estilo->codExame    = str_replace('questao','',$index);
            $estilo->dataEstilo  = date("Y-m-d"); //date('Y-m-d', strtotime('+1 years'));//TESTE
            $estilo->notaEstilo  = $request->input($index);
            $estilo->etapaEstilo = $etapa;
            $estilo->save();
          }
          //return redirect('portal');
          return "<script LANGUAGE='JavaScript'>
                    window.alert('Etapa concluída com sucesso!');
                    window.location.href='/estilo/resultado';
                  </script>";
        }else {
          $msgErro = "Responda todas as perguntas para submissão do exame.";
          return "<script LANGUAGE='JavaScript'>
                    window.alert('Você não respondeu todas as perguntas. Preencha por favor!');
                    window.location.href='/estilo';
                  </script>";
          //return redirect('estilo')->with('msgErro',$msgErro);
        }
        $msgErro = "Responda todas as perguntas para submissão do exame.";

        return redirect('/estilo')->with('msgErro',$msgErro);

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

    public function resultadoEstilo()
    {
      $resultadoExame = \DB::select(\DB::raw('SELECT ti.nomeTipoEstilo AS NomeEstilo,
                                                     SUM(notaEstilo)   AS SomaNota,
                                                     EXTRACT(YEAR FROM es.dataEstilo) AS Ano
                                                FROM set.estilo es,
                                              	   set.exame ex,
                                              	   set.tipoestilo ti
                                                WHERE es.codExame = ex.codExame
                                              	AND ex.codTipoEstilo = ti.codTipoEstilo
                                              	AND es.cpfAluno = "'.session()->get('cpfAluno').'"
                                                GROUP BY ti.nomeTipoEstilo, EXTRACT(YEAR FROM es.dataEstilo)
                                                ORDER BY Ano DESC,NomeEstilo ASC'));

      //print("<pre>".print_r($resultadoExame,true)."</pre>");

      return view('estilo/resultado')->with('resultadoExame',$resultadoExame);
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
