@extends('layouts.app')

@section('title', "Editar o Usuario $user->name")

@section('content')
    <h1>Editar o Usuario {{$user->name}}</h1>

    @if($errors->any())
        <ul class="errors">
            @foreach ($errors->all() as $error)
                <li class="error">{{$error}}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{route('users.update',$user->id)}}" method="post">
        @method('put')
        @csrf
        <div>
            <label for="name">Nome: </label>
            <input type="text" name="name" placeholder="Nome: " value="{{ $user->name}}" class="form-control">
        </div>
        <div>
            <label for="sobrenome">Sobrenome: </label>
            <input type="text" name="sobrenome" placeholder="Sobrenome: " value="{{ $user->sobrenome}}" class="form-control">
        </div>

        <div>
            <label for="email">E-mail: </label>
            <input type="email" name="email" placeholder="E-mail: " value="{{ $user->email}}" class="form-control">
        </div>

        <div>
            <label for="password">Senha: </label>
            <input type="password" name="password" placeholder="Senha: " class="form-control">
        </div>

        <button type="submit" class="btn btn-success mt-3">Enviar</button>
    </form>
@endsection