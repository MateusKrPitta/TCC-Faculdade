@extends('adminlte::page')

@section('content_header')
<h1>Realizar ligações</h1>
@stop

@section('content')

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="text-center">Nome</th>
            <th class="text-center">Telefone 1</th>
            <th class="text-center">Telefone 2</th>
            <th class="text-center">Telefonista</th>
            <th class="text-center">Descrição da Conversa</th>
            <th class="text-center">Último Contato</th>
            <th class="text-center">Status</th>
            <th class="text-center" colspan="4">Ações</th>
        </tr>
    </thead>
    <tbody>

        @forelse($clientes as $cliente)
        <tr>
            <td class="text-center">{{$cliente->nome}}</td>
            <td class="text-center">{{$cliente->tel1}}</td>
            <td class="text-center">{{$cliente->tel2}}</td>
            <td class="text-center">{{$cliente->nomeusuario}}</td>
            <td class="text-left">{{$cliente->descricao}}</td>
            <td class="text-center">{{ implode('/', array_reverse(explode('-', substr($cliente->data, 0, -9)))) }}</td>
            <td class="text-center">
                @if ($cliente->status == '')
                <a title="Aguardando Ligação"><span class="fas fa-hourglass-half" aria-hidden="true"></span></a>
                @endif
                @if ($cliente->status == '1')
                <a title="Aguardando Ligação"><span class="fas fa-hourglass-half" aria-hidden="true"></span></a>
                @endif
                @if ($cliente->status == '0')
                <a title="Ligação em Andamento"><span class="fas fa-phone-square-alt" aria-hidden="true"></span></a>
                @endif
            </td>
            <td class="text-center">

                <a href="/telemarketingtransporte/cadastrar1/{{$cliente->cliente_id }}" title='Realizar ligação'>
                    <span style="color:green" class="fas fa-phone" aria-hidden="true"></span>
                </a>

            </td>

        </tr>

        @empty
        <tr>
        </tr>
        @endforelse
    </tbody>
</table>


@stop