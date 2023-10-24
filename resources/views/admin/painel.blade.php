@extends('layout')                           <!-- Importar configurações do Framework Front-End Materialize.Css -->
@section('title', 'LOGIN CONTROLE DE PONTO') <!-- Titulo da Página -->
@section('conteudo')                         <!-- Inicia a sessão d conteúdo da página -->
@auth                                        <!-- Verifica se usuário está logado, caso sim, exibe o painel de controle abaixo -->
<div class="row">
    
	<div class="col s12 m6 push-m3 center" >
        <div class="collection">

            <!-- Exibe o nome completo do usuário atualmente logado -->
            <a class="collection-item">Bem-vindo, {{ Auth::user()->name }}, Esse é seu painel de controle</a>
          </div>
        <div class="card-panel teal lighten-2" id='botoes'>
            
             <!-- Redireciona os botões do menu do painel de controle para suas respectivas rotas -->
            <a href="{{ route('admin.ponto')}}" class="waves-effect waves-light btn-large blue">REGISTRAR MEU PONTO</a>
            <a href="editarmeusdados/{{Auth::User()->id}}" class="waves-effect waves-light btn-large orange">EDITAR MEUS DADOS</a>
            <!-- Se usário logado pertencer à uma função(position) administrativa, exibir botão de editar funcionários -->
            <!-- Se não pertencer, botão será ignorado e não será exibido na tela -->
            @if (Auth::user()->position === 'Gerente' || Auth::user()->position === "Gestao-RH")
            <a href="{{ route('admin.editar') }}" class="waves-effect waves-light btn-large indigo">VISUALIZAR FUNCIONÁRIOS</a>
            @endif
            <a href="{{ route('admin.deslog') }}" class="waves-effect waves-light btn-large red">DESLOGAR</a>
        </div>
    </div>

<!-- Finaliza sessão de conteudo -->
@endsection

<!-- Codigo css para personalização do menu de rotas -->
<style>
    #botoes{
        display:flex;
        columns: row;
        justify-content: space-between;
     }
</style>

<!-- Se não existir usuário logado, fazer redirecionamento para tela de login -->
@else
{{ $redirecionamento = route('login.form') }}
<?php header("location: $redirecionamento"); ?>
@endauth