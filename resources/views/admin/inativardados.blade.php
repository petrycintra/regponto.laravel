@extends('layout')                           <!-- Importar configurações do Framework Front-End Materialize.Css -->
@section('title', 'ADICIONAR/EDITAR FUNCIONÁRIO') <!-- Titulo da Página -->
@section('conteudo')                         <!-- Inicia a sessão d conteúdo da página -->
@auth                                        <!-- Verifica se usuário está logado, caso sim, exibe o painel de controle abaixo -->
@if (Auth::user()->position == "Gerente" || Auth::user()->position == "Gestao-RH") <!-- Verifica se usuário logado tem permissão para acessar essa página, caso sim, exibe o painel de controle abaixo -->

<div class="row">
    
    <div class="col s12 m6 push-m3 ">
        <div class="collection center">

            <!-- Exibe o nome completo do usuário atualmente logado -->
            <a class="collection-item"> {{ Auth::user()->name }}, Esse é a pagina onde você pode excluir os dados de um funcionário</a>
        </div>
        <div class="card-panel teal lighten-2">
            <h5 class="light center">TELA DE EXCLUSÃO DE FUNCIONÁRIOS</h5>
        </div>
        
        <table class="striped">
                @foreach($funcionarios as $funcionario)
                <form action="{{ route('admin.confirmarinativardados')}}" method="POST">
                    @csrf
                <input type="hidden" name="id" value="{{ $funcionario->id }}" id="id" type="text" class="validate">
                    <td> {{ $funcionario->name }} </td>
                    <td> {{ $funcionario->position }} </td>
                    <td> {{ $funcionario->email }} </td>
                    <td><button name="btn-confirmar" class="btn orange" > Confirmar Exclusão</button></td>
                </form>
                    <td><a href="{{ route('admin.editar')}}" name="btn-deletar" class="btn red"> Cancelar </a></td>
                @endforeach
            </tbody>
        </table>
        <br>

        <div class="card-panel teal lighten-3"><center>
            <a href="{{ route('admin.painel')}}" class="waves-effect waves-light btn-large indigo">VOLTAR PARA O PAINEL DE CONTROLE</a>
            <a href="{{ route('admin.editar')}}" class="waves-effect waves-light btn-large orange">VOLTAR PARA A LISTA DE FUNCIONÁRIOS</a>
            <a href="{{ route('admin.deslog')}}" class="waves-effect waves-light btn-large red">DESLOGAR</a>
        </div></center><center>
            
<!-- caso ocorra algum erro na rota 'login.auth' a mensagem de erro será exibida na tela com o comando abaixo -->
<font name="mensagem" id="mensagem">
    @if($mensagem = Session::get('erro'))
        {{ $mensagem }}
    @endif
    
    @if($errors->any())
        @foreach($errors->all() as $erro)
        {{ $erro }} <br>
        @endforeach
    @endif
    <br></font>
</form>
</div>




<!-- Finaliza sessão de conteudo -->
@endsection

<!-- Se usuário não tiver permissão para acessar essa tela, redirecionar para painel de controle -->
@else
{{ $redirecionamento = route('admin.painel') }}
@php header("location: $redirecionamento"); @endphp 
@endif
<!-- Se não existir usuário logado, fazer redirecionamento para tela de login -->
@else
{{ $redirecionamento = route('login.form') }}
@php header("location: $redirecionamento"); @endphp 
@endauth