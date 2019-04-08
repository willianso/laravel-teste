<table class="default-table">
        <thead>
            <tr>
                <td>#</td>
                <td>Grupo</td>
                <td>Investimentos</td>
                <td>Instituição</td>
                <td>Usuário</td>
                <td>Opções</td>
            </tr>
        </thead>
        <tbody>
            @foreach($groups_list as $g)
            <tr>
                <td>{{ $g->id }}</td>
                <td>{{ $g->name }}</td>
                <td>{{ $g->total_value }}</td>
                <td>{{ $g->instituicao->name }}</td>
                <td>{{ $g->owner->name }}</td>
                <td>
                    {!! Form::open(['route' => ['group.destroy', $g->id], 'method' => 'DELETE']) !!}
                        {!! Form::submit('Remover') !!}
                    {!! Form::close() !!}
                    <a href="{{ route('group.show', $g->id) }}">Detalhes</a>
                    <a href="{{ route('group.edit', $g->id) }}">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
</table>