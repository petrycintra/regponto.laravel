@extends('layout')                           <!-- Importar configurações do Framework Front-End Materialize.Css -->
@section('title', 'LOGIN CONTROLE DE PONTO') <!-- Titulo da Página -->
@section('conteudo')                         <!-- Inicia a sessão d conteúdo da página -->
@auth                                        <!-- Verifica se usuário está logado, caso sim, exibe o painel de controle abaixo -->
@if (Auth::user()->position === 'Gerente' || Auth::user()->position === "Gestao-RH")
<div class="row">
    
    <div class="col s12 m6 push-m3 ">
        <div class="collection center">

            <!-- Exibe o nome completo do usuário atualmente logado -->
            <a class="collection-item"> {{ Auth::user()->name }}, Esse é a pagina onde você pode consultar todos os pontos já registrados de todos os funcionários</a>
        </div>
        <div class="card-panel teal lighten-2">
            <h5 class="light center">HISTORICO DO CONTROLE DE PONTO, POR PADRÃO EXIBE A DATA DE HOJE </h5>
        </div>
            <!-- Exibe o nome completo do usuário atualmente logado -->
            <div class = "row center">
                <form action="{{ route('admin.verpontos_dataselecionada')}}" class = "col s12 center" method="post">
                    @csrf
                    <div class="input-field col s6">
                        <input name="name" placeholder ="NOME DO FUNCIONÁRIO" id="name" type="text" class="validate">
                        <label for="name">Nome</label>
                    </div >
                   <div class = "col s6 center">            <label>SELECIONAR DATA DE PESQUISA</label>              
                      <input name="data" type = "date" class = "datepicker" />    
                   </div><br><br><br><br>
                   <button type="submit" class="waves-effect waves-light btn blue">CONSULTAR</button>   
                </form>

            <!-- Exibe o nome completo do usuário atualmente logado -->
        <table class="striped">
            <thead>
                <tr>
                <th>Nome</th>
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
                    <td> {{ $ponto->name }} </td>
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
        <center>
        <div class="card-panel teal lighten-4">
            <a href="{{ route('admin.painel')}}" class="waves-effect waves-light btn-large indigo">VOLTAR PARA O PAINEL DE CONTROLE</a>
            <a href="{{ route('admin.deslog')}}" class="waves-effect waves-light btn-large red">DESLOGAR</a>
        </div><center>
            @if($mensagem = Session::get('erro'))
            {{ $mensagem }}
        @endif


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
@else
{{ $redirecionamento = route('login.form') }}
@php header("location: $redirecionamento"); @endphp
@endif
<!-- Se não existir usuário logado, fazer redirecionamento para tela de login -->
@else
{{ $redirecionamento = route('login.form') }}
@php header("location: $redirecionamento"); @endphp
@endauth