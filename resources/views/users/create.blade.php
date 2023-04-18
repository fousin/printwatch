@extends('layouts.app')

@section('title', "Criar Usuario")

@section('content')
    <h1>Novo Usuario</h1>

    @if($errors->any())
        <ul class="errors">
            @foreach ($errors->all() as $error)
                <li class="error">{{$error}}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{route('users.store')}}" method="post">
        @include('users._partials.form')
        <button type="submit" class="btn btn-success mt-3">Cadastrar</button>
    </form>
@endsection