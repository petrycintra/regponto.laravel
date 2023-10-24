@extends('layout')                           <!-- Importar configurações do Framework Front-End Materialize.Css -->
@section('title', 'ADICIONAR/EDITAR FUNCIONÁRIO') <!-- Titulo da Página -->
@section('conteudo')                         <!-- Inicia a sessão d conteúdo da página -->
@auth                                        <!-- Verifica se usuário está logado, para para a proxima verificação -->

<div class="row">
    
    <div class="col s12 m6 push-m3 ">
        <div class="collection center">

            <!-- Exibe o nome completo do usuário atualmente logado -->
            <a class="collection-item"> {{ Auth::user()->name }}, Esse é a pagina onde você pode fazer qualquer alteração no funcionário selecionado anteriormente</a>
        </div>
        <div class="card-panel teal lighten-2">
            <h5 class="light center">EDITAR DADOS DO FUNCIONÁRIO SELECIONADO</h5>
        </div>
        
        <form action="{{ route('admin.editarmeusdadosesalvar')}}" method="POST">
            @csrf
        <table class="striped">
            <tbody>
                @foreach($funcionarios as $funcionario)
                <input type="hidden" name="id" value="{{ $funcionario->id }}" id="id" type="text" class="validate">
                    <div class="input-field col s6">
                        <input name="name" value="{{ $funcionario->name }}" id="name" type="text" class="validate">
                        <label for="name">Nome</label>
                    </div>
                    <div class="input-field col s6">
                        <input name="email" value="{{ $funcionario->email }}" id="nome" type="email" class="validate">
                        <label for="email">Email</label>
                    </div>

                    <div class="input-field col s6">
                        <input name="password" value="" id="password" type="password" class="validate">
                        <label for="password">Senha</label>
                    </div>

                    <div class="input-field col s6">
                        <input name="position" value="{{ $funcionario->position }}" id="position" type="text" class="validate" disabled>
                        <label for="position">Cargo Atual</label>
                    </div>
                    <div><center>
                        @if (Auth::user()->position == "Gerente" || Auth::user()->position == "Gestao-RH")
                        <label>
                            <input type="radio" value="Gerente" name="position" class="filled-in" @if($funcionario->position == 'Gerente' ) checked="checked" @else @endif />
                            <span>Gerente</span>
                        </label>
                        <label>
                            <input type="radio" value="Jornalista" name="position" class="filled-in" @if($funcionario->position == 'Jornalista' ) checked="checked" @else @endif />
                            <span>Jornalista</span>
                        </label>
                        <label>
                            <input type="radio" value="Gestao-RH" name="position" class="filled-in" @if($funcionario->position == 'Gestao-RH' ) checked="checked" @else @endif />
                            <span>Gestao-RH</span>
                        </label>
                        <label>
                            <input type="radio" value="Mascote" name="position" class="filled-in" @if($funcionario->position == 'Mascote' ) checked="checked" @else @endif />
                            <span>Mascote</span>
                        </label>
    
                        @else
    
                        <label>
                            <input type="radio" value="Gerente" name="position" class="filled-in" @if($funcionario->position == 'Gerente' ) checked="checked" @else @endif disabled/>
                            <span>Gerente</span>
                        </label>
                        <label>
                            <input type="radio" value="Jornalista" name="position" class="filled-in" @if($funcionario->position == 'Jornalista' ) checked="checked" @else @endif disabled/>
                            <span>Jornalista</span>
                        </label>
                        <label>
                            <input type="radio" value="Gestao-RH" name="position" class="filled-in" @if($funcionario->position == 'Gestao-RH' ) checked="checked" @else @endif disabled/>
                            <span>Gestao-RH</span>
                        </label>
                        <label>
                            <input type="radio" value="Mascote" name="position" class="filled-in" @if($funcionario->position == 'Mascote' ) checked="checked" @else @endif disabled/>
                            <span>Mascote</span>
                        </label>
                        @endif
                    </div></center>
                @endforeach
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


<!-- Se não existir usuário logado, fazer redirecionamento para tela de login -->
@else
{{ $redirecionamento = route('login.form') }}
@php header("location: $redirecionamento"); @endphp 
@endauth