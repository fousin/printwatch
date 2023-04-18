@extends('layouts.app')

@section('title', 'Lista de Impressoras')

@section('content')
    @include('includes.search-printer-label')
    <div class="row">
        <div class="col-12 row">
            @foreach ($configs as $config)
            <div class="col-4">
                
                <form action="{{route('configs.update', $config->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="comunity" class="form-control">Comunidade: 
                            <input class="form-control" type="text" name="comunity" value="{{$config->comunity? $config->comunity : '' }}">
                        </label>
                    </div>
                    
                    <div class="form-group">
                        <label for="version" class="form-control">Versão SNMP: 
                            <input class="form-control" type="text" name="version" value="{{$config->version}}">
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
                
            </div>
            <div class="col-4">
                <a href="{{route('marcas.index')}}">Marcas e Modelos</a>
                <br>
                <a href="{{route('oids.index')}}">OIDS</a>
            </div>
        </div>
        @endforeach
    </div>
@endsection