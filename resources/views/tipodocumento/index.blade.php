@extends('layouts.app')

@section('content')
<div class="container">

    <!--Enviar mensaje de guardado o modificacion-->
    @if(Session::has('Mensaje'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('Mensaje') }}
    </div>
    @endif

    @can('tipodocumento.create')
    <a href="{{ url('tipodocumento/create') }}" class="btn btn-success">Agregar Tipo Documento</a>
    @endcan
    
    <br><br>
    <table class="table table-light table-hover table-responsive-sm table-responsive-md">

        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($tipodocumento as $tipodoc)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$tipodoc->nombre}}</td>
                    <td>
                        @can('tipodocumento.edit')
                        <a href="{{ url('/tipodocumento/'.$tipodoc->id.'/edit') }}" class="btn btn-warning">
                            Editar
                        </a>
                        @endcan
                        
                        @can('tipodocumento.destroy')
                        <form method="post" action="{{ url('/tipodocumento/'.$tipodoc->id) }}" style="display:inline">
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

    {{ $tipodocumento->links() }}

</div>
@endsection
