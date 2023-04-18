@extends('layouts.app')

@section('title', 'Editar Modelos')

@section('content')

<div class="row">
    <div class="col-12 ">
        @include('includes.validations-form')
        <form action="{{route('marcas.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-6">
                    <label for="marca" class="form-control">Marca:
                        <input type="text" name="marca" placeholder="Marca" class="form-control text-lowercase"  @required(true) >
                    </label>

                    <label for="modelo" class="form-control">Modelo:
                        <input type="text" name="modelo" placeholder="Modelo" class="form-control text-lowercase">
                    </label>
                </div>

                <div class="col-6">
                    <div class="mb-3 form-control">
                        <h5>Tipo do Toner de impressão</h5>
                        <label for="toner" style="margin: 0 15px ;">4 Toners (Colorido)
                            <input type="radio" name="toner" id="" value="color" checked>
                        </label>

                        <label for="toner">1 Toner (Monocromático)
                            <input type="radio" name="toner" id="" value="mono">
                        </label>
                    </div>
                    
                    <div class="mb-3 form-control">
                        <h5>Tipo de Toner de imagem</h5>
                        <label for="imagem"  style="margin: 0 15px ;">Tambor de Imagem
                            <input type="radio" name="imagem" id="" value="tambor" checked>
                        </label>

                        <label for="imagem">Unidade de Imagem
                            <input type="radio" name="imagem" id="" value="unidade">
                        </label>
                    </div>

                </div>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</div>

@endsection