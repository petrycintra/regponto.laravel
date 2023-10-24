<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Inicio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Renderiza a pagina de que mostra a lista de funcionários
     */
    public function editar()
    {
        $funcionarios = User::all();
        return view('admin.editar', compact('funcionarios'));
    }

    /**
     * Renderiza a pagina para adicionar novo funcionário
     */
    public function adicionar()
    {
        $funcionarios = User::all();
        return view('admin.adicionar');
    }

    /**
     * Recebe os dados inseridos na tela de adição de funcionários e grava no banco de dados.
     */
    public function adicionaresalvar(Request $request)
    {
        //Se existir algum campo vázio, retornar com uma mensagem de erro (Todos os campos são obrigatórios)
        if(empty($request->name) || empty($request->email) || empty($request->password) || empty($request->position)){
            return redirect()->back()->with('erro', "Todos os campos são obrigatorios.");
        }else{ //Se todos os campos foram preenchidos, gravar as informações no banco de dados.
                $senha = Hash::make($request->password);
                User::factory()->create([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>$senha,
                    'position'=>$request->position,
                ]);
                $funcionarios = User::all();
                return view('admin.editar', compact('funcionarios'));
            }
    }

    /**
     * Renderiza a pagina para editar dados do funcionario selecionado
     */
    public function editardados(request $request)
    {
        $funcionarios = User::where('id', '=', $request->id)->get();
        return view('admin.editardados', compact('funcionarios'));
        
    }

    /**
     * Renderiza a pagina para editar os proprios dados
     */
    public function editarmeusdados(request $request)
    {
        $funcionarios = User::where('id', '=', $request->id)->get();
        return view('admin.editarmeusdados', compact('funcionarios'));
        
    }

    /**
     * Recebe os dados inseridos na tela de edição de funcionários e grava no banco de dados.
     */
    public function editardadosesalvar(request $request)
    {   //Se cargo estiver marcado e a senha for vázia, atualizar banco de dados sem a senha
        if(isset($request->position) && $request->password == null){
            $funcionarios = User::where('id', '=', $request->id)->update
            ([
            'name'=>$request->name,
            'email'=>$request->email,
            'position'=>$request->position,
            ]);
            $funcionarios = User::all();
            return view('admin.editar', compact('funcionarios'));
        //Se cargo não estiver marcado e a senha for vázia, atualizar banco de dados sem a senha e cargo
        }elseif(!isset($request->position) && $request->password != null){
            $funcionarios = User::where('id', '=', $request->id)->update
            ([
            'name'=>$request->name,
            'email'=>$request->email,
            ]);
            $funcionarios = User::all();
            return view('admin.editar', compact('funcionarios'));
        }

        //Se cargo estiver marcado e a senha for preenchida, atualizar banco de dados com todos os campos
        if(isset($request->position) && $request->password != null){
            $senha = Hash::make($request->password);
            $position = "Gerente";
            $funcionarios = User::where('id', '=', $request->id)->update
            ([
            'name'=>$request->name,
            'email'=>$request->email,
            'position'=>$request->position,
            'password'=>$senha,
            ]);
            $funcionarios = User::all();
            return view('admin.editar', compact('funcionarios'));
        //Se cargo não estiver marcado e a senha for preenchida, atualizar banco de dados sem o cargo
        }elseif(!isset($request->position) && $request->password == null){
            $senha = Hash::make($request->password);
            $funcionarios = User::where('id', '=', $request->id)->update
            ([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            ]);
            $funcionarios = User::all();
            return view('admin.editar', compact('funcionarios'));
        }
    }

    /**
     * Renderiza pra confirmar se deseja realmente inativar/excluir funcionário previamente selecionado
     */
    public function inativardados(request $request)
    {
        $funcionarios = User::where('id', '=', $request->id)->get();
        return view('admin.inativardados', compact('funcionarios')); 
    }
    
    /**
     * Após confirmada a exclusão, seleciona os dados do funcionário e exclui/deleta do banco de dados
     */
    public function confirmarinativardados(request $request)
    {
        $funcionarios = User::where('id', '=', $request->id)->get();
        $funcionarios->each->delete();
        $funcionarios = User::all();
        return view('admin.editar', compact('funcionarios'));
        
    }
    
    /**
     * Recebe os dados inserido na tela de edição dos proprios dados e grava no banco de dados
     */
    public function editarmeusdadosesalvar(request $request)
    {   //Se existir cargo e senha for vazia, grava no banco de dados sem alterar a senha
        if(isset($request->position) && $request->password == null){
            $funcionarios = User::where('id', '=', $request->id)->update
            ([
            'name'=>$request->name,
            'email'=>$request->email,
            'position'=>$request->position,
            ]);
            $funcionarios = User::all();
            return view('admin.editar', compact('funcionarios'));
        //Se cargo não for selecionado (usuarios que não são da adminsitração não podem alterar esse campo, por exemplo) e senha for vazia, não alterar cargo e senha
        }elseif(!isset($request->position) && $request->password != null){
            $funcionarios = User::where('id', '=', $request->id)->update
            ([
            'name'=>$request->name,
            'email'=>$request->email,
            ]);
            $funcionarios = User::all();
            return view('admin.editar', compact('funcionarios'));
        }
    
        //Se cargo estiver preenchido e senha também, atualizar todos os campos
        if(isset($request->position) && $request->password != null){
            $senha = Hash::make($request->password);
            $position = "Gerente";
            $funcionarios = User::where('id', '=', $request->id)->update
            ([
            'name'=>$request->name,
            'email'=>$request->email,
            'position'=>$request->position,
            'password'=>$senha,
            ]);
            $funcionarios = User::all();
            return view('admin.editar', compact('funcionarios'));
        //Se cargo não estiver preenchido mas a senha sim, atualizar sem alterar o cargo.
        }elseif(!isset($request->position) && $request->password == null){
            $senha = Hash::make($request->password);
            $funcionarios = User::where('id', '=', $request->id)->update
            ([
            'name'=>$request->name,
            'email'=>$request->email,
            ]);
            $funcionarios = User::all();
            return view('admin.editar', compact('funcionarios'));
        }
    }

}



