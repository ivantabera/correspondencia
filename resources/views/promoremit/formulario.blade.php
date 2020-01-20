<div class="form-group">
    <label class="control-label" for="Alias">{{'Alias'}}</label>
    <input type="text" class="form-control {{ $errors->has('Alias') ? 'is-invalid' : ''  }}" name="Alias" id="Alias" value="{{ isset($promoremit->alias) ? $promoremit->alias : old('Alias') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Alias','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Nombre">{{'Nombre'}}</label>
    <input type="text" class="form-control {{ $errors->has('Nombre') ? 'is-invalid' : ''  }}" name="Nombre" id="Nombre" value="{{ isset($promoremit->nombre) ? $promoremit->nombre : old('Nombre') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Nombre','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Encargado">{{'Encargado'}}</label>
    <input type="text" class="form-control {{ $errors->has('Encargado') ? 'is-invalid' : ''  }}" name="Encargado" id="Encargado" value="{{ isset($promoremit->encargado) ? $promoremit->encargado : old('Encargado') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Encargado','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Cargo">{{'Cargo'}}</label>
    <input type="text" class="form-control {{ $errors->has('Cargo') ? 'is-invalid' : ''  }}" name="Cargo" id="Cargo" value="{{ isset($promoremit->cargo) ? $promoremit->cargo : old('Cargo') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Cargo','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Tipo">{{'Tipo'}}</label>
    <input type="text" class="form-control {{ $errors->has('Tipo') ? 'is-invalid' : ''  }}" name="Tipo" id="Tipo" value="{{ isset($promoremit->tipo) ? $promoremit->tipo : old('Tipo') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Tipo','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Asunto">{{'Extension'}}</label>
    <input type="text" class="form-control {{ $errors->has('Extension') ? 'is-invalid' : ''  }}" name="Extension" id="Extension" value="{{ isset($promoremit->extension) ? $promoremit->extension : old('Extension') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Extension','<div class="invalid-feedback">:message</div>') !!}
</div>

<input type="submit" class="btn btn-success" value="{{$Modo == 'crear' ? 'Agregar' : 'Modificar'}}">
<a href="{{ url('correspondencia') }}" class="btn btn-primary">Regresar</a>