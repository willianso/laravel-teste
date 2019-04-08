@extends('templates.master')

@section('conteudo-view')
<header>
    <h1>{{ $group->name }}</h1>
    <h2>{{ $group->instituicao->name }}</h2>
    {{-- <h2>{{ $group->owner->name }}</h2> --}}
</header>

{!! Form::open(['route' => ['group.user.store', $group->id ], 'method' => 'post', 'class' => 'form-padrao']) !!}
    @include('templates.formulario.select', ['label' => 'Usuario',
     'select' => 'user_id',
     'data' => $user_list, 
     'attributes' => ['placeholder' => 'Instituição']])

    @include('templates.formulario.submit', ['input' => 'Relacionar ao grupo '. $group->name])
{!! Form::close() !!}

@include('user.list', ['user_list' => $group->users])

@endsection
