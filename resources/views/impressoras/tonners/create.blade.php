@extends('layouts.app')

@section('title', "toners da impressora {$printer->name}")

@section('content')
<h1>toners da impressora {{$printer->name}}</h1>

@include('includes.validations-form')

<form action="{{route('tonners.store', $printer->id)}}" method="post">
    @include('impressoras.tonners._partials.form')
</form>

@endsection 
