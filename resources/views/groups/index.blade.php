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

	@include('groups.list', ['groups_list' => $groups])
@endsection