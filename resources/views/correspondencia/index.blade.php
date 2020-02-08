@extends('layouts.app')

@section('content')
<div class="container">

    <!--Enviar mensaje de guardado o modificacion-->
    @if(Session::has('Mensaje'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('Mensaje') }}
    </div>
    @endif

    <div class="col-lg-3">
        <div class="input-group">
        <input type="text" class="form-control" id="textobuscador" placeholder="Ingresa numero...">
        <span class="input-group-btn">
            <button class="btn btn-default" type="button">Buscar</button>
        </span>
        </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->

    <div id="resultados">
        @if(count($correspondencia))
            @foreach ($correspondencia as $item)
                <p class="p-2 border-bottom">{{$item->num_entrada.'-'.$item->referencia}}</p>
            @endforeach
        @endif
    </div>

    <a href="{{ url('correspondencia/create') }}" class="btn btn-success">Agregar Correspondencia</a>
    <br><br>
    <table class="table table-light table-hover table-responsive-sm table-responsive-md">

        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Numero de Entrada</th>
                <th>Referencia</th>
                <th>Promotor</th>
                <th>Dirigido</th>
                <th>Particular</th>
                <th>Asunto</th>
                <th>Foto</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($correspondencia as $correspon)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$correspon->num_entrada}}</td>
                    <td>{{$correspon->referencia}}</td>
                    <td>{{$correspon->promotor}}</td>
                    <td>{{$correspon->dirigido}}</td>
                    <td>{{$correspon->particular}}</td>
                    <td>{{$correspon->asunto}}</td>
                    <td>
                        <img src="{{ asset('storage').'/'.$correspon->foto}}" class="img-thumbnail img-fluid" alt="" width="50">
                    </td>
                    <td>
                        <a href="{{ url('/correspondencia/'.$correspon->id.'/edit') }}" class="btn btn-warning">
                            Editar
                        </a>
                        <form method="post" action="{{ url('/correspondencia/'.$correspon->id) }}" style="display:inline">
                            {{ csrf_field() }} <!--token para que nos permita acceder-->
                            {{ method_field('DELETE') }} <!--metodo que vamos a ejecutar-->
                            <button type="submit" onclick="return confirm('¿Borrar?')" class="btn btn-danger">Borrar</button>

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    {{ $correspondencia->links() }}

</div>

<script>
    window.addEventListener("load", function(){
        document.getElementById("textobuscador").addEventListener("keyup", function(){
            fetch(`/correspondencia/buscador?textobuscador=${document.getElementById("textobuscador").value}`,{
                method: 'get'
            })
            .then(response => response.text())
            .then(html => {
                console.log(html);
                //document.getElementById("resultados")innerHtml += html
                //pagina++;
            })
            .catch(error => console.log("error"))
        })
    })
</script>

@endsection
