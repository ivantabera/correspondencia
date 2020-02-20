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

    <form action="{{ url('/roles/store') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
        
        <!--imprime una llave "token" de acceso para que nos deje entrar a la funcion -->
        {{ csrf_field() }}

        <div class="form-group">
            <label class="control-label" for="name">{{'Nombre'}}</label>
            <input 
                type="text" 
                class="form-control 
                {{ $errors->has('name') ? 'is-invalid' : ''  }}" 
                name="name" 
                id="name" 
                value="">
            <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
            {!! $errors->first('Nombre','<div class="invalid-feedback">:message</div>') !!}
        </div>
        
        <div class="form-group">
            <label class="control-label" for="slug">{{'Url Amigable'}}</label>
            <input 
                type="text" 
                class="form-control 
                {{ $errors->has('slug') ? 'is-invalid' : ''  }}" 
                name="slug" 
                id="slug" 
                value="">
            <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
            {!! $errors->first('Slug','<div class="invalid-feedback">:message</div>') !!}
        </div>
        
        <div class="form-group">
            <label class="control-label" for="description">{{'Descripción'}}</label>
            <textarea 
                id="description" 
                class="form-control {{ $errors->has('description') ? 'is-invalid' : ''  }}"
                rows="4" 
                cols="50"
                name="description"></textarea>
            <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
            {!! $errors->first('Descripción','<div class="invalid-feedback">:message</div>') !!}
        </div>
        
        <h3>Permiso especial</h3>
        <div class="form-group">
            <label class="radio-inline">
                <input 
                    type="radio" 
                    name="special" 
                    value="all-access"
                >
                Acceso total
            </label>
            <label class="radio-inline">
                <input 
                    type="radio" 
                    name="special" 
                    value="no-access"
                >
                Ningun acceso
            </label>
        </div>
        
        <hr>
        
        <h3>Lista de permisos</h3>
        
        <div class="form-group">
            <ul class="list-unstyled">
                @foreach ($permisos as $permission)
                    <li>
                        <label>
                            <input  type="checkbox" 
                                    name="permisos[]" 
                                    value="{{ $permission->id }}"
                            >
                            {{$permission->name}}
                            <em>({{$permission->description ?: 'No aplica' }})</em>
                        </label>
                    </li>
                @endforeach
            </ul>
        </div>
        
        <input type="submit" class="btn btn-success" value="Agregar">
        <a href="{{ url('roles') }}" class="btn btn-primary">Regresar</a>

        <!--Incluir contenido  y enviar variable Modo=crear para saber en que modo poner el formulario-->
        {{-- @include('roles.formulario', ['Modo'=>'crear']) --}}

    </form>

</div>
@endsection