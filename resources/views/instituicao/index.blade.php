@extends('templates.master')

@section('conteudo-view')

    @if(session('success'))
        <h3>{{ session('success')['messages'] }}</h3>
    @endif

    {!! Form::open(['route' => 'instituicao.store', 'method' => 'post', 'class' => 'form-padrao']) !!}
        @include('templates.formulario.input', ['label' => 'Nome', 'input' => 'name', 'attributes' => ['placeholder' => 'Nome']])
        @include('templates.formulario.submit', ['input' => 'Cadastrar'])
    {!! Form::close() !!}

<table class="default-table">
		<thead>
			<tr>
				<td>#</td>
				<td>Instituição</td>
				<td>Opções</td>
			</tr>
		</thead>
		<tbody>
			@foreach($inst as $i)
			<tr>
				<td>{{ $i->id }}</td>
				<td>{{ $i->name }}</td>
				<td>
					{!! Form::open(['route' => ['instituicao.destroy', $i->id], 'method' => 'DELETE']) !!}
						{!! Form::submit('Remover') !!}
					{!! Form::close() !!}
					<a href="{{ route('instituicao.show', $i->id) }}">Detalhes</a>
					<a href="{{ route('instituicao.edit', $i->id) }}">Editar</a>
					<a href="{{ route('instituicao.product.index', $i->id) }}">Produtos</a>
				</td>
			</tr>
			@endforeach
		</tbody>
</table>
@endsection