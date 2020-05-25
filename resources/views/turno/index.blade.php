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
        <!--Formulario de busqueda-->
        {!! Form::open(['method' => 'GET', 'class' => 'form-inline pull-rigth']) !!}
            <div class="form-group">
                <input type="text" name="referencia" class="form-control mr-sm-2" placeholder="Referencia" value="{{ request('referencia')}}">
            </div>
            <div class="form-group">
                <input type="text" name="num_entrada" class="form-control mr-sm-2" placeholder="Numero de entrada" value="{{ request('num_entrada')}}">
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
        <div class="card">
            <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Correspondencia para turnar
                </button>
            </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    
                    <table id="#sinTurno" class="table table-light table-hover table-responsive-sm table-responsive-md">

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
                                        <!--Boton agregar turno-->
                                        @can('turno.crear')
                                        <form method="post" action="{{ url('/turno/create') }}" class="formCrear" style="display:inline">
                                            {{ csrf_field() }} <!--token para que nos permita acceder-->
                                            {{ method_field('GET') }} <!--metodo que vamos a ejecutar-->
                                            <input type="hidden" name="idTurno" class="idTurno" value="{{$correspon->id}}">
                                            <button type="submit"  class="btn btn-success btnAccion">Crear Turno</button>
                                        </form>
                                        @endcan()

                                        @can('correspondencia.pdf')
                                        <a href="{{ url('/imprimir/'.$correspon->id) }}" class="btn btn-primary pdf btnAccion" target="_blank">
                                            Vista previa
                                        </a>
                                        @endcan()
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                    {{ $correspondencia->links() }}

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Correspondencia turnada
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
                                    <!--Boton agregar turno-->
                                    @can('turno.crear')
                                    <form method="post" action="{{ url('/turno/create') }}" class="formCrear" style="display:inline">
                                        {{ csrf_field() }} <!--token para que nos permita acceder-->
                                        {{ method_field('GET') }} <!--metodo que vamos a ejecutar-->
                                        <input type="hidden" name="idTurno" class="idTurno" value="{{$correspon->id}}">
                                        <button type="submit"  class="btn btn-success btnAccion">Vista previa</button>
                                    </form>
                                    @endcan()

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
                {{ $correspondenciaTurnados->links() }}

            </div>
            </div>
        </div>
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
                                    <!--Boton agregar turno-->
                                    @can('turno.crear')
                                    <form method="post" action="{{ url('/turno/create') }}" class="formCrear" style="display:inline">
                                        {{ csrf_field() }} <!--token para que nos permita acceder-->
                                        {{ method_field('GET') }} <!--metodo que vamos a ejecutar-->
                                        <input type="hidden" name="idTurno" class="idTurno" value="{{$correspon->id}}">
                                        <button type="submit"  class="btn btn-success btnAccion">Ver documento</button>
                                    </form>
                                    @endcan()

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
    </div>

</div>

@endsection
