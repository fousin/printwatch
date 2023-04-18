@csrf

<div>
    <label for="name">Nome: </label>
    <input type="text" name="name" placeholder="EX: Anderson" value="{{ $user->name ?? old('name')}}" class="form-control">
</div>

<div>
    <label for="sobrenome">Sobrenome: </label>
    <input type="text" name="sobrenome" placeholder="EX: Sales " value="{{ $user->sobrenome ?? old('sobrenome')}}" class="form-control">
</div>

<div>
    <label for="email">E-mail: </label>
    <input type="email" name="email" placeholder="EX: andersoncarlos@hotmail.com" value="{{ $user->email ?? old('email')}}" class="form-control">
</div>

<div>
    <label for="password">Senha: </label>
    <input type="password" name="password" placeholder="Senha: " class="form-control">
</div>