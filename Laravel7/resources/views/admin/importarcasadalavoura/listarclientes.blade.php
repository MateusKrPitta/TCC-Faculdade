@extends('adminlte::page')

@section('content_header')
<h1>Listar Clientes </h1>
@stop

@section('content')

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="text-center">Nome</th>
            <th class="text-center">Razão Social</th>
            <th class="text-center">CPF / CNPJ</th>
            <th class="text-center">RG / Inscrição Estadual</th>
            <th class="text-center">Data de Nascimento/Abertura</th>
            <th class="text-center">Status</th>
            <th class="text-center" colspan="3">Ações</th>
        </tr>
    </thead>
    <tbody>
		@forelse ($cliente as $cliente): ?>
			<tr>
				<td class="text-center">{{ $cliente->FANT_TRA }}</td>
				<td class="text-center">{{ $cliente->RAZA_TRA }}</td>
				<td class="text-center">{{ $cliente->CGC_TRA }}</td>
				<td class="text-center">{{ $cliente->INES_TRA }}</td>
				<td class="text-center">{{ implode('/', array_reverse(explode('-', $cliente->nascimento)))}}</td>
				<td class="text-center">
					@if ($cliente->status == 1)
						<span class="fas fa-check-square" aria-hidden="true"></span>
					@else
						<span class="fas fa-ban" aria-hidden="true"></span>
                                        @endif
				</td>
				<td>
					<a href="/cliente/editar/{{ $cliente->id }}" title='Editar as Informações do Cliente'>
						<span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
					</a>
				</td>
				<td>
					@if ($cliente->status == "0") { ?> 
						<a href="/cliente/ativar/{{ $cliente->id }}" title='Ativa o Cliente'>
							<span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
						</a>
					@else
						<a href="/cliente/bloquear/{{ $cliente->id }}" title='Bloqueia o Cliente'>
							<span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
						</a>
					@endif
				</td>
				<td>
					<a href="/cliente/apagar/{{ $cliente->id }}" title='Apaga o Cliente'>
						<span style="color:red" class="fas fa-ban-circle" aria-hidden="true"></span>
					</a>
				</td>
				
			</tr>
                        @empty
		@endforelse
    </tbody>
</table>




@stop