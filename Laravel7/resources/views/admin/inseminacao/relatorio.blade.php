@extends('adminlte::page')

@section('content_header')
<h1>Listar Animais</h1>
@stop

@section('content')


<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="text-center">Animal</th>
            <th class="text-center">Data Inseminação</th>
            <th class="text-center">Turno Inseminação</th>
            <th class="text-center">Touro</th>
            <th class="text-center">Inseminador</th>
            <th class="text-center">Data Confirmação</th>
            <th class="text-center">Examinador</th>
            <th class="text-center">Fecundação</th>
            <th class="text-center">Data Parto</th>
            <th class="text-center">Acompanhante</th>
            <th class="text-center">Filhote</th>
        </tr>
    </thead>
    <tbody>
		@forelse ($inseminacao as $inseminacao)
			<tr>
				<td class="text-center"><a href="/inseminacao/ficha/{{ $inseminacao->animal_id }}" title='Ficha do Animal'>{{ $inseminacao->nome }}</a></td>
				<td class="text-center"> @if ($inseminacao->datainseminacao) {{ date('d/m/Y', strtotime($inseminacao->datainseminacao)) }} @endif</td>
				<td class="text-center">{{ $inseminacao->turno}}</td>
				<td class="text-center">{{ $inseminacao->touro}}</td>
				<td class="text-center">{{ $inseminacao->inseminador}}</td>
				<td class="text-center"> @if ($inseminacao->dataconfirmacao) {{ date('d/m/Y', strtotime($inseminacao->dataconfirmacao)) }} @endif</td>
				<td class="text-center">{{  $inseminacao->examinador }}</td>
				<td class="text-center">
					@if ($inseminacao->status_gestacao == '0') <!--Aguardadno-->
						<span style="color:yellow" class="fas fa-clock" aria-hidden="true"></span>
					@endif
                                        @if ($inseminacao->status_gestacao == '1')  <!--Gestando-->
						<span style="color:green" class="fas fa-calendar-check" aria-hidden="true"></span>
					@endif
                                        @if ($inseminacao->status_gestacao == '2')  <!--Não fecundou ou finalizado-->
						<span style="color:red" class="	fas fa-calendar-times" aria-hidden="true"></span>
                                        @endif
					</td>
				<td class="text-center">@if ($inseminacao->dataparto) {{ date('d/m/Y', strtotime($inseminacao->dataparto)) }}@endif</td>
				<td class="text-center">{{ $inseminacao->acompanhante}}</td>
				<td class="text-center"><a href="/inseminacao/ficha/{{ $inseminacao->filhote_id }}" title='Ficha do Animal'>{{ $inseminacao->filhote_id}}</a></td>
			</tr>
                        @empty
		@endforelse
    </tbody>
</table>




@stop