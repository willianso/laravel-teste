@extends('templates.master')

@section('conteudo-view')

    @if(session('success'))
        <h3>{{ session('success')['messages'] }}</h3>
    @endif

<table class="default-table">
		<thead>
			<tr>
				<td>Data</td>
				<td>Tipo</td>
				<td>Produto</td>
				<td>Grupo</td>
				<td>Valor</td>
			</tr>
		</thead>
		<tbody>
			@foreach($movement_list as $i)
			<tr>
				<td>{{ $i->created_at }}</td>
				<td>{{ $i->type == 1 ? "Aplicação" : "Resgate" }}</td>
				<td>{{ $i->product->name }}</td>
				<td>{{ $i->group->name }}</td>
				<td>{{ $i->value }}</td>
			</tr>
			@endforeach
		</tbody>
</table>
@endsection