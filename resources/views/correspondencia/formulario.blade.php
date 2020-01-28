<div class="form-group">
    <label class="control-label" for="NumEnt">{{'Numero de entrada'}}</label>
    <input type="text" class="form-control {{ $errors->has('NumEnt') ? 'is-invalid' : ''  }}" name="num_entrada" id="NumEnt" value="{{ isset($correspondencia->num_entrada) ? $correspondencia->num_entrada : old('NumEnt') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Numero de entrada','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="DateAcuse">{{'Acuse'}}</label>
    <input type="date" class="form-control {{ $errors->has('DateAcuse') ? 'is-invalid' : ''  }}" name="date_acuse" id="DateAcuse" value="{{ isset($correspondencia->dateAcuse) ? $correspondencia->acuse : old('DateAcuse', $now->format('Y-m-d')) }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('DateAcuse','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="HoraAcuse">{{'Hora de Acuse'}}</label>
    <input type="time" class="form-control {{ $errors->has('HoraAcuse') ? 'is-invalid' : ''  }}" name="hora_acuse" id="HoraAcuse" value="{{ isset($correspondencia->horaAcuse) ? $correspondencia->horaAcuse : old('HoraAcuse', $now->format('H:i')) }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('HoraAcuse','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Elaboracion">{{'Elaboración'}}</label>
    <input type="date" class="form-control {{ $errors->has('Elaboracion') ? 'is-invalid' : ''  }}" name="date_elaboracion" id="Elaboracion" value="{{ isset($correspondencia->elaboracion) ? $correspondencia->elaboracion : old('Elaboracion', $now->format('Y-m-d')) }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Elaboracion','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Referencia">{{'Referencia'}}</label>
    <input type="text" class="form-control {{ $errors->has('Referencia') ? 'is-invalid' : ''  }}" name="Referencia" id="Referencia" value="{{ isset($correspondencia->referencia) ? $correspondencia->referencia : old('Referencia') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Referencia','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Promotor">{{'Promotor'}}</label>
    <select class="form-control {{ $errors->has('Promotor') ? 'is-invalid' : ''  }}" name="Promotor" id="Promotor" value="{{ isset($promoremit->id) ? $promoremit->id : old('Promotor') }}">
    @if(isset($promotor))
     <option value="{{$promotor[0]->id}}">{{$promotor[0]->nombre}}</option>
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

<div class="form-group">
    <label class="control-label" for="Remitente">{{'Remitente'}}</label>
    <select class="form-control {{ $errors->has('Remitente') ? 'is-invalid' : ''  }}" name="Remitente" id="Remitente" value="{{ isset($promoremit->id) ? $promoremit->id : old('Remitente') }}">
    @if(isset($remitente))
     <option value="{{$remitente[0]->id}}">{{$remitente[0]->nombre}}</option>
    @else
        <option value="0">Selecciona alguna opción</option>
    @endif
        <option value="0">Selecciona una opcion</option>
        @foreach($promoremit as $proremi)
            <option value="{{$proremi->id}}">{{$proremi->nombre}}</option>
        <br>
        @endforeach
    </select>
    {!! $errors->first('Remitente','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Dirigido">{{'Dirigido A'}}</label>
    <input type="text" class="form-control {{ $errors->has('Dirigido') ? 'is-invalid' : ''  }}" name="Dirigido" id="Dirigido" value="{{ isset($correspondencia->dirigido) ? $correspondencia->dirigido : old('Dirigido') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Dirigido','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Antecedente">{{'Antecedente'}}</label>
    <input type="text" class="form-control {{ $errors->has('Antecedente') ? 'is-invalid' : ''  }}" name="Antecedente" id="Antecedente" value="{{ isset($correspondencia->antecedente) ? $correspondencia->antecedente : old('Antecedente') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Antecedente','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Particular">{{'Particular'}}</label>
    <input type="text" class="form-control {{ $errors->has('Particular') ? 'is-invalid' : ''  }}" name="Particular" id="Particular" value="{{ isset($correspondencia->particular) ? $correspondencia->particular : old('Particular') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Particular','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Firmado">{{'Firmado por'}}</label>
    <input type="text" class="form-control {{ $errors->has('Firmado') ? 'is-invalid' : ''  }}" name="Firmado_por" id="Firmado" value="{{ isset($correspondencia->firmado_por) ? $correspondencia->firmado_por : old('Firmado') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Firmado','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Cargo">{{'Cargo'}}</label>
    <input type="text" class="form-control {{ $errors->has('Cargo') ? 'is-invalid' : ''  }}" name="Cargo" id="Cargo" value="{{ isset($correspondencia->cargo) ? $correspondencia->cargo : old('Cargo') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Cargo','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Tipo">{{'Tipo'}}</label>
    <input type="text" class="form-control {{ $errors->has('Tipo') ? 'is-invalid' : ''  }}" name="Tipo" id="Tipo" value="{{ isset($correspondencia->tipo) ? $correspondencia->tipo : old('Tipo') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Tipo','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Expediente">{{'Expediente'}}</label>
    <input type="text" class="form-control {{ $errors->has('Expediente') ? 'is-invalid' : ''  }}" name="Expediente" id="Expediente" value="{{ isset($correspondencia->expediente) ? $correspondencia->expediente : old('Expediente') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Expediente','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Clasificacion">{{'Clasificación'}}</label>
    <input type="text" class="form-control {{ $errors->has('Clasificacion') ? 'is-invalid' : ''  }}" name="Clasificacion" id="Clasificacion" value="{{ isset($correspondencia->clasificacion) ? $correspondencia->clasificacion : old('Clasificacion') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Clasificacion','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Asunto">{{'Asunto'}}</label>
    <input type="text" class="form-control {{ $errors->has('Asunto') ? 'is-invalid' : ''  }}" name="Asunto" id="Asunto" value="{{ isset($correspondencia->asunto) ? $correspondencia->asunto : old('Asunto') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Asunto','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Evento">{{'Evento'}}</label>
    <input type="text" class="form-control {{ $errors->has('Evento') ? 'is-invalid' : ''  }}" name="Evento" id="Evento" value="{{ isset($correspondencia->evento) ? $correspondencia->evento : old('Evento') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Evento','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="DateEvento">{{'Fecha del evento'}}</label>
    <input type="date" class="form-control {{ $errors->has('DateEvento') ? 'is-invalid' : ''  }}" name="Date_Evento" id="DateEvento" value="{{ isset($correspondencia->dateEvento) ? $correspondencia->dateEvento : old('DateEvento', $now->format('Y-m-d')) }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('DateEvento','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="HoraEvento">{{'Hora de Acuse'}}</label>
    <input type="time" class="form-control {{ $errors->has('HoraEvento') ? 'is-invalid' : ''  }}" name="Hora_Evento" id="HoraEvento" value="{{ isset($correspondencia->horaEvento) ? $correspondencia->horaEvento : old('HoraEvento', $now->format('H:i')) }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('HoraEvento','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Mod">{{'Mod'}}</label>
    <br>
    <label class="radio-inline">
        <input type="radio" name="prioridad" value="1" checked>Prioritario
    </label>
    <label class="radio-inline">
        <input type="radio" name="prioridad" value="2">Intersecretarial
    </label>
    <label class="radio-inline">
        <input type="radio" name="prioridad" value="3">Confidencial
    </label>
    <label class="radio-inline">
        <input type="radio" name="prioridad" value="4">Salida
    </label>
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

 
<!-- <script type="text/javascript" defer>
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
</script>      -->       