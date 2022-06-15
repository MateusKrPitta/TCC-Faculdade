
<table class="table table-sm table-condensed table-bordered">
    <thead>
        <tr>
            <th class="text-center"><b>Nome</b></th>
            <th class="text-center"><b>Titular</b></th>
            <th class="text-center"><b>Telefone</b></th>
            <th class="text-center"><b>Nascimento</b></th>
            <th class="text-center"><b>Validade</b></th>
            <th class="text-center"><b>Número do Cartão</b></th>

        </tr>
    </thead>
    <tbody>

        @forelse($conveniados as $conveniado)
        <tr>
            <td class="text-left">{{ $conveniado->nome}}</td>
            <td class="text-left">
                @if ($conveniado->titular_id > 0) 
                @forelse($listaconveniados as $lista1)
                @if($lista1->id == $conveniado->titular_id)
                {{ $lista1->nome }} 
                @endif
                @empty
                @endforelse
                @endif
            </td>
            <td class="text-center">{{ $conveniado->tel1}}</td>
            <td class="text-center">{{ implode('/', array_reverse(explode('-', $conveniado->nascimento))) }}</td>
            <td class="text-center">{{ implode('/', array_reverse(explode('-', $conveniado->datadevalidade)))}}</td>
            <td class="text-center">{{ $conveniado->numeronocartao}}</td>
        </tr>

        @empty
        @endforelse
    </tbody>
</table>
