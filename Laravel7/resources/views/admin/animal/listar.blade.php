@extends('adminlte::page')

@section('content_header')
<h1>Listar Animais</h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($animals as $animal)
    <tr @if ($animal->status == "0")  "style=\"color:gray\"" @endif>
        <td class="text-left"><a href="/animal/ficha/{{$animal->id }}" title='Ficha do Animal'>{{$animal->nome}}</a></td>
        <td class="text-left">{{$animal->numero}}</td>
        <td class="text-left">{{$animal->pai}}</td>
        <td class="text-left">{{$animal->mae}}</td>
        <td class="text-left">{{implode('/', array_reverse(explode('-', $animal->nascimento)))}}</td>
        <td class="text-left">{{$animal->sexo}}</td>
        <td class="text-center">
            @if ($animal->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif</td>
        <td class="text-center">
            @if ($animal->sexo == "F" && $animal->status == "1")
            <a href="/inseminacao/cadastrar/{{ $animal->id }}" title='Realizar Inseminação no Animal'>
                <span style="color:blue" class="fas fa-tint" aria-hidden="true"></span>
            </a>
            @else 
            <span style="color:gray" class="fas fa-tint" aria-hidden="true"></span>
            @endif
            <a href="/animal/editar/{{$animal->id}}"title='Editar as Informações do Animal'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($animal->status == "0")
            <a href="/animal/ativar/{{$animal->id}}" title='Ativa o Animal'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/animal/bloquear/{{$animal->id}}" title='Bloqueia o Animal'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/animal/apagar/{{$animal->id}}" title='Apaga o Animal'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop