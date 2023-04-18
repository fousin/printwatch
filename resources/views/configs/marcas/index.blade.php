@extends('layouts.app')

@section('title', 'Marcas e Modelos')

@section('content')
    @include('includes.search-printer-label')
    <h1>Marcas e Modelos<a href="{{route('marcas.create')}}" class="text-decoration-none"> (+)</a></h1>
    <div class="row">
        <div class="col-4">
            <table class="table"> 
                @foreach ($marcas as $marca)
                    <th class="text-capitalize">
                        <div class="d-flex">
                            <span class="btn ">{{$marca->marca}}</span> 
                            <form action="{{route('marcas.delete',$marca->id)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger"> - </button>
                            </form>
                        </div>
                    </th>
                    <tbody>
                        @foreach ($marca->modelos as $modelo)
                            <tr>
                                <td class="text-capitalize " >{{$modelo->modelo}}</td>
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-sm btn-primary" href="{{route('marcas.edit',[$marca, $modelo->id])}}">Editar</a>
                                        <form action="{{route('modelo.delete',[$marca, $modelo->id])}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Deletar</button>
                                        </form>
                                    </div>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>

@endsection