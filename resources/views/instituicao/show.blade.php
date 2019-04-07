@extends('templates.master')

@section('conteudo-view')

    <header>
        <h1>{{ $inst->name }}</h1>
    </header>

	@include('groups.list', ['groups_list' => $inst->groups])
@endsection