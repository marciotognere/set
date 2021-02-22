<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ranque;

class RankingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($codGrupoEstudos)
    {
      $ranques = \DB::select(\DB::raw('SELECT al.nomeAluno,
                                              SUM(ra.pontoRanque) AS pontos
                                         FROM set.ranque ra,
                                              set.aluno al
                                         WHERE al.cpfAluno = ra.cpfAluno
                                           AND ra.codGrupoEstudo = "'.$codGrupoEstudos.'"
                                           GROUP BY al.nomeAluno
                                           ORDER BY pontos DESC'));

       return view('grupoestudo.ranque.listar')->with(array(
          'ranques' => $ranques
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
