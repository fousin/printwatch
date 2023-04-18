@extends('layouts.app')

@section('title', 'Nova Impressora')

@section('content')

<div class="p-3">
    <div>
        
        @include('includes.validations-form')

        <form action="{{route('impressoras.store')}}" method="post" id="cadastro" >
            
            @include('impressoras._partials.form')
            
            <button type="submit" onfocus="defineToner()" class="btn btn-primary mt-3">Cadastrar</button>
        </form>
    </div> 
</div>
@endsection