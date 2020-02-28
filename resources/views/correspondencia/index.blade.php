@extends('layouts.app')

@section('content')
<div class="container">

    <!--Enviar mensaje de guardado o modificacion-->
    @if(Session::has('Mensaje'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('Mensaje') }}
    </div>
    @endif
    
    <nav class="navbar navbar-light bg-light">
        <!--Boton agregar correspondencia-->
        @can('correspondencia.create')
        <a href="{{ url('correspondencia/create') }}" class="btn btn-success">Agregar Correspondencia</a>
        @endcan()

        <!--Formulario de busqueda-->
        {!! Form::open(['method' => 'GET', 'class' => 'form-inline pull-rigth']) !!}
            <div class="form-group">
                <input type="text" name="num_entrada" class="form-control mr-sm-2" placeholder="Numero de entrada" value="{{ request('num_entrada')}}">
            </div>
            <div class="form-group">
                <input type="text" name="asunto" class="form-control mr-sm-2" placeholder="Asunto" value="{{ request('asunto')}}">
            </div>
            <div class="form-group">
                <input type="text" name="referencia" class="form-control mr-sm-2" placeholder="Referencia" value="{{ request('referencia')}}">
            </div>
            <div class="form-group">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                
            </div>
        {!! Form::close() !!}
    </nav>

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
                    <td>SDGM20-00{{$correspon->num_entrada}}</td>
                    <td>{{$correspon->referencia}}</td>
                    <td>{{$correspon->promotor}}</td>
                    <td>{{$correspon->dirigido}}</td>
                    <td>{{$correspon->particular}}</td>
                    <td>{{$correspon->asunto}}</td>
                    <td>
                        <img src="{{ asset('storage').'/'.$correspon->foto}}" class="img-thumbnail img-fluid" alt="" width="50">
                    </td>
                    <td>
                        @can('correspondencia.edit')
                        <a href="{{ url('/correspondencia/'.$correspon->id.'/edit') }}" class="btn btn-warning">
                            Editar
                        </a>
                        @endcan()
                        
                        {{-- Formulario que cambia de status --}}
                        @can('correspondencia.status')
                        <form method="post" action="{{ url('/correspondencia/status/'.$correspon->id) }}" class="formStatus" style="display:inline">
                            {{ csrf_field() }} <!--token para que nos permita acceder-->
                            {{ method_field('PUT') }} <!--metodo que vamos a ejecutar-->
                            <button 
                                type="submit" 
                                onclick="event.preventDefault();
                                    Swal.fire({
                                    title: '¿Deseas borrar este registro de correspondencia?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Aceptar',
                                    cancelButtonText: 'Cancelar'
                                    }).then((result) => {
                                    if (result.value) {
                                        submit();
                                    } 
                                    }); " 
                                class="btn btn-danger changestatus" >
                                Borrar
                            </button>
                        </form>
                        @endcan()
                        {{-- PARTE DEL FORMULARIO QUE ELIMINA
                        @can('correspondencia.destroy')
                        <form method="post" action="{{ url('/correspondencia/'.$correspon->id) }}" class="formBorrar" style="display:inline">
                            {{ csrf_field() }} <!--token para que nos permita acceder-->
                            {{ method_field('DELETE') }} <!--metodo que vamos a ejecutar-->
                            <button type="submit"  class="btn btn-danger borrar">Borrar</button>
                        </form>
                        @endcan() 
                        --}}
                        @can('correspondencia.pdf')
                        <a href="{{ url('/imprimir/'.$correspon->id) }}" class="btn btn-primary pdf" target="_blank">
                            PDF
                        </a>
                        @endcan()
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    {{ $correspondencia->links() }}

</div>

@endsection
