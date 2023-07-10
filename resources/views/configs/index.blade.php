@extends('layouts.app')

@section('title', 'Lista de Impressoras')

@section('content')
    @include('includes.search-printer-label')
    <div class="row">
        <div class="col-12 row">
           
           
            <div class="col-8">
                
                <form action="{{route('configs.update', $configs[0]->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="comunity" class="form-control">Comunidade: 
                            <input class="form-control" type="text" name="comunity" value="{{$configs[0]->comunity? $configs[0]->comunity : '' }}">
                        </label>
                    </div>
                    
                    <div class="form-group">
                        <label for="version" class="form-control">Versão SNMP: 
                            <input class="form-control" type="text" name="version" value="{{$configs[0]->version}}">
                        </label>
                    </div>
                    
                    <div class="form-group"> Alertas:
                        <label for="version" class="form-control">Critico: 
                            <input class="form-control" type="text" name="critico" value="{{$configs[0]->critico}}">
                        </label>
                        <label for="version" class="form-control">Emergencia: 
                            <input class="form-control" type="text" name="emergencia" value="{{$configs[0]->emergencia}}">
                        </label>
                        <label for="version" class="form-control">Aviso: 
                            <input class="form-control" type="text" name="aviso" value="{{$configs[0]->aviso}}">
                        </label>
                        <label for="version" class="form-control">Saudavel: 
                            <input class="form-control" type="text" name="saudavel" value="{{$configs[0]->saudavel}}">
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
        
    </div>
@endsection