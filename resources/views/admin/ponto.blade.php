@extends('layout')                           <!-- Importar configurações do Framework Front-End Materialize.Css -->
@section('title', 'REGISTRAR SEU PONTO') <!-- Titulo da Página -->
@section('conteudo')                         <!-- Inicia a sessão d conteúdo da página -->
@auth                                        <!-- Verifica se usuário está logado, caso sim, exibe o painel de controle abaixo -->

<div class="row">
    
    <div class="col s12 m6 push-m3 ">
        <div class="collection center">

            <!-- Exibe o nome completo do usuário atualmente logado -->
            <a class="collection-item"> {{ Auth::user()->name }}, Esse é a pagina onde você registra o seu ponto</a>
        </div>
        <div class="card-panel teal lighten-2">
            <h5 class="light center">HISTORICO DO CONTROLE DE PONTO </h5>
        </div>
        
        <table class="striped">
            <thead>
                <tr>
                <th>Data</th>
                <th>Entrada</th>
                <th>Intervalo</th>
                <th>Fim do Intervalo</th>
                <th>Fim do Expediente</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pontos as $ponto)
                <tr>
                    <!-- Exibe os pontos já batidos pelo usuário -->
                    <!-- Data e entrada é obrigatorio para rodar o loop -->
                    <td> {{ date('d/m/Y', strtotime($ponto->data)) }} </td>
                    <td> {{ date('H:i:s', strtotime($ponto->entrada)) }}</td>
                    <!-- Se valor de Intervalo/Volta e Final foram igual a "NULL" não exibe nada na tela -->
                    <!-- Se valor de Intervalo/Volta e Final foram diferentes de "NULL" exibir informação na tela -->
                    <td> @if($ponto->intervalo == null) @else {{ date('H:i:s', strtotime($ponto->intervalo)) }} @endif</td>
                    <td> @if($ponto->volta == null) @else {{ date('H:i:s', strtotime($ponto->volta)) }} @endif</td>
                    <td> @if($ponto->final == null) @else {{ date('H:i:s', strtotime($ponto->final)) }} @endif</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>

        <div class="card-panel teal lighten-3"><center>
        <a href="{{ route('ponto.inicio')}}" class="waves-effect waves-light btn blue">REGISTRAR MEU PONTO</a>
        <a href="{{ route('ponto.intervalo')}}" class="waves-effect waves-light btn orange">INTERVALO</a>
        <a href="{{ route('ponto.voltar')}}" class="waves-effect waves-light btn green">VOLTAR DO INTERVALO</a>
        <a href="{{ route('ponto.final')}}" class="waves-effect waves-light btn black">FINALIZAR EXPEDIENTE</a>
        
        </div></center><center>
        <div class="card-panel teal lighten-4">
            <a href="{{ route('admin.painel')}}" class="waves-effect waves-light btn-large indigo">VOLTAR PARA O PAINEL DE CONTROLE</a>
            <a href="{{ route('admin.deslog')}}" class="waves-effect waves-light btn-large red">DESLOGAR</a>
        </div><center>
            @if($mensagem = Session::get('erro'))
            {{ $mensagem }}
        @endif





<!-- Finaliza sessão de conteudo -->
@endsection

<!-- Se não existir usuário logado, fazer redirecionamento para tela de login -->
@else
{{ $redirecionamento = route('login.form') }}
<?php header("location: $redirecionamento"); ?>
@endauth