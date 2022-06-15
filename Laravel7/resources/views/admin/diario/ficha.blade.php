@extends('adminlte::page')

@section('content_header')
<h1>Ficha do Diario</h1>
@stop

@section('content')
<div class="visible-print">
	<img src="/logo.jpg" />
</div>
<div class="box box-solid box-footer" >
	<h3>1. DADOS DE IDENTIFICAÇÃO DA TURMA</h3>
	<div class="box box-solid box-footer" >
		<div class="form-group col-sm-12">
			<label class="control-label col-lg-1" for='diario_nome'>Nome:</label>
			<span class="col-lg-2"><?php echo $diario[0]->nome; ?></span>

			<label class="control-label col-lg-1" for='ano'>ANO:</label>
			<span class="col-lg-2"><?php echo $diario[0]->ano; ?></span>

			<label class="control-label col-lg-1" for='periodo'>Período:</label>
			<span class="col-lg-2">
			<?php
					if ($diario[0]->periodo == 'M')
						echo 'Matutino';
					if ($diario[0]->periodo == 'V')
						echo 'Vespertino';
					if ($diario[0]->periodo == 'E')
						echo 'Extendido';
					if ($diario[0]->periodo == 'I')
						echo 'Integral';
					
			?>
			</span>
		</div>
	</div>

	<h3>2. PROFESSORES</h3>
<div class="box box-solid box-footer" >
		<div class="form-group col-sm-12">
			
			
			
		</div>
	</div>
	
	<h3>3. ALUNOS</h3>
<div class="box box-solid box-footer" >
		<div class="form-group col-sm-12">
			
			
			
		</div>
	</div>	
	
	<h3>4. OUTRAS INFORMAÇÕES</h3>
	<div class="box box-solid box-footer" >
		
		<div class="form-group col-sm-12">	
			<label class="control-label col-lg-2" for='observacoes'>Observações:</label>
			<span class="col-lg-10"><?php echo $diario[0]->observacoes; ?></span>
		</div>
		
	</div>

</div>


@stop