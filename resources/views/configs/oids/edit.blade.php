@extends('layouts.app')

@section('title', 'OIDS')

@section('content')
    <h1>OIDS</h1>
    <hr>

    @include('includes.validations-form')
    <form action="{{route('oids.update',$marca->id)}}" method="post">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-6">
                <label class="form-control" for="">Toners
                    <label class="form-control" for="" >OID Coloridos:
                        <label class="form-control" for="">Preto: 
                            <input name="oid01" class="form-control" type="text" placeholder="0.0.0.0.0.0.0.0.0" value="{{$oid->oid01??old('oid01')}}">
                        </label>
                        <label class="form-control" for="">Ciano: 
                            <input name="oid02" class="form-control" type="text" placeholder="0.0.0.0.0.0.0.0.0" value="{{$oid->oid02??old('oid02')}}">
                        </label>
                        <label class="form-control" for="">Magenta: 
                            <input name="oid03" class="form-control" type="text" placeholder="0.0.0.0.0.0.0.0.0" value="{{$oid->oid03??old('oid03')}}">
                        </label>
                        <label class="form-control" for="">Amarelo: 
                            <input name="oid04" class="form-control" type="text" placeholder="0.0.0.0.0.0.0.0.0" value="{{$oid->oid04??old('oid04')}}">
                        </label>
                    </label>

                    <label class="form-control" for="">OID monocromático:
                        <input name="oid05" class="form-control" type="text" placeholder="0.0.0.0.0.0.0.0.0" value="{{$oid->oid05??old('oid05')}}">
                    </label>
                </label>

                <label class="form-control" for="">Contador de Página
                    <label class="form-control" for="" >Trabalhos realizados:
                        <input name="oid12" class="form-control" type="text" placeholder="0.0.0.0.0.0.0.0.0" value="{{$oid->oid12??old('oid12')}}">
                    </label>
                </label>

            </div>
            <div class="col-6">
                <label class="form-control" for="">Imagem
                    <label class="form-control" for="" >Tambor de Imagem:
                        <input name="oid06" class="form-control" type="text" placeholder="0.0.0.0.0.0.0.0.0" value="{{$oid->oid06??old('oid06')}}">
                    </label>

                    <label class="form-control" for="">Unidade de Imagem:
                        <input name="oid07" class="form-control" type="text" placeholder="0.0.0.0.0.0.0.0.0" value="{{$oid->oid07??old('oid07')}}">
                    </label>
                </label>



                <label class="form-control" for="">Capacidade maxima
                    <label class="form-control" for="" >Toneres Coloridos:
                        <input name="oid08" class="form-control" type="text" placeholder="0.0.0.0.0.0.0.0.0" value="{{$oid->oid08??old('oid08')}}">
                    </label>

                    <label class="form-control" for="">Toner Monocromático:
                        <input name="oid09" class="form-control" type="text" placeholder="0.0.0.0.0.0.0.0.0" value="{{$oid->oid09??old('oid09')}}">
                    </label>


                    <label class="form-control" for="" >Tambor Colorido:
                        <input name="oid10" class="form-control" type="text" placeholder="0.0.0.0.0.0.0.0.0" value="{{$oid->oid10??old('oid10')}}">
                    </label>

                    <label class="form-control" for="">Unidade de Imagem:
                        <input name="oid11" class="form-control" type="text" placeholder="0.0.0.0.0.0.0.0.0" value="{{$oid->oid11??old('oid11')}}">
                    </label>
                </label>

                

            </div>
        </div>
        <input class="btn btn-success" type="submit" value="Salvar">
    </form>
@endsection