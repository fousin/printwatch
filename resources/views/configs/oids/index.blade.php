@extends('layouts.app')

@section('title', 'OIDS')

@section('content')
    <h1>OIDS</h1>
    <hr>
    
    <table class="table"> 
        <table>
            <th>Marca</th>
        
            @foreach ($allMarcas as $marca)
            <tr>
                <td class="list-unstyled text-capitalize">{{$marca->marca}} </td>
                <td> | </td>
                <td><a href="{{route('oids.edit',$marca->id)}}" class="btn btn-sm btn-primary" > Editar Oids</a></td>
            </tr>
                
            @endforeach
        </table>
        
    </table>
@endsection