@extends('layouts.app')

@section('title', 'Listagem dos usuarios')

@section('content')
    
    <div class="d-flex justify-content-end">
        <div class="col-4 m-2" >
            <form action="{{route('users.index')}}" method="get">
                <div class="input-group">
                    <input class="form-control" type="text" name="search" placeholder="Pesquisar">
                    <button class="form-control" >Pesquisar</button>
                </div>
            </form>
        </div>
    </div>

    <h1>lista dos usuarios 
        (<a href="{{route('users.create')}}" class="text-decoration-none">+</a>)
    </h1>

    <div class="row d-flex justify-content-center mt-3">
        <div class="col-8">
            <table class="table">
                <thead>
                    
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Email</th>
                    <th>Outros</th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>         
                            <td>{{$user->name}}</td>
                            <td>{{$user->sobrenome}}</td>
                            <td>{{$user->email}}</td>
                            <td><a href="{{ route('users.show', $user->id) }}">Detalhes</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            
        </div>
    </div>


@endsection