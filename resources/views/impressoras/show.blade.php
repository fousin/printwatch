@extends('layouts.app')

@section('title', 'Detalhes da impressora')

@section('content')

<div class="d-flex justify-content-center p-4">
    <div class="w-50 d-inline">
        <table class="table ">
            <th class="">Detalhes da Impressora {{$printer->name}}</th>
            <tr>
                <td>Id: </td>
                <td>{{$printer ->id}}</td>
            </tr>
            <tr>
                <td>Nome: </td>
                <td>{{$printer ->name}}</td>
            </tr>
            <tr>
                <td>IP:</td>
                <td><a href="http://{{$printer->ip}}" target="_blank">{{$printer ->ip}}</a></td>
            </tr>
            
            <tr>
                <td>Marca/Modelo:</td>
                <td>{{$printer ->marca}} | {{$printer ->modelo}}</td>
            </tr>

            <tr>
                <td>Tipo:</td>
                <td>{{$printer ->toner}}</td>
            </tr>
            <tr>
                <td>Matricula:</td>
                <td>{{$printer ->matricula}}</td>
            </tr>
        </table>

    </div>
    
</div>
<div class="d-flex justify-content-center">
    <a href="{{ route('impressoras.edit', $printer->id) }}" class="btn btn-primary mr-3 btn-lg">Editar</a>
    <form action="{{route('impressoras.delete',$printer->id)}}" method="post" class="">
        @method('DELETE')
        @csrf
        <button class="btn btn-lg btn-danger ml-3 mr-3">Deletar</button>
    </form>    
    <a href="{{ route('tonners.indexColorida', $printer->id) }}" class="btn btn-success ml-3 btn-lg">
        Toners
    </a>
</div>



@endsection