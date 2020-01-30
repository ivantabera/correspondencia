<div class="form-group">
    <label class="control-label" for="Nombre">{{'Nombre'}}</label>
    <input 
        type="text" 
        class="form-control {{ $errors->has('Nombre') ? 'is-invalid' : ''  }}" 
        name="Nombre" 
        id="Nombre" 
        value="{{ isset($tipodocumento->nombre) ? $tipodocumento->nombre : old('Nombre') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Nombre','<div class="invalid-feedback">:message</div>') !!}
</div>

<input type="submit" class="btn btn-success" value="{{$Modo == 'crear' ? 'Agregar' : 'Modificar'}}">
<a href="{{ url('correspondencia') }}" class="btn btn-primary">Regresar</a>