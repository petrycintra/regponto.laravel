<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [InicioController::class, 'index'])->name('login.form'); //Formulario de Login
Route::post('/auth', [InicioController::class, 'auth'])->name('login.auth'); //Enviar dados para o metodo de Autenticação do Laravel
Route::get('/admin/painel', [InicioController::class, 'painel'])->name('admin.painel'); //Painel de Controle
Route::get('/logout', [InicioController::class, 'deslog'])->name('admin.deslog'); //Sair da conta/Deslogar

Route::get('/admin/ponto', [RegistroController::class, 'ponto'])->name('admin.ponto'); //Pagina para registrar horário dos pontos
Route::get('/inicio', [RegistroController::class, 'inicio'])->name('ponto.inicio'); //Comando para Bater Ponto inicial
Route::get('/intervalo', [RegistroController::class, 'intervalo'])->name('ponto.intervalo'); //Comando para registrar saída para o intervalo
Route::get('/volta', [RegistroController::class, 'voltar'])->name('ponto.voltar'); //Comando para registrar volta do intervalo
Route::get('/final', [RegistroController::class, 'final'])->name('ponto.final'); //Comando para registrar final do expediente

Route::get('/admin/editar', [Controller::class, 'editar'])->name('admin.editar'); //Caminho para exibir todos os funcionários existentes
Route::get('/admin/editardados/{id}', [Controller::class, 'editardados'])->name('admin.editardados'); //Caminho para editar algum funcionário especifico, selecionado no caminho acima
Route::post('/admin/editardadosesalvar', [Controller::class, 'editardadosesalvar'])->name('admin.editardadosesalvar'); //Comando para salvar os dados editados no caminho acima
Route::get('/admin/adicionar', [Controller::class, 'adicionar'])->name('admin.adicionar'); //Caminho para adicionar um novo cadastro/funcionário
Route::post('/admin/adicionaresalvar', [Controller::class, 'adicionaresalvar'])->name('admin.adicionaresalvar'); //Comando para salvar o novo cadastro no banco de dados
Route::get('/admin/inativardados/{id}', [Controller::class, 'inativardados'])->name('admin.inativardados'); //Pagina para deletar/confirmar inativação de funcionário
Route::post('/admin/confirmarinativardados/', [Controller::class, 'confirmarinativardados'])->name('admin.confirmarinativardados'); //Comando para deletar/inativar caso pagina acima seja confirmada
Route::get('/admin/editarmeusdados/{id}', [Controller::class, 'editarmeusdados'])->name('admin.editarmeusdados'); //Página para o funcionário editar os proprios dados
Route::post('/admin/editarmeusdadosesalvar', [Controller::class, 'editarmeusdadosesalvar'])->name('admin.editarmeusdadosesalvar'); //Comando para salvar no banco os dados editados na pagina acima

Route::get('/admin/verpontos', [InicioController::class, 'verpontos'])->name('admin.verpontos'); //Pagina para o administrador ver todos os pontos já batidos no dia atual
Route::post('/admin/verpontos_dataselecionada', [InicioController::class, 'verpontos_dataselecionada'])->name('admin.verpontos_dataselecionada'); //Comando para pesquisar po nome ou data especifica no banco de dados.
