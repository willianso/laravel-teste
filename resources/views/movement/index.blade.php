@extends('templates.master')

@section('conteudo-view')

    @if(session('success'))
        <h3>{{ session('success')['messages'] }}</h3>
    @endif

<table class="default-table">
		<thead>
			<tr>
				<td>Produto</td>
				<td>Instituição</td>
				<td>Valor investido</td>
			</tr>
		</thead>
		<tbody>
			@foreach($product_list as $i)
			<tr>
				<td>{{ $i->name }}</td>
				<td>{{ $i->instituicao->name ?? '' }}</td>
				<td>{{ $i->valueFromUser(Auth::user()) }}</td>
			</tr>
			@endforeach
		</tbody>
</table>
@endsection