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
                            @if ($printer->marca==$marca->marca)

                                <div class="col-sm-12 col-md-6 col-lg-4 text-center ">
                                    <table class="table-striped table mb-5 text-center ">
                                        
                                        <a href="{{ route('impressoras.show', $printer->id) }}" class="btn {{$styles[$printer->name]}} ">
                                            {{$printer->name}} 
                                        </a>
                                        <tr>
                                            <th scope="col">Toner</th>
                                            <th scope="col">barra</th>
                                            <th scope="col">(%)</th>
                                            <th scope="col"> Alert</th>
                                            
                                        </tr>
                                        @foreach ($printer->tonners as $tonner)
                                            <tr>
                                                <td >{{$tonner->cor}}</td>
                                                <td id="{{$printer->name.$tonner->cor}}">{{$tonner->volumeAtual}}</td>
                                                <td >0</td>
                                                <td >####</td>
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
