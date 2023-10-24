<?php

namespace App\Http\Controllers;

use App\Models\Inicio;
use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('index');
    }
    
    /**
     * Recebe os dados de login inseridos pelo usuário.
     */
    public function auth(Request $request)
    {
        $credenciais = $request->validate([   //Associa os dados inseridos à variável $credenciais
            'email' => ['required', 'email'], //Verifica se o email foi inserido e se é válido em formato de email - Ex: alguem@gmail.com
            'password' => ['required'],       //Verifica se a senha foi inserida
        ], [
            'email.required' => 'Inserir o email é obrigatório.',  //Se email não inserido, exibir mensagem
            'email.email' => 'O email inserido é inválido.',       //Se email inserido for em formato inválido, exibir mensagem
            'password.required' => "O campo senha é obrigatório.", //Se senha não inserida, exibir mensagem
        ]);

        if(auth::attempt($credenciais)){
            $request->session()->regenerate();
            return redirect()->intended('/admin/painel'); //Se confirmado, redireciona para o painel principal do sistema
        } else {
            return redirect()->back()->with('erro', 'Usuário ou senha não conferem.'); //Se usuário e/ou senha não forem iguais aos do banco de dados, exibir mensagem
        }
    }

    /**
     * Redireciona o usuario para o painel de controle
     */
    public function painel()
    {
        return view('admin.painel');
    }

    /**
     * Desloga o usuario.
     */
    public function deslog(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(Route('login.form'));
    }

    public function verpontos()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y/m/d');
        //$pontos = Registro::all();
        $pontos = Registro::where('data', '=', $data)->get();
        return view ('admin.verpontos', compact('pontos'));
    }

    public function verpontos_dataselecionada(Request $request)
    {
        //Se nome for vazio e data também, retornar a pagina com mensagem de erro
        //Nome vázio, Data vázia
        if($request->name == null  && $request->data == null){
            $pontos = Registro::all();
            return redirect(Route('admin.verpontos'))->with('erro', 'Para pesquisa personalizada, deve-se selecionar no minimo 1 (um) dos campos.'); //Se usuário e/ou senha não forem iguais aos do banco de dados, exibir mensagem
        }
        //Se nome for preenchido e a data for vazia, pesquisar no banco de dados apenas os registros daquele nome e exibir na tela.
        //Nome Ok, Data vázia
        elseif($request->name != null && $request->data == null){
            $pontos = Registro::where('name', 'like', '%'.$request->name.'%')->get();
            return view ('admin.verpontos', compact('pontos'))->with('erro', 'Nome Ok, Data Vazia.');
        }
        //Se nome for vazio e data for inserida, pesquisar no banco de dados apenas os registros daquela data e exibir na tela.
        //Nome Vázio, Data Ok
        elseif($request->name == null && $request->data != null){
            $pontos = Registro::where('data', 'like', '%'.$request->data.'%')->get();
            return view ('admin.verpontos', compact('pontos'))->with('erro', 'Nome Vazio, Data Ok.');
        }
        //Se nome for preenchido e data for inserida, pesquisar no banco de dados os registros daquela data com aquele nome e exibir na tela.
        //Nome Ok, Data Ok
        elseif($request->name != null && $request->data != null){
            $pontos = Registro::where('data', 'like', '%'.$request->data.'%')->where('name', 'like', '%'.$request->name.'%')->get();
            return view ('admin.verpontos', compact('pontos'))->with('erro', 'Nome Ok, Data Ok.');
        }
    }
}
