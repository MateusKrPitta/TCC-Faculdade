@extends('adminlte::page')

@section('content_header')
<h1>Listar Consultas de Cartão Realizadas </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons>
    @foreach($consultas as $linha)
    <tr>
        @foreach($linha as $celula)
        <td>{!! $celula !!}</td>
        @endforeach
    </tr>
    @endforeach
</x-adminlte-datatable>

@stop