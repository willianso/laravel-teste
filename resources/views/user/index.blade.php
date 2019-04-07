@extends('templates.master')

@section('css-view')
@endsection

@section('js-view')
@endsection

@section('conteudo-view')

    @if(session('success'))
        <h3>{{ session('success')['messages'] }}</h3>
    @endif

    {!! Form::open(['route' => 'user.store', 'method' => 'post', 'class' => 'form-padrao']) !!}
        @include('templates.formulario.input', ['label' => 'CPF', 'input' => 'cpf', 'attributes' => ['placeholder' => 'CPF']])
        @include('templates.formulario.input', ['label' => 'Nome', 'input' => 'name', 'attributes' => ['placeholder' => 'Nome']])
        @include('templates.formulario.input', ['label' => 'Telefone', 'input' => 'phone', 'attributes' => ['placeholder' => 'Telefone']])
        @include('templates.formulario.input', ['label' => 'E-mail', 'input' => 'email', 'attributes' => ['placeholder' => 'E-mail']])
        @include('templates.formulario.input', ['label' => 'Senha', 'input' => 'senha', 'attributes' => ['placeholder' => 'Senha']])
        @include('templates.formulario.submit', ['input' => 'Cadastrar'])
    {!! Form::close() !!}


    <table class="default-table">
		<thead>
			<tr>
				<td>#</td>
				<td>CPF</td>
				<td>Nome</td>
				<td>Telefone</td>
				<td>Nascimento</td>
				<td>E-mail</td>
				<td>Status</td>
				<td>Permissão</td>
				<td>Menu</td>
			</tr>
		</thead>
		<tbody>
			@foreach($usuario as $u)
			<tr>
				<td>{{ $u->id }}</td>
				<td>{{ $u->cpf }}</td>
				<td>{{ $u->name }}</td>
				<td>{{ $u->phone }}</td>
				<td>{{ $u->birth }}</td>
				<td>{{ $u->email }}</td>
				<td>{{ $u->status }}</td>
				<td>{{ $u->permission }}</td>
				<td>
					{!! Form::open(['route' => ['user.destroy', $u->id], 'method' => 'DELETE']) !!}
						{!! Form::submit('Remover') !!}
					{!! Form::close() !!}
					<a href="{{ route('user.edit', $u->id) }}">Editar</a>
				</td>
			</tr>
			@endforeach
		</tbody>
</table>

@endsection
