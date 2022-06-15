@extends('adminlte::page')

@section('content_header')
<h1>Listar Animais</h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($parto as $parto)
    <tr>
        <td class="text-left">{{ $parto->nome }}</td>
        <td class="text-left">{{ date( 'd/m/Y' , strtotime($parto->dataparto)) }}</td>
        <td class="text-left">{{ $parto->acompanhante }}</td>
        <td class="text-center">
            @if ($parto->status_parto == 'V')
            <span class="fas fa-horse" style="color: blue" > Vivo </span>
            @else
            <span class="fas fa-horse" style="color: red" > Morto </span>
            @endif

            @if ($parto->status_parto == "M")
            <a href="/parto/ativar/{{ $parto->id }}" title='Ativa o Parto'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @endif
            @if ($parto->status_parto == 'V')
            <a href="/parto/bloquear/{{ $parto->id }}" title='Bloqueia o Parto'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop