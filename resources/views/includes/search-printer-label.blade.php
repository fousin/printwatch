
<div class="d-flex justify-content-end">
    <div class="col-4 m-2" >
        <form action="{{route('impressoras.index')}}" method="get">
            <div class="input-group">
                <input class="form-control" type="text" name="search" placeholder="Nome, IP ou Matricula">
                <button class="form-control">Pesquisar</button>
            </div>
        </form>
    </div>
</div>