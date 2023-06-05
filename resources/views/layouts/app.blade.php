<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    
    <!-- Importando o arquivo CSS do Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Importando o arquivo JavaScript do Bootstrap -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    
    <style>
        *{
        margin: 0;
        padding: 0;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif
        }
        body{
            background:#f3f3f3;
            min-width: 570px;
        }
        .container{
            background-color: #fff;
            -webkit-box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.75);
            -moz-box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.75);
            box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.75);
            padding: 0 3em 0 3em;
        }
    </style>
    <script>
        function recarregaPagina() {
            setTimeout(function() {
                location.reload();
            }, 300000); // 300000 milissegundos = 5 minutos
        }

        // Chama a função pela primeira vez para iniciar a contagem de 10 minutos
        recarregaPagina();
    </script>
</head>
<body >
    <div class="container ">
        <div class="row text-center">
            <div class="col-1 mt-4">
                <a href="{{route('dashboard')}}" >
                    <img src="https://cdn-icons-png.flaticon.com/512/59/59098.png" alt="" class="h-50 w-50" >
                </a>
            </div>
            <div class="display-4 col-3 mt-3">
                <a href="{{route('impressoras.index')}}" class="text-dark text-decoration-none"><span>PrintWatch</span></a>
            </div>  
            <div class="col-4 mt-4">
                <span class="btn btn-sm btn-dark"> Critico </span>
                <span class="btn btn-sm btn-danger"> Emergencia </span> 
                <span class="btn btn-sm btn-warning"> Alerta </span>
                <span class="btn btn-sm btn-success"> saudável </span>  
            </div>
            <div class="col-3 mt-4">
                <a href="{{route('impressoras.create')}}" class="btn btn-primary">Cadastrar Impressora</a>
            </div>
            <div class="col-1 mt-4">
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger">Sair</button>
                </form>
            </div>
            
        </div>
        
        <div class="">
            @yield('content')
        </div>
        <footer class="">
            <hr>
            <div class="pb-3 ">
                <div class="row ml-auto">
                    <div class="col-sm-12 col-md-9">
                        <h5>Anderson Carlos Soluções &copy;</h5>
                        <h6><em>Programando o amanhã</em></h6>
                    </div>
        
                    <div class="col-sm-12 col-md-3 ml-auto">
                        <a href="https://www.facebook.com/anderson.carlos.s.j" class="btn btn-outline-dark btn-sm " target="_blank">FB</a>
                        <a href="https://www.instagram.com/f.ousin/" class="btn btn-outline-dark btn-sm" target="_blank">Insta</a>
                        <a href="https://fousin.github.io/Apresentacao/" class="btn btn-outline-dark btn-sm" target="_blank">GitHub</a>
                    </div>
                    
                </div>
            </div>
        </footer>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>