@extends('layouts.app')

@section('title', 'Listagem do usuario')

@section('content')
    <h1>Detalhes do Usuario {{$user->name}}</h1>
    <div class="row d-flex justify-content-center mt-3">
        <div class="col-8">
            <table class="table">
                <thead>
                    <th>ID</th> 
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Email</th>
                    
                </thead>
                <tbody>
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->sobrenome}}</td>
                        <td>{{$user->email}}</td>

                    </tr>
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary ">Editar</a>
                <form action="{{route('users.delete',$user->id)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger ">Deletar</button>
                </form>
            </div>
        </div>
    </div>
@endsection