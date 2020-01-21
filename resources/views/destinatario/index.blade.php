@extends('layouts.app')

@section('content')
<div class="container">

    <!--Enviar mensaje de guardado o modificacion-->
    @if(Session::has('Mensaje'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('Mensaje') }}
    </div>
    @endif

    <a href="{{ url('destinatario/create') }}" class="btn btn-success">Agregar Destinatario</a>
    <br><br>
    <table class="table table-light table-hover table-responsive-sm table-responsive-md">

        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Cargo</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($destinatario as $destinat)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$destinat->nombre}}</td>
                    <td>{{$destinat->cargo}}</td>
                    <td>
                        <a href="{{ url('/destinatario/'.$destinat->id.'/edit') }}" class="btn btn-warning">
                            Editar
                        </a>
                        <form method="post" action="{{ url('/destinatario/'.$destinat->id) }}" style="display:inline">
                            {{ csrf_field() }} <!--token para que nos permita acceder-->
                            {{ method_field('DELETE') }} <!--metodo que vamos a ejecutar-->
                            <button type="submit" onclick="return confirm('¿Borrar?')" class="btn btn-danger">Borrar</button>

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    {{ $destinatario->links() }}

</div>
@endsection
