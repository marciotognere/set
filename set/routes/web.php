<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });

Route::get('acesso', 'LoginController@index');
Route::post('acesso/verificar', 'LoginController@verificarUsuario');
Route::get('acesso/recuperarsenha', 'LoginController@recuperarSenha');
Route::post('acesso/enviarsenha', 'LoginController@enviarSenha');

Route::get('acesso/novaconta', 'AlunoController@index');
Route::post('acesso/novaconta/store', 'AlunoController@store');

Route::get('matricula', 'MatriculaController@index');
Route::post('matricula/store', 'MatriculaController@store');

Route::get('perfil', 'PerfilController@index');

//Route::view('portal', 'portal');
Route::get('portal', 'MonitorController@index');
Route::get('portal/cadastrar', 'MonitorController@create');
Route::post('portal/cadastrar/salvar', 'MonitorController@store');
Route::get('portal/horario', 'MonitorController@horario');
Route::post('portal/horario/salvar', 'MonitorController@horarioSalvar');
Route::get('buscarDisciplinas/{id}', 'MonitorController@buscarDisciplinas');
Route::get('filtrarMonitores/{codCurso}/{codDisciplina}', 'MonitorController@filtrarMonitores');
Route::get('portal/cadastrar', 'MonitorController@create');
Route::get('portal/agendar/{aluno}', 'MonitorController@agendar');
Route::post('portal/agendar/salvar', 'MonitorController@agendarSalvar');
Route::get('portal/agendamento', 'MonitorController@agendamento');
Route::get('portal/agendamento/deletar/{codDisciplina}/{cpfMonitor}', 'MonitorController@agendamentoDeletar');

Route::get('estilo', 'EstiloController@index');
Route::post('estilo/salvar', 'EstiloController@store');
Route::get('estilo/resultado', 'EstiloController@resultadoEstilo');

//GRUPO DE ESTUDOS
Route::get('grupodeestudos', 'GrupoEstudoController@index');
Route::get('grupodeestudos/adicionar', 'GrupoEstudoController@create');
Route::post('grupodeestudos/adicionar/store', 'GrupoEstudoController@store');
Route::get('grupodeestudos/{codGrupoEstudos}', 'GrupoEstudoController@estiloGrupo');
// Route::get('grupodeestudos/{id}', function ($codGrupoEstudos) {
//   return view('grupoestudo.home')->with(array(
//     'codGrupoEstudos' => $codGrupoEstudos
//   ));
// });
//MEMBROS
Route::get('grupodeestudos/{id}/membros', 'MembroController@index');
Route::get('grupodeestudos/{id}/membros/adicionar', 'MembroController@create');
Route::post('grupodeestudos/{id}/membros/adicionar/store', 'MembroController@store');
Route::get('grupodeestudos/{id}/membros/destroy/{aluno}', 'MembroController@destroy');
//AGENDAMENTOS
Route::get('grupodeestudos/{id}/agendamento', 'AgendamentoController@index');
Route::get('grupodeestudos/{id}/agendamento/adicionar', 'AgendamentoController@create');
Route::post('grupodeestudos/{id}/agendamento/adicionar/store', 'AgendamentoController@store');
Route::get('grupodeestudos/{id}/agendamento/destroy/{agendamento}&&{local}', 'AgendamentoController@destroy');
//ATIVIDADES
Route::get('grupodeestudos/{id}/atividades', 'AtividadeController@index');
Route::get('grupodeestudos/{id}/atividade/adicionar', 'AtividadeController@create');
Route::post('grupodeestudos/{id}/atividade/adicionar/store', 'AtividadeController@store');
Route::get('atividades', 'AtividadeController@minhasAtividades');
// Route::get('atividades/destroy/{codAtividade}', 'AtividadeController@destroy');
//AVALIACOES
Route::get('grupodeestudos/{id}/avaliacoes', 'AvaliacaoController@index');
Route::get('grupodeestudos/{id}/avaliacoes/{idAtividade}', 'AvaliacaoController@show');
//Route::get('grupodeestudos/{id}/avaliacao/adicionar', 'AvaliacaoController@create');
Route::post('grupodeestudos/avaliacao/adicionar/store', 'AvaliacaoController@store');
Route::get('avaliacoes', 'AvaliacaoController@minhasAvaliacoes');

Route::get('avaliacoes', 'AvaliacaoController@minhasAvaliacoes');
Route::get('grupodeestudos/{codGrupoEstudos}/ranque', 'RankingController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('encrypt/{key}', 'EncryptionController@encrypt');
Route::get('decrypt/{key}', 'EncryptionController@decrypt');
