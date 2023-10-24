@extends('layout')                           <!-- Importar configurações do Framework Front-End Materialize.Css -->
@section('title', 'ADICIONAR/EDITAR FUNCIONÁRIO') <!-- Titulo da Página -->
@section('conteudo')                         <!-- Inicia a sessão d conteúdo da página -->
@auth                                        <!-- Verifica se usuário está logado, para para a proxima verificação -->
@if (Auth::user()->position == "Gerente" || Auth::user()->position == "Gestao-RH") <!-- Verifica se usuário logado tem permissão para acessar essa página, caso sim, exibe o painel de controle abaixo -->

<div class="row">
    
    <div class="col s12 m6 push-m3 ">
        <div class="collection center">

            <!-- Exibe o nome completo do usuário atualmente logado -->
            <a class="collection-item"> {{ Auth::user()->name }}, Esse é a pagina onde você pode inserir os dados de um novo funcionário</a>
        </div>
        <div class="card-panel teal lighten-2">
            <h5 class="light center">ADICIONAR NOVO FUNCIONÁRIO</h5>
        </div>
        
        <form action="{{ route('admin.adicionaresalvar')}}" method="POST">
            @csrf
        <table class="striped">
            <tbody>
                    <div class="input-field col s6">
                        <input name="name" id="name" type="text" class="validate">
                        <label for="name">Nome</label>
                    </div>
                    <div class="input-field col s6">
                        <input name="email" id="nome" type="email" class="validate">
                        <label for="email">Email</label>
                    </div>

                    <div class="input-field col s6">
                        <input name="password" id="password" type="password" class="validate">
                        <label for="password">Senha</label>
                    </div>

                    <div class="input-field col s6">
                        <input name="position" id="position" type="text" class="validate" disabled>
                        <label for="position">Cargo Atual</label>
                    </div>
                    <div><center>
                    <label>
                        <input type="radio" name="position" class="filled-in" value="Gerente"/>
                        <span>Gerente</span>
                    </label>
                    <label>
                        <input type="radio" name="position" class="filled-in" value="Jornalista"/>
                        <span>Jornalista</span>
                    </label>
                    <label>
                        <input type="radio" name="position" class="filled-in" value="Gestao-RH"/>
                        <span>Gestao-RH</span>
                    </label>
                    <label>
                        <input type="radio" name="position" class="filled-in" value="Mascote"/>
                        <span>Mascote</span>
                    </label>
                    </div></center>
            </tbody>
        </table>
        <br>
        <div class="card-panel teal lighten-3"><center>
            <button type="submit" class="btn blue" name="btn-login"> SALVAR </button>
        </form>
            <a href="{{ route('admin.editar')}}" class="waves-effect waves-light btn red">CANCELAR</a>
            </div>

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