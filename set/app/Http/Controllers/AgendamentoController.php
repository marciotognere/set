<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Agendamento;
use App\Models\Grupoestudo;
use App\Models\Local;
use App\Models\Ranque;

use App\Http\Requests\AgendamentoRequest;

class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($codGrupoEstudos)
    {
        $agendamentos = \DB::select(\DB::raw('SELECT ag.codAgendamento,
                                                     ag.nomeAgendamento,
                                                     ag.descrAgendamento,
                                                     ag.dataAgendamento,
                                                     ag.horaAgendamento,
                                                     al.nomeAluno,
                                                     lo.codLocal,
                                                     lo.nomeLocal
                                                FROM set.agendamento ag
                                                INNER JOIN set.local lo ON ag.codLocal = lo.codLocal
                                                LEFT JOIN set.aluno al ON al.cpfAluno = ag.monitorAgendamento'));

        return view('grupoestudo.agendamento.listar')->with(array(
          'agendamentos' => $agendamentos
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
                        ->orderBy('nomeGrupoEstudo','asc')
                        ->get();

        $monitores = \DB::select(\DB::raw('SELECT a.cpfAluno,
                                                  a.nomeAluno
                                             FROM aluno a,
                                                  monitor m
                                             WHERE a.cpfAluno = m.cpfAluno
                                             GROUP BY a.cpfAluno, a.nomeAluno'));

        $locais = Local::orderBy('nomeLocal','asc')->get();

        return view('grupoestudo.agendamento.adicionar')->with(array(
          'grupos'    => $grupos,
          'locais'    => $locais,
          'monitores' => $monitores
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgendamentoRequest $request)
    {
        $monitor = $request->input('cpfAluno');
        if ($monitor == 0) {
          $monitor = null;
        }

        $agendamento = new Agendamento;
        $agendamento->codLocal         = $request->input('local');
        $agendamento->codGrupoEstudo   = $request->input('grupoEstudo');
        $agendamento->nomeAgendamento  = $request->input('nomeAgendamento');
        $agendamento->descrAgendamento = $request->input('descrAgendamento');
        $agendamento->dataAgendamento  = $request->input('dataAgendamento');
        $agendamento->horaAgendamento  = $request->input('horaAgendamento');
        $agendamento->monitorAgendamento  = $monitor;
        $agendamento->save();

        $ranque = new Ranque;
        $ranque->cpfAluno       = session()->get('cpfAluno');
        $ranque->codGrupoEstudo = $agendamento->codGrupoEstudo;
        $ranque->pontoRanque    = 10;
        $ranque->save();

        return "<script LANGUAGE='JavaScript'>
                  window.alert('Agendamento criado com sucesso!');
                  window.location.href='/grupodeestudos".'/'.$request->grupoEstudo."/agendamento';
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
    public function destroy($codGrupoEstudo,$codAgendamento,$codLocal)
    {
        $codAgendamento = base64_decode($codAgendamento);
        $codLocal       = base64_decode($codLocal);

        \DB::table('agendamento')
            ->where('agendamento.codGrupoEstudo', '=', $codGrupoEstudo)
            ->where('agendamento.codAgendamento', '=', $codAgendamento)
            ->where('agendamento.codLocal', '=', $codLocal)->delete();

            return "<script LANGUAGE='JavaScript'>
                      window.alert('Agendamento deletado!');
                      window.location.href='/grupodeestudos".'/'.$codGrupoEstudo."/agendamento';
                    </script>";
        //return redirect('/grupodeestudos/'.$codGrupoEstudo.'/agendamento');
    }
}
