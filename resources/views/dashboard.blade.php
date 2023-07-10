@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<hr>
<div class="row mt-4 d-flex justify-content-center">
    <div class="col-9 row ">
        <div class="col-4 d-flex justify-content-center">
            <a href="{{route('impressoras.index')}}" class="text-center text-decoration-none">
                <img src="https://cdn-icons-png.flaticon.com/512/4020/4020167.png" alt="" class="h-50 w-50">
                <br>
                <h3 class="text-dark">Impressoras</h3>
            </a>
        </div>

        <div class="col-4 d-flex justify-content-center">
            <a href="{{route('users.index')}}" class="text-center text-decoration-none">
                <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="" class="h-50 w-50">
                <br>
                <h3 class="text-dark">Usuarios</h3>
            </a>
        </div>

        <div class="col-4 d-flex justify-content-center">
            <a href="{{route('configs.index')}}" class="text-center text-decoration-none">
                <img src="https://cdn-icons-png.flaticon.com/512/170/170237.png" alt="" class="h-50 w-50">
                <br>
                <h3 class="text-dark">Configurações</h3>
            </a>
        </div>
    </div>  
</div>

@endsection