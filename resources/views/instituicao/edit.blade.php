@extends('templates.master')

@section('conteudo-view')

    @if(session('success'))
        <h3>{{ session('success')['messages'] }}</h3>
    @endif

    {!! Form::model($inst, ['route' => ['instituicao.update', $inst->id], 'method' => 'put', 'class' => 'form-padrao']) !!}
        @include('templates.formulario.input', ['label' => 'Nome', 'input' => 'name', 'attributes' => ['placeholder' => 'Nome']])
        @include('templates.formulario.submit', ['input' => 'Atualizar'])
    {!! Form::close() !!}

@endsection