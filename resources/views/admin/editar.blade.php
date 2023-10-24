@extends('layout')                           <!-- Importar configurações do Framework Front-End Materialize.Css -->
@section('title', 'ADICIONAR/EDITAR FUNCIONÁRIO') <!-- Titulo da Página -->
@section('conteudo')                         <!-- Inicia a sessão d conteúdo da página -->
@auth                                        <!-- Verifica se usuário está logado, caso sim, exibe o painel de controle abaixo -->
@if (Auth::user()->position == "Gerente" || Auth::user()->position == "Gestao-RH") <!-- Verifica se usuário logado tem permissão para acessar essa página, caso sim, exibe o painel de controle abaixo -->

<div class="row">
    
    <div class="col s12 m6 push-m3 ">
        <div class="collection center">

            <!-- Exibe o nome completo do usuário atualmente logado -->
            <a class="collection-item"> {{ Auth::user()->name }}, Esse é a pagina onde você pode visualizar os funcionários atualmente ativos</a>
        </div>
        <div class="card-panel teal lighten-2">
            <h5 class="light center">TELA DE EXIBIÇÃO DE FUNCIONÁRIOS</h5>
        </div>
        
        <table class="striped">
            <thead>
                <tr>
                <th>Nome</th>
                <th>Função/Cargo</th>
                <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($funcionarios as $funcionario)
                <tr>
                    <td> {{ $funcionario->name }} </td>
                    <td> {{ $funcionario->position }} </td>
                    <td> {{ $funcionario->email }} </td>
                    <td><a href="editardados/{{$funcionario->id}}"   name="btn-editar" class="btn orange" > Editar</a></td>
                    <td><a href="inativardados/{{$funcionario->id}}"{{$funcionario->id}}" name="btn-deletar" class="btn red"> Inativar </a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>

        <div class="card-panel teal lighten-3"><center>
            <a href="{{ route('admin.adicionar')}}" class="waves-effect waves-light btn-large blue">NOVO FUNCIONÁRIO</a>
            <a href="{{ route('admin.painel')}}" class="waves-effect waves-light btn-large indigo">VOLTAR PARA O PAINEL</a>
            <a href="{{ route('admin.verpontos')}}" class="waves-effect waves-light btn-large purple">VER PONTOS</a>
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