<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">


    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
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
</head>
<body >
    <div class="container ">
        <div class="row text-center">
            <div class="col-1 mt-4">
                <a href="{{route('dashboard')}}" >
                    <img src="https://cdn-icons-png.flaticon.com/512/59/59098.png" alt="" class="h-50 w-50" >
                </a>
            </div>
            <div class="display-4 col-3 mt-4">
                <a href="{{route('impressoras.index')}}" class="text-dark text-decoration-none"><span>PrintWatch</span></a>
            </div>  

            
        </div>
        <hr>
        <div class="">
            
                <div class="row ">
                    <div class="d-flex justify-content-center">
                        <x-auth-card>
                            <x-slot name="logo"> 
                            </x-slot>


                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />
            
                            @include('includes.validations-form')
            
                            <div class="col-12 ">
                                <form method="POST" action="{{ route('login') }}" >
                                    @csrf
            
                                    <!-- Email Address -->
                                    <div class="form-group">
                                        <x-label for="email" :value="__('Email')" />
                                        <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                                    </div>
            
                                    <!-- Password -->
                                    <div class="mt-4">
                                        <x-label for="password" :value="__('Senha')" />
            
                                        <x-input id="password" class="form-control"
                                                        type="password"
                                                        name="password"
                                                        required autocomplete="current-password" />
                                    </div>
            
                                    <div class="flex items-center justify-end mt-4">
                                        <x-button class="m-4 btn btn-primary">
                                            {{ __('Entrar') }}
                                        </x-button>
                                        
                                        @if (Route::has('password.request'))
                                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                                {{ __('Esqueceu sua senha?') }}
                                            </a>
                                        @endif
                                        
                                    </div>
            
                                    <!-- Remember Me -->
                                    <div class="block mt-4">
                                        <label for="remember_me" class="inline-flex items-center">
                                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                        </label>
                                    </div>
                                    
                                </form>
                            </div>
            
                        </x-auth-card>
                    </div>
                </div>
            
        </div>
        <footer class="">
            <hr>
            <div class="pb-3 ">
                <div class="row ml-auto">
                    <div class="col-sm-12 col-md-9">
                        <h5>Anderson Carlos</h5>
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

