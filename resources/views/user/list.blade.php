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
        @foreach($user_list as $u)
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