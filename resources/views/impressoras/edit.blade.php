@extends('layouts.app')

@section('title', "Editar Impressora {$printer->name}")

@section('content')

<h3>Editar Impressora {{ $printer->name}} - {{$printer->modelo}}</h3>

<div class="p-3">
    <div>
        @include('includes.validations-form')
        
        <form action="{{ route('impressoras.update', $printer->id) }}" method="post">
            @method('PUT')

            @include('impressoras._partials.form')
        
            <button type="submit" onfocus="defineToner()" class="btn btn-success mt-3">Atualizar</button>
        </form>
    </div>
</div>


@endsection