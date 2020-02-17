@extends('layouts.app')

@section('content')
<div class="container">

    <form action=" {{ url('/destinatario/'. $destinatario->id) }} " method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        <!--el metodo PATCH nos dirige en automatico al metodo update-->
        {{ method_field('PUT') }}

        <!--Incluir contenido "Formulario.blade" y enviar variable Modo=modificar para saber en que modo poner el formulario-->
        @include('destinatario.formulario', ['Modo'=>'modificar'])

    </form>

</div>
@endsection
