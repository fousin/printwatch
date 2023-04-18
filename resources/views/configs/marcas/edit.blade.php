@extends('layouts.app')

@section('title', 'Editar Modelos')

@section('content')

<div class="row">
    <div class="">
        @include('includes.validations-form')
        <form action="{{route('modelo.update',[$marca, $modelo->id])}}" method="post"><div class="form-group">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-6">
                    <label for="marca" class="form-control">Marca:
                        <select name="marca" id="" @required(true) class="form-control text-capitalize">
                            <option value="">Opções</option>
                            
                            @foreach($marcas as $marc)
                            
                                @if ("$marca->marca" == "$marc->marca")
                                    <option value="{{$marc->marca}}" selected>{{$marc->marca}} </option>
                                @else
                                    <option value="{{$marc->marca}}">{{$marc->marca}}</option>
                                @endif
                            
                            @endforeach
                        </select>
                        
                    </label>

                    <label for="modelo" class="form-control">Modelo:
                        <input value="{{$modelo->modelo}}" type="text" name="modelo" placeholder="Modelo" class="form-control text-lowercase">
                    </label>
                </div>
        
                <div class="col-6">
                    <div class="mb-3 form-control">
                        <h5>Tipo de Toner</h5>
                        <label for="toner" style="margin: 0 15px ;">4 Toners (Colorido)
                            @if($modelo->toner=='color')
                                <input type="radio" name="toner" id="" value="color" checked>
                            @else
                                <input type="radio" name="toner" id="" value="color">
                            @endif
                        </label>

                        <label for="toner">1 Toner (Monocromático)
                            @if($modelo->toner=='mono')
                                <input type="radio" name="toner" id="" value="mono" checked>
                            @else
                                <input type="radio" name="toner" id="" value="mono">
                            @endif
                        </label>
                    </div>
                    
                    <div class="mb-3 form-control">
                        <h5>Tipo de Toner de imagem</h5>

                        <label for="imagem" style="margin: 0 15px ;">Tambor de Imagem
                            @if($modelo->imagem=='tambor')
                                <input type="radio" name="imagem" id="" value="tambor" checked>
                            @else
                                <input type="radio" name="imagem" id="" value="tambor">
                            @endif
                            
                        </label>

                        <label for="imagem" >Unidade de Imagem
                            @if($modelo->imagem=='unidade')
                                <input type="radio" name="imagem" id="" value="unidade" checked>
                            @else
                                <input type="radio" name="imagem" id="" value="unidade" >
                            @endif
                        </label>

                        
                    </div>

                </div>

            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
</div>


@endsection