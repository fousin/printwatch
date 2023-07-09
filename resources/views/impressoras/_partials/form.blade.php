@csrf

<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" name="nome" placeholder="DPT_XXXX" value="{{ $printer->nome ?? old('nome')}}" class="form-control" class="text-uppercase">
</div>

<div class="form-group">
    <label for="ip">IP:</label>
    <input type="text" name="ip" placeholder="10.96.96.96" value="{{ $printer->ip ?? old('ip')}}" class="form-control">
</div>

<div class="form-group">
    <label for="marca">Marca:</label>
    <select name="marca" id="marca" class="form-control">
        <option value="">Opções</option>
        
        @foreach ($marcas as $marca)
            @isset($printer)
                @if($printer->marca == $marca->marca)
                    <option value="{{$marca->marca}}" id="{{$marca->marca}}" class="text-capitalize" selected>{{$marca->marca}}</option>
                @endif
                
            @endisset
            <option value="{{$marca->marca}}" id="{{$marca->marca}}" class="text-capitalize">{{$marca->marca}}</option>
            
        @endforeach

    </select>
    
</div>

<div class="form-group">
    <label for="modelo">Modelo: </label>
    <select name="modelo" id="modelo" class="form-control ">
        <option value="">Opções</option>

        @foreach ($marcas as $marca)
            
            @isset($printer)
                @foreach($marca->modelos as $modelo)
                    @if($printer->modelo == "$modelo->modelo")
                        <option value="{{$modelo->modelo}}" id="{{$modelo->modelo}}" selected>{{$modelo->modelo}}</option>
                    @else
                        <option value="{{$modelo->modelo}}" id="{{$modelo->modelo}}" >{{$modelo->modelo}}</option>
                    @endif
                @endforeach
            @endisset

            @if(isset($printer)==null) 
                @foreach($marca->modelos as $modelo)
                    <option value="{{$modelo->modelo}}" id="{{$modelo->modelo}}" >{{$modelo->modelo}}</option>
                @endforeach
            @endif
            
        @endforeach
        
    </select>
</div>

<div class="form-group">
    <label for="matricula">Matrícula: </label>
    <input type="text" name="matricula" placeholder="123456" value="{{$printer->matricula?? old('matricula')}}" class="form-control text-uppercase">
</div>
