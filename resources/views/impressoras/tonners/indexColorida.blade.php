@extends('layouts.app')
@section('title', "toners da impressora {$printer->name}")

@section('content')
<h1>toners da impressora {{$printer->name}}</h1>


<table class="table-striped table mb-5 text-center ">
    <tbody>
        @foreach($toners as $toner)
            <tr>
                <td>{{$toner->cor}}</td>
                <td id="barra{{$tnner->cor}}">####</td>
                <td>{{$toner->volumeAtual}}</td>
            </tr>  
        @endforeach  
    </tbody>
</table>
@endsection 
