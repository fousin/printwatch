@if(isset($errorMessage))
    <div class="alert alert-danger">{{ $errorMessage }}</div>
@endif

@if ($errors->any())
    <ul class='list-unstyled'>
        @foreach ($errors->all() as $error)
            <li class="alert alert-danger">{{$error}}</li>
        @endforeach
    </ul>
@endif