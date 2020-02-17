@extends('layouts.app')

@section('content')
<div class="container">

    <!--Enviar mensaje de guardado o modificacion-->
    @if(Session::has('Mensaje'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('Mensaje') }}
    </div>
    @endif

    <a href="{{ url('dirigido/create') }}" class="btn btn-success">Agregar Dirigido</a>
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
            @foreach($dirigido as $dirigi)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$dirigi->nombre}}</td>
                    <td>{{$dirigi->cargo}}</td>
                    <td>
                        @can('dirigido.edit ')
                        <a href="{{ url('/dirigido/'.$dirigi->id.'/edit') }}" class="btn btn-warning">
                            Editar
                        </a>
                        @endcan

                        @can('dirigido.destroy')
                        <form method="post" action="{{ url('/dirigido/'.$dirigi->id) }}" style="display:inline">
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

    {{ $dirigido->links() }}

</div>
@endsection
