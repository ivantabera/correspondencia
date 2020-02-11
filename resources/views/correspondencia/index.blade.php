@extends('layouts.app')

@section('content')
<div class="container">

    <!--Enviar mensaje de guardado o modificacion-->
    @if(Session::has('Mensaje'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('Mensaje') }}
    </div>
    @endif

    <a href="{{ url('correspondencia/create') }}" class="btn btn-success">Agregar Correspondencia</a>
    <br>
    
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1>
                    Busqueda de correspondencia
                    {!! Form::open([ 'method' => 'GET', 'class' => 'form-inline pull-rigth']) !!}
                        <div class="form-group">
                            {!! Form::text('num_entrada', null, ['class' => 'form-control', 'placeholder' => 'Numero de entrada']) !!}
                        </div>
                        <div class="form-group">
                            {!!Form::text('asunto', null, ['class' => 'form-control', 'placeholder' => 'Asunto']) !!}
                        </div>
                        <div class="form-group">
                            {!!Form::text('referencia', null, ['class' => 'form-control', 'placeholder' => 'Referencia']) !!}
                        </div>
                    {!! Form::close() !!}
                </h1>
            </div>
        </div>
    </div>

    <br>

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
                    <td>{{$correspon->num_entrada}}</td>
                    <td>{{$correspon->referencia}}</td>
                    <td>{{$correspon->promotor}}</td>
                    <td>{{$correspon->dirigido}}</td>
                    <td>{{$correspon->particular}}</td>
                    <td>{{$correspon->asunto}}</td>
                    <td>
                        <img src="{{ asset('storage').'/'.$correspon->foto}}" class="img-thumbnail img-fluid" alt="" width="50">
                    </td>
                    <td>
                        <a href="{{ url('/correspondencia/'.$correspon->id.'/edit') }}" class="btn btn-warning">
                            Editar
                        </a>
                        <form method="post" action="{{ url('/correspondencia/'.$correspon->id) }}" style="display:inline">
                            {{ csrf_field() }} <!--token para que nos permita acceder-->
                            {{ method_field('DELETE') }} <!--metodo que vamos a ejecutar-->
                            <button type="submit" onclick="return confirm('¿Borrar?')" class="btn btn-danger">Borrar</button>

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    {{ $correspondencia->links() }}

</div>

<script type="application/javascript">

</script>

@endsection
