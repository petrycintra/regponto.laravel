@auth  <!-- Se já existir usuário logado, fazer redirecionamento para o painel de controle -->
{{ $redirecionamento = route('admin.painel') }}
<?php header("location: $redirecionamento"); ?>  


@else                                        <!-- Se não existir usuário logado, exibir pagina de login abaixo -->
@extends('layout')                           <!-- Importar configurações do Framework Front-End Materialize.Css -->
@section('title', 'LOGIN CONTROLE DE PONTO') <!-- Titulo da Página -->
@section('conteudo')                         <!-- Inicia a sessão d conteúdo da página -->


<br>
<div class="row">
	<div class="col s12 m6 push-m3">
        <div class="card-panel teal lighten-2">
        <h5 class="light center"> CONTROLE DE PONTO </h5>
    </div>
    
    <!-- Inicio do formulario onde é inserido email e senha para a rota 'login.auth' com metodo 'post' -->
    <form action="{{ route('login.auth')}}" method="POST">
        @csrf

        <div class="input-field col s6">
            <input name="email" placeholder ="SEU EMAIL" id="email" type="email" class="validate">
            <label for="email">Email</label>
        </div>

        <div class="input-field col s6">
            <input name="password" placeholder ="SUA SENHA" id="password" type="password" class="validate">
            <label for="password">Senha</label>
        </div><br><br><br><br>
        <div class="card-panel teal lighten-2 Center">
        <button type="submit" class="btn" name="btn-login"> Fazer Login </button>
        </div>

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
@endauth
