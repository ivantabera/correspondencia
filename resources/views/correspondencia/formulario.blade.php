<div class="form-group">
    <label class="control-label" for="Referencia">{{'Referencia'}}</label>
    <input type="text" class="form-control {{ $errors->has('Referencia') ? 'is-invalid' : ''  }}" name="Referencia" id="Referencia" value="{{ isset($correspondencia->referencia) ? $correspondencia->referencia : old('Referencia') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Referencia','<div class="invalid-feedback">:message</div>') !!}
</div>

<!-- <div class="form-group">
    <label class="control-label" for="Promotor">{{'Promotor'}}</label>
    <input type="text" class="form-control {{ $errors->has('Promotor') ? 'is-invalid' : ''  }}" name="Promotor" id="Promotor" value="{{ isset($correspondencia->promotor) ? $correspondencia->promotor : old('Promotor') }}">
    mensaje para mostrar el error si el formulario viene vacio o formato invalido
    {!! $errors->first('Promotor','<div class="invalid-feedback">:message</div>') !!}
</div> -->

<div class="form-group">
    <label class="control-label" for="Promotor">{{'Promotor'}}</label>
    <select class="form-control {{ $errors->has('Promotor') ? 'is-invalid' : ''  }}" name="Promotor" id="Promotor" value="{{ isset($promoremit->id) ? $promoremit->id : old('Promotor') }}">
    @if($promotor)
     <option value="{{$promotor->id}}">{{$promotor->nombre}}</option>
    @else
        <option value="0">Selecciona alguna opción</option>
    @endif
        <option value="0">Selecciona una opcion</option>
        @foreach($promoremit as $proremi)
            <option value="{{$proremi->id}}">{{$proremi->nombre}}</option>
        <br>
        @endforeach
    </select>
    {!! $errors->first('Promotor','<div class="invalid-feedback">:message</div>') !!}
</div>

<!-- <div class="form-group">
    <label class="control-label" for="Remitente">{{'Remitente'}}</label>
    <input type="text" class="form-control {{ $errors->has('Remitente') ? 'is-invalid' : ''  }}" name="Remitente" id="Remitente" value="{{ isset($correspondencia->remitente) ? $correspondencia->remitente : old('Remitente') }}">
    mensaje para mostrar el error si el formulario viene vacio o formato invalido
    {!! $errors->first('Remitente','<div class="invalid-feedback">:message</div>') !!}
</div> -->

<div class="form-group">
    <label class="control-label" for="Remitente">{{'Remitente'}}</label>
    <select class="form-control {{ $errors->has('Remitente') ? 'is-invalid' : ''  }}" name="Remitente" id="Remitente" value="{{ isset($promoremit->nombre) ? $promoremit->nombre : old('Remitente') }}">
        <option value="0">Selecciona alguna opción</option>
    @foreach($promoremit as $proremi)
        <option value="{{$proremi->id}}">{{$proremi->nombre}}</option>
    <br>
    @endforeach
    </select>
    {!! $errors->first('Remitente','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Dirigido">{{'Dirigido'}}</label>
    <input type="text" class="form-control {{ $errors->has('Dirigido') ? 'is-invalid' : ''  }}" name="Dirigido" id="Dirigido" value="{{ isset($correspondencia->dirigido) ? $correspondencia->dirigido : old('Dirigido') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Dirigido','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Particular">{{'Particular'}}</label>
    <input type="text" class="form-control {{ $errors->has('Particular') ? 'is-invalid' : ''  }}" name="Particular" id="Particular" value="{{ isset($correspondencia->particular) ? $correspondencia->particular : old('Particular') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Particular','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Asunto">{{'Asunto'}}</label>
    <input type="text" class="form-control {{ $errors->has('Asunto') ? 'is-invalid' : ''  }}" name="Asunto" id="Asunto" value="{{ isset($correspondencia->asunto) ? $correspondencia->asunto : old('Asunto') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Asunto','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label for="Foto" class="control-label">{{'Foto'}}</label>
    @if(isset($correspondencia->foto))
        <br>
        <img src="{{ asset('storage').'/'.$correspondencia->foto}}" class="img-thumbnail img-fluid"  alt="" width="200">
        <br>
    @endif
    <input type="file" class="form-control {{ $errors->has('Foto') ? 'is-invalid' : ''  }}" name="Foto" id="Foto" value="{{ isset($correspondencia->foto) ? $correspondencia->foto : '' }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Foto','<div class="invalid-feedback">:message</div>') !!}
</div>

<input type="submit" class="btn btn-success" value="{{$Modo == 'crear' ? 'Agregar' : 'Modificar'}}">
<a href="{{ url('correspondencia') }}" class="btn btn-primary">Regresar</a>