@extends('layouts.app')

@section('content')
<div class="container">

    <!--Enviar mensaje de guardado o modificacion-->
    @if(Session::has('Mensaje'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('Mensaje') }}
    </div>
    @endif

    <a href="{{ url('expedientes/create') }}" class="btn btn-success">Agregar Expediente</a>
    <br><br>
    <table class="table table-light table-hover table-responsive-sm table-responsive-md">

        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Prefijo</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($expediente as $exped)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$exped->prefijo}}</td>
                    <td>{{$exped->nombre}}</td>
                    <td>
                        @can('expedientes.edit')
                        <a href="{{ url('/expedientes/'.$exped->id.'/edit') }}" class="btn btn-warning">
                            Editar
                        </a>
                        @endcan

                        @can('expedientes.destroy')
                        <form method="post" action="{{ url('/expedientes/'.$exped->id) }}" style="display:inline">
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

    {{ $expediente->links() }}

</div>
@endsection
