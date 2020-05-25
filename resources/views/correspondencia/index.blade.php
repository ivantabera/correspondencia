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
                <input type="text" name="referencia" class="form-control mr-sm-2" placeholder="Referencia" value="{{ request('referencia')}}">
            </div>
            <div class="form-group">
                <input type="text" name="asunto" class="form-control mr-sm-2" placeholder="Asunto" value="{{ request('asunto')}}">
            </div>
            <div class="form-group">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                
            </div>
        {!! Form::close() !!}
    </nav>

    <br><br>

    <div id="accordion">
    <!-- correspondencia para turnar -->
    <div class="card">
        <div class="card-header" id="headingOne">
        <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Base de Datos
            </button>
        </h5>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
            
            <table class="table table-light table-hover table-responsive-sm table-responsive-md">

                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Referencia</th>
                        <th>Promotor</th>
                        <th>Asunto</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($correspondencia as $correspon)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$correspon->referencia}}</td>
                            <td>{{$correspon->promotor}}</td>
                            <td>{{$correspon->asunto}}</td>
                            <td>{{$correspon->date_acuse}}</td>
                            <td>
                                @can('correspondencia.edit')
                                <a href="{{ url('/correspondencia/'.$correspon->id.'/edit') }}" class="btn btn-warning btnAccion">
                                    Editar
                                </a>
                                @endcan()

                                <!-- @can('turno.indexturno')
                                <a href="{{ url('/turno/index/'.$correspon->id) }}" class="btn btn-secondary">
                                    Turnar
                                </a>
                                @endcan() -->

                                {{-- @can('turno.crear')
                                <form method="post" action="{{ url('/turno/create') }}" class="formCrear" style="display:inline">
                                    {{ csrf_field() }} <!--token para que nos permita acceder-->
                                    {{ method_field('GET') }} <!--metodo que vamos a ejecutar-->
                                    <input type="hidden" name="idCorrespondencia" class="idCorrespondencia" value="{{$correspon->id}}">
                                    <button type="submit"  class="btn btn-secondary btnAccion">Turnar2</button>
                                </form>
                                @endcan() --}}
                                
                                {{-- Formulario que cambia de status "borrar" --}}
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
                                        class="btn btn-danger changestatus btnAccion" >
                                        Borrar
                                    </button>
                                </form>
                                @endcan()

                                {{-- PARTE DEL FORMULARIO QUE ELIMINA
                                @can('correspondencia.destroy')
                                <form method="post" action="{{ url('/correspondencia/'.$correspon->id) }}" class="formBorrar" style="display:inline">
                                    {{ csrf_field() }} <!--token para que nos permita acceder-->
                                    {{ method_field('DELETE') }} <!--metodo que vamos a ejecutar-->
                                    <button type="submit"  class="btn btn-danger borrar btnAccion">Borrar</button>
                                </form>
                                @endcan() 
                                --}}
                                <!-- @can('correspondencia.pdf')
                                <a href="{{ url('/imprimir/'.$correspon->id) }}" class="btn btn-primary pdf" target="_blank">
                                    PDF
                                </a>
                                @endcan() -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            {{ $correspondencia->links() }}

        </div>
        </div>
    </div>
    <!-- Fin de la correspondencia para turnar -->

    <!-- inicio de correspondencia turnada -->
    <div class="card">
        <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Correspondencia en tramite para baja
            </button>
        </h5>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">

            <table class="table table-light table-hover table-responsive-sm table-responsive-md">

                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Referencia</th>
                        <th>Promotor</th>
                        <th>Asunto</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($correspondenciaTurnados as $correspon)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$correspon->referencia}}</td>
                            <td>{{$correspon->promotor}}</td>
                            <td>{{$correspon->asunto}}</td>
                            <td>{{$correspon->date_acuse}}</td>
                            <td>
                            {{-- Formulario que cambia de status --}}
                                @can('correspondencia.baja')
                                <button type="submit" name="btnBaja" id="btnBaja-{{$correspon->id}}" class="btn btn-danger btnAccion" value="{{$correspon->id}}" onclick="fnBajaCorr(this)">Baja</button>
                                @endcan()

                               <!--  @can('correspondencia.pdf')
                                <a href="{{ url('/imprimir/'.$correspon->id) }}" class="btn btn-primary pdf" target="_blank">
                                    Imprimir
                                </a>
                                @endcan() -->
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            {{ $correspondenciaTurnados->links() }}

        </div>
        </div>
    </div>
    <!-- Fin de la correspondencia turnada -->

    <!-- Correspondencia dada de baja -->
    <div class="card">
        <div class="card-header" id="headingThree">
        <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Correspondencia Turnada y con Baja
            </button>
        </h5>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
        <div class="card-body">
        
            <table class="table table-light table-hover table-responsive-sm table-responsive-md">

                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Referencia</th>
                        <th>Promotor</th>
                        <th>Asunto</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($correspondenciaTurnadosBaja as $correspon)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$correspon->referencia}}</td>
                            <td>{{$correspon->promotor}}</td>
                            <td>{{$correspon->asunto}}</td>
                            <td>{{$correspon->date_acuse}}</td>
                            <td>
                                
                                @can('correspondencia.pdf')
                                <a href="{{ url('/imprimir/'.$correspon->id) }}" class="btn btn-primary pdf btnAccion" target="_blank">
                                    Imprimir
                                </a>
                                @endcan()
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            {{ $correspondenciaTurnadosBaja->links() }}
        </div>
        </div>
    </div>
    <!-- Fin de la correspondencia dada de baja -->
    
    </div>

</div>

@endsection
