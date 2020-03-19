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
        @can('turno.crear')
        <form method="post" action="{{ url('/turno/create') }}" class="formCrear" style="display:inline">
            {{ csrf_field() }} <!--token para que nos permita acceder-->
            {{ method_field('GET') }} <!--metodo que vamos a ejecutar-->
            <input type="hidden" name="idCorrespondencia" class="idCorrespondencia" value="{{$folio}}">
            <button type="submit"  class="btn btn-success">Crear Turno</button>
        </form>
        @endcan()

    </nav>

    <br><br>

    <table class="table table-light table-hover table-responsive-sm table-responsive-md">

        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Numero de Oficio</th>
                <th>Fecha de Turno</th>
                <th>Turnado a</th>
                <th>Fecha de Compromiso</th>
                <th>Turnado por</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($turno as $correspon)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$correspon->oficio}}</td>
                    <td>{{$correspon->fecha_turno}}</td>
                    <td>{{$correspon->turnado_a}}</td>
                    <td>{{$correspon->compromiso_date}}</td>
                    <td>{{$correspon->turnado_por}}</td>
                    <td>
                        @can('correspondencia.edit')
                        <a href="{{ url('/correspondencia/'.$correspon->id.'/edit') }}" class="btn btn-warning">
                            Editar
                        </a>
                        @endcan()
                        
                        {{-- Formulario que cambia de status --}}
                        @can('turno.status')
                        <form method="post" action="{{ url('/turno/status/'.$correspon->id) }}" class="formStatus" style="display:inline">
                            {{ csrf_field() }} <!--token para que nos permita acceder-->
                            {{ method_field('PUT') }} <!--metodo que vamos a ejecutar-->
                            <button 
                                type="submit" 
                                onclick="event.preventDefault();
                                    Swal.fire({
                                    title: '¿Deseas borrar este registro de turno?',
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

    {{ $turno->links() }}

</div>

@endsection
