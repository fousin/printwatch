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
                            <input name="oidTonerPreto" class="form-control" type="text" placeholder="0.0.0.0.0.0.0.0.0" value="{{$oid->oidTonerPreto??old('oidTonerPreto')}}">
                        </label>
                        <label class="form-control" for="">Ciano: 
                            <input name="oidTonerCiano" class="form-control" type="text" placeholder="0.0.0.0.0.0.0.0.0" value="{{$oid->oidTonerCiano??old('oidTonerCiano')}}">
                        </label>
                        <label class="form-control" for="">Magenta: 
                            <input name="oidTonerMagenta" class="form-control" type="text" placeholder="0.0.0.0.0.0.0.0.0" value="{{$oid->oidTonerMagenta??old('oidTonerMagenta')}}">
                        </label>
                        <label class="form-control" for="">Amarelo: 
                            <input name="oidTonerAmarelo" class="form-control" type="text" placeholder="0.0.0.0.0.0.0.0.0" value="{{$oid->oidTonerAmarelo??old('oidTonerAmarelo')}}">
                        </label>
                    </label>

                    <label class="form-control" for="">OID monocromático:
                        <input name="oidTonerMonocromatico" class="form-control" type="text" placeholder="0.0.0.0.0.0.0.0.0" value="{{$oid->oidTonerMonocromatico??old('oidTonerMonocromatico')}}">
                    </label>
                </label>


            </div>
            <div class="col-6">
                <label class="form-control" for="">Imagem
                    <label class="form-control" for="" >Tambor de Imagem:
                        <input name="oidTamborImagem" class="form-control" type="text" placeholder="0.0.0.0.0.0.0.0.0" value="{{$oid->oidTamborImagem??old('oidTamborImagem')}}">
                    </label>

                    <label class="form-control" for="">Unidade de Imagem:
                        <input name="oidUnidadeImagem" class="form-control" type="text" placeholder="0.0.0.0.0.0.0.0.0" value="{{$oid->oidUnidadeImagem??old('oidUnidadeImagem')}}">
                    </label>
                </label>

                <label class="form-control" for="">Contador de Página
                    <label class="form-control" for="" >Trabalhos realizados:
                        <input name="oidContadorPagina" class="form-control" type="text" placeholder="0.0.0.0.0.0.0.0.0" value="{{$oid->oidContadorPagina??old('oidContadorPagina')}}">
                    </label>
                </label>
            </div>
        </div>
        <input class="btn btn-success" type="submit" value="Salvar">
    </form>
@endsection