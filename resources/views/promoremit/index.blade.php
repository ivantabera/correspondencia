@extends('layouts.app')

@section('content')
<div class="container">

    <!--Enviar mensaje de guardado o modificacion-->
    @if(Session::has('Mensaje'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('Mensaje') }}
    </div>
    @endif

    <a href="{{ url('promoremit/create') }}" class="btn btn-success">Agregar Promotor/Remitente</a>
    <br><br>
    <table class="table table-light table-hover table-responsive-sm table-responsive-md">

        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Alias</th>
                <th>Nombre</th>
                <th>Encargado</th>
                <th>Cargo</th>
                <th>Tipo</th>
                <th>Extensión</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($promoremit as $promorem)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$promorem->alias}}</td>
                    <td>{{$promorem->nombre}}</td>
                    <td>{{$promorem->encargado}}</td>
                    <td>{{$promorem->cargo}}</td>
                    <td>{{$promorem->tipo}}</td>
                    <td>{{$promorem->extension}}</td>
                    <td>
                        @can('promoremit.edit')
                        <a href="{{ url('/promoremit/'.$promorem->id.'/edit') }}" class="btn btn-warning">
                            Editar
                        </a>
                        @endcan

                        @can('promoremit.destroy')
                        <form method="post" action="{{ url('/promoremit/'.$promorem->id) }}" style="display:inline">
                            {{ csrf_field() }} <!--token para que nos permita acceder-->
                            {{ method_field('DELETE') }} <!--metodo que vamos a ejecutar-->
                            <button type="submit" onclick="return confirm('¿Borrar?')" class="btn btn-danger">Borrar</button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    {{ $promoremit->links() }}

</div>
@endsection
