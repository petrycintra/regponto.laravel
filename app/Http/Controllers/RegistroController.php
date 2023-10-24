<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use Illuminate\Http\Request;
use Auth;

date_default_timezone_set('America/Sao_Paulo');
class RegistroController extends Controller
{
    /**
     * Renderiza a pagina de controle de ponto e mostra todos os pontos batidos pelo usuário
     */
    public function ponto()
    {
        $pontos = Registro::where('name', 'like', '%'.Auth::user()->name.'%')->get();
        return view('admin.ponto', compact('pontos'));
    }

    /**
     * Registra o horário de entrada do usuário em uma nova coluna no banco de dados.
     */
    public function inicio()
    {
        $data = date('Y/m/d');
        $hora = date('Y/m/d H:i:s');
        $verificacao = Registro::where('data', '=', $data)->get();
        if($verificacao == '[]'){
        Registro::create([
            'name'=>Auth::user()->name,
            'data'=>$data,
            'entrada'=>$hora,
            'intervalo'=>null,
            'volta'=>null,
            'final'=>null,
            'controle'=>1
        ]);
        }else{
            //Caso usuário já tenha registro de ponto para o dia atual, exibir mensagem na tela
            return redirect()->back()->with('erro', "Você já bateu ponto hoje.");
        }
        return redirect()->intended('/admin/ponto');

    }

    /**
     * Registra o horário de intervalo do usuário em uma nova coluna no banco de dados.
     */
    public function intervalo()
    {
        $data = date('Y/m/d');
        $hora = date('Y/m/d H:i:s');
        $intervalo = Registro::where('name', 'like', '%'.Auth::user()->name.'%')
        ->where('data', '=', $data)->get();
        foreach ($intervalo as $verificacao) { 
        }
        if($intervalo == '[]'){
            //Caso usuário não tenha registro de ponto para o dia atual, não poderá registrar o intervalo
            return redirect()->back()->with('erro', "Você deve bater seu ponto antes de executar essa ação.");
        }elseif($verificacao->controle == 1){
            $intervalo = Registro::where('name', 'like', '%'.Auth::user()->name.'%')
            ->where('data', '=', $data)
            ->update
            ([
            'intervalo'=>$hora,
            'controle'=>2
            ]);
            return redirect()->intended('/admin/ponto');
        }elseif($verificacao->controle >= 2 && $verificacao->controle <= 3){
            //Caso usuário já tenha tirado intervalo no dia atual, não poderá fazer novamente
            return redirect()->back()->with('erro', "Você já tirou intervalo hoje.");
        }elseif($verificacao->controle >= 4){
            //Caso cliente já tenha encerrado expediente, não poderá tirar intervalo
            return redirect()->back()->with('erro', "Você já encerrou o expediente por hoje.");
        }
    }

    /**
     * Registra o horário de retorno do intervalo do usuário em uma nova coluna no banco de dados.
     */
    public function voltar()
    {
        $data = date('Y/m/d');
        $hora = date('Y/m/d H:i:s');
        $voltar = Registro::where('name', 'like', '%'.Auth::user()->name.'%')
        ->where('data', '=', $data)->get();
        foreach ($voltar as $verificacao) { 
        }
        if($voltar == '[]'){
            return redirect()->back()->with('erro', "Você deve bater seu ponto antes de executar essa ação.");
        }elseif($verificacao->controle == 2){
            $voltar = Registro::where('name', 'like', '%'.Auth::user()->name.'%')
            ->where('data', '=', $data)
            ->update
            ([
                'volta'=>$hora,
                'controle'=>3
            ]);
        return redirect()->intended('/admin/ponto');
        }elseif($verificacao->controle == 3){
            //Caso usuário já tenha retornado do intervalo no dia atual, não poderá fazer novamente
            return redirect()->back()->with('erro', "Você já voltou do intervalo hoje.");
        }elseif($verificacao->controle >= 4){
            //Caso cliente já tenha encerrado expediente, não poderá tirar intervalo
            return redirect()->back()->with('erro', "Você já encerrou o expediente por hoje.");
        }elseif($verificacao->controle <= 2){
            //Caso cliente ainda não tenha tirado o intervalo, ele não pode retornar antes de sair
            return redirect()->back()->with('erro', "Para voltar do intervalo, primeiro você deve inicia-lo.");
        }
    }

    /**
     * Registra o horário de encerramento do expediente do usuário em uma nova coluna no banco de dados.
     */
    public function final(registro $registro)
    {
        $data = date('Y/m/d');
        $hora = date('Y/m/d H:i:s');
        $final = Registro::where('name', 'like', '%'.Auth::user()->name.'%')
        ->where('data', '=', $data)->get();
        foreach ($final as $verificacao) { 
        }
        if($final == '[]'){
            return redirect()->back()->with('erro', "Você deve bater seu ponto antes de executar essa ação.");
        }elseif($verificacao->controle == 3){
            $final = Registro::where('name', 'like', '%'.Auth::user()->name.'%')
            ->where('data', '=', $data)
            ->update
            ([
                'final'=>$hora,
                'controle'=>4
            ]);
            return redirect()->intended('/admin/ponto');
        }elseif($verificacao->controle >= 4){
            //Caso cliente já tenha encerrado expediente, não poderá encerrar novamente
            return redirect()->back()->with('erro', "Você já encerrou o expediente por hoje.");
        }elseif($verificacao->controle >= 3){
            //Caso o cliente ainda não tenha retornado do intervalo, ele não poderá encerrar o expediente
            return redirect()->back()->with('erro', "Para encerrar o expediente, primeiro você deve voltar do intervalo.");
        }
    }
}
