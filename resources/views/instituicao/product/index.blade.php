@extends('templates.master')

@section('conteudo-view')

{!! Form::open(['route' => ['instituicao.product.store', $inst->id], 'method' => 'post', 'class' => 'form-padrao']) !!}
@include('templates.formulario.input', ['label' => 'Nome', 'input' => 'name', 'attributes' => ['placeholder' => 'Nome']])
@include('templates.formulario.input', ['label' => 'Descrição', 'input' => 'description', 'attributes' => ['placeholder' => 'desc']])
@include('templates.formulario.input', ['label' => 'Indexador', 'input' => 'index', 'attributes' => ['placeholder' => 'index']])
@include('templates.formulario.input', ['label' => 'Taxa', 'input' => 'interest_rate', 'attributes' => ['placeholder' => 'Taxa de j']])

@include('templates.formulario.submit', ['input' => 'Cadastrar'])
{!! Form::close() !!}

<table class="default-table">
    <thead>
        <tr>
            <td>#</td>
            <td>Nome</td>
            <td>Descrição</td>
            <td>Indexador</td>
            <td>Taxa</td>
            <td>Opções</td>
        </tr>
    </thead>
    <tbody>
        @forelse($inst->products as $i)
        <tr>
            <td>{{ $i->id }}</td>
            <td>{{ $i->name }}</td>
            <td>{{ $i->description }}</td>
            <td>{{ $i->index }}</td>
            <td>{{ $i->interest_rate }}</td>
            <td>
                {!! Form::open(['route' => ['instituicao.product.destroy', $inst->id, $i->id], 'method' => 'DELETE']) !!}
                    {!! Form::submit('Remover') !!}
                {!! Form::close() !!}
                <a href="">Editar</a>
            </td>
        </tr>
        @empty
            <tr>
                <td>Nada</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection