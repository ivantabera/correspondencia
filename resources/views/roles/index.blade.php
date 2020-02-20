@extends('layouts.app')

@section('content')
<div class="container">

    <!--Enviar mensaje de guardado o modificacion-->
    @if(Session::has('Mensaje'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('Mensaje') }}
    </div>
    @endif
    
        <!--Boton agregar correspondencia-->
        @can('roles.create')
        <a href="{{ url('roles/create') }}" class="btn btn-success">Agregar Rol</a>
        @endcan()


    <br><br>

    <table class="table table-light table-hover table-responsive-sm table-responsive-md">

        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Permiso</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($roles as $rol)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$rol->name}}</td>
                    <td>{{$rol->slug}}</td>
                    <td>{{$rol->description}}</td>
                    <td>
                        @can('roles.edit')
                        <a href="{{ url('/roles/'.$rol->id.'/edit') }}" class="btn btn-warning">
                            Editar
                        </a>
                        @endcan()
                        @can('roles.destroy')
                        <form method="post" action="{{ url('/roles/'.$rol->id) }}" style="display:inline">
                            {{ csrf_field() }} <!--token para que nos permita acceder-->
                            {{ method_field('DELETE') }} <!--metodo que vamos a ejecutar-->
                            <button type="submit" onclick="return confirm('¿Borrar?')" class="btn btn-danger">Borrar</button>
                        </form>
                        @endcan()
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    {{ $roles->links() }}

</div>

<script type="application/javascript">

</script>

@endsection
