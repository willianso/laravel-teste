@extends('templates.master')

@section('conteudo-view')

    @if(session('success'))
        <h3>{{ session('success')['messages'] }}</h3>
    @endif

    {!! Form::open(['route' => 'group.store', 'method' => 'post', 'class' => 'form-padrao']) !!}
        @include('templates.formulario.input', ['label' => 'Nome', 'input' => 'name', 'attributes' => ['placeholder' => 'Nome']])
        @include('templates.formulario.select', ['label' => 'User id', 'select' => 'user_id', 'data' => $usuarios ,'attributes' => ['placeholder' => 'User id']])
        @include('templates.formulario.select', ['label' => 'Inst id', 'select' => 'instituicao_id','data' => $inst, 'attributes' => ['placeholder' => 'Inst id']])
        @include('templates.formulario.submit', ['input' => 'Cadastrar'])
    {!! Form::close() !!}

	<table class="default-table">
			<thead>
				<tr>
					<td>#</td>
					<td>Grupo</td>
					<td>Instituição</td>
					<td>Usuário</td>
					<td>Opções</td>
				</tr>
			</thead>
			<tbody>
				@foreach($groups as $g)
				<tr>
					<td>{{ $g->id }}</td>
					<td>{{ $g->name }}</td>
					<td>{{ $g->user_id }}</td>
					<td>{{ $g->instituicao_id }}</td>
					<td>
						{!! Form::open(['route' => ['group.destroy', $g->id], 'method' => 'DELETE']) !!}
							{!! Form::submit('Remover') !!}
						{!! Form::close() !!}
						<a href="{{ route('group.edit', $g->id) }}">Editar</a>
					</td>
				</tr>
				@endforeach
			</tbody>
	</table>
@endsection