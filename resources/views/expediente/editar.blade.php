@extends('layouts.app')

@section('content')
<div class="container">

    <form action=" {{ url('/expedientes/'. $expediente->id) }} " method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        <!--el metodo PATCH nos dirige en automatico al metodo update-->
        {{ method_field('PATCH') }}

        <!--Incluir contenido "Formulario.blade" y enviar variable Modo=modificar para saber en que modo poner el formulario-->
        @include('expediente.formulario', ['Modo'=>'modificar'])

    </form>

</div>
@endsection
