<div class="form-group">
    <label class="control-label" for="Nombre">{{'Nombre'}}</label>
    <input type="text" class="form-control {{ $errors->has('Nombre') ? 'is-invalid' : ''  }}" name="Nombre" id="Nombre" value="{{ isset($dirigido->nombre) ? $dirigido->nombre : old('Nombre') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Nombre','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Cargo">{{'Cargo'}}</label>
    <input type="text" class="form-control {{ $errors->has('Cargo') ? 'is-invalid' : ''  }}" name="Cargo" id="Cargo" value="{{ isset($dirigido->cargo) ? $dirigido->cargo : old('Cargo') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Cargo','<div class="invalid-feedback">:message</div>') !!}
</div>


<input type="submit" class="btn btn-success" value="{{$Modo == 'crear' ? 'Agregar' : 'Modificar'}}">
<a href="{{ url('dirigido') }}" class="btn btn-primary">Regresar</a>