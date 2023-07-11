@extends('layouts.app')

@section('title', 'Lista de Impressoras')

@section('content')
    @include('includes.search-printer-label')

    <div class="row">
        @foreach($marcas as $marca)
            @if(count($marca->modelos)>0)
                <div class="display-4 ml-3 p-3">
                    <span class="text-uppercase">{{$marca->marca}}</span>
                </div>

                <div class="d-inline col-12 d-flex"> 
                    <div class="col-12 row" >
                        @foreach($printers as $printer)
                            @if ($printer->marca_id==$marca->id)
                                <div class="col-sm-12 col-md-6 col-lg-4 text-center ">
                                    <table class="table-striped table mb-5 text-center ">
                                        
                                        <a href="{{ route('impressoras.show', $printer->id) }}" class="btn btn-{{$statusPrinter[$printer->nome]}}">
                                            {{$printer->nome}} 
                                        </a>

                                        <tr>
                                            <th scope="col">Toner</th>
                                            <th scope="col">Volume Atual(%)</th>
                                            <th scope="col"> Alerta</th>
                                        </tr>
                                        @foreach ($printer->toners as $toner)
                                            <tr>
                                                <td class="text-capitalize">{{$toner->cor}}</td>
                                                <td > 
                                                    <img src="{{ asset('barras/barra'.$toner->cor.'.gif') }}" height="12px" width="{{$toner->volumeAtual}}" style="float: left;"> {{$toner->volumeAtual}}
                                                </td>
                                                <td >0</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

            @endif
        @endforeach
        
    </div>
    
@endsection
