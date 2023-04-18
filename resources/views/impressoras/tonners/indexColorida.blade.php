@extends('layouts.app')
@section('title', "toners da impressora {$printer->name}")

@section('content')
<h1>toners da impressora {{$printer->name}}</h1>


<table class="table-striped table mb-5 text-center ">
    <tbody>
        @foreach($tonners as $tonner)
            <tr>
                <td>{{$tonner->cor}}</td>
                <td id="barra{{$tonner->cor}}">####</td>
                <td>{{$tonner->capAtual}}</td>
                <td>{{$tonner->capMax}}</td>
                <td>0</td>
            </tr>  
        @endforeach  
    </tbody>
</table>
@endsection 
