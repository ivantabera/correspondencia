@extends('layouts.app')

@section('content')
<div class="container">

    <!--errores en el formulario-->
    @if(count($errors)>0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ url('/dirigido') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
        
        <!--imprime una llave "token" de acceso para que nos deje entrar a la funcion -->
        {{ csrf_field() }}

        <!--Incluir contenido  y enviar variable Modo=crear para saber en que modo poner el formulario-->
        @include('dirigido.formulario', ['Modo'=>'crear'])

    </form>

</div>
@endsection