<div class="form-group">
    <label class="control-label" for="num_entrada">{{'Numero de entrada'}}</label>
    <input 
        type="text" 
        class="form-control {{ $errors->has('num_entrada') ? 'is-invalid' : ''  }}" 
        name="num_entrada" 
        id="num_entrada" 
        value="{{ isset($correspondencia->num_entrada) ? $correspondencia->num_entrada : old('num_entrada') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('num_entrada','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="date_acuse">{{'Acuse'}}</label>
    <input 
        type="date" 
        class="form-control {{ $errors->has('date_acuse') ? 'is-invalid' : ''  }}" 
        name="date_acuse" 
        id="date_acuse" 
        value="{{ isset($correspondencia->date_acuse) ? $correspondencia->date_acuse : old('date_acuse', $now->format('Y-m-d')) }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('date_acuse','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="hora_acuse">{{'Hora de Acuse'}}</label>
    <input 
        type="time" 
        class="form-control {{ $errors->has('hora_acuse') ? 'is-invalid' : ''  }}" 
        name="hora_acuse" 
        id="hora_acuse" 
        value="{{ isset($correspondencia->hora_acuse) ? $correspondencia->hora_acuse : old('hora_acuse', $now->format('H:i')) }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('hora_acuse','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="date_elaboracion">{{'Elaboración'}}</label>
    <input 
        type="date" 
        class="form-control {{ $errors->has('date_elaboracion') ? 'is-invalid' : ''  }}" 
        name="date_elaboracion" 
        id="date_elaboracion" 
        value="{{ isset($correspondencia->date_elaboracion) ? $correspondencia->date_elaboracion : old('date_elaboracion', $now->format('Y-m-d')) }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('date_elaboracion','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="referencia">{{'Referencia'}}</label>
    <input 
        type="text" 
        class="form-control {{ $errors->has('referencia') ? 'is-invalid' : ''  }}" 
        name="referencia" 
        id="referencia" 
        value="{{ isset($correspondencia['referencia']) ? $correspondencia['referencia'] : old('referencia') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('referencia','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="promotor">{{'Promotor'}}</label>
    <select 
        class="form-control {{ $errors->has('Promotor') ? 'is-invalid' : ''  }}" 
        name="promotor" 
        id="promotor" 
        value="{{ isset($promoremit->id) ? $promoremit->id : old('Promotor') }}">
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
    {!! $errors->first('promotor','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Remitente">{{'Remitente'}}</label>
    <select 
        class="form-control {{ $errors->has('remitente') ? 'is-invalid' : ''  }}" 
        name="remitente" 
        id="remitente" 
        value="{{ isset($promoremit->id) ? $promoremit->id : old('remitente') }}">
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
    {!! $errors->first('remitente','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="dirigido">{{'Dirigido A'}}</label>
    <input 
        type="text" 
        class="form-control {{ $errors->has('dirigido') ? 'is-invalid' : ''  }}" 
        name="dirigido" 
        id="dirigido" 
        value="{{ isset($correspondencia->dirigido) ? $correspondencia->dirigido : old('dirigido') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('dirigido','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="antecedente">{{'Antecedente'}}</label>
    <input 
        type="text" 
        class="form-control {{ $errors->has('antecedente') ? 'is-invalid' : ''  }}" 
        name="antecedente" 
        id="antecedente" 
        value="{{ isset($correspondencia->antecedente) ? $correspondencia->antecedente : old('antecedente') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('antecedente','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="particular">{{'Particular'}}</label>
    <input 
        type="text" 
        class="form-control {{ $errors->has('particular') ? 'is-invalid' : ''  }}" 
        name="particular" 
        id="particular" 
        value="{{ isset($correspondencia->particular) ? $correspondencia->particular : old('particular') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('particular','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="firmado_por">{{'Firmado por'}}</label>
    <input 
        type="text" 
        class="form-control {{ $errors->has('firmado_por') ? 'is-invalid' : ''  }}" 
        name="firmado_por" 
        id="firmado_por" 
        value="{{ isset($correspondencia->firmado_por) ? $correspondencia->firmado_por : old('firmado_por') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('firmado_por','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="cargo">{{'Cargo'}}</label>
    <input 
        type="text" 
        class="form-control {{ $errors->has('cargo') ? 'is-invalid' : ''  }}" 
        name="cargo" 
        id="cargo" 
        value="{{ isset($correspondencia->cargo) ? $correspondencia->cargo : old('cargo') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('cargo','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="tipo">{{'Tipo'}}</label>
    <input 
        type="text" 
        class="form-control {{ $errors->has('tipo') ? 'is-invalid' : ''  }}" 
        name="tipo" 
        id="tipo" 
        value="{{ isset($correspondencia->tipo) ? $correspondencia->tipo : old('tipo') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('tipo','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="expediente">{{'Expediente'}}</label>
    <input 
        type="text" 
        class="form-control {{ $errors->has('expediente') ? 'is-invalid' : ''  }}" 
        name="expediente" 
        id="expediente" 
        value="{{ isset($correspondencia->expediente) ? $correspondencia->expediente : old('expediente') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('expediente','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="clasificacion">{{'Clasificación'}}</label>
    <input 
        type="text" 
        class="form-control {{ $errors->has('clasificacion') ? 'is-invalid' : ''  }}" 
        name="clasificacion" 
        id="clasificacion" 
        value="{{ isset($correspondencia->clasificacion) ? $correspondencia->clasificacion : old('clasificacion') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('clasificacion','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="asunto">{{'Asunto'}}</label>
    <input 
        type="text" 
        class="form-control {{ $errors->has('asunto') ? 'is-invalid' : ''  }}" 
        name="asunto" 
        id="asunto" 
        value="{{ isset($correspondencia->asunto) ? $correspondencia->asunto : old('asunto') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('asunto','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="evento">{{'Evento'}}</label>
    <input 
        type="text" 
        class="form-control {{ $errors->has('evento') ? 'is-invalid' : ''  }}" 
        name="evento" 
        id="evento" 
        value="{{ isset($correspondencia->evento) ? $correspondencia->evento : old('evento') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('evento','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="date_evento">{{'Fecha del evento'}}</label>
    <input 
        type="date" 
        class="form-control {{ $errors->has('date_evento') ? 'is-invalid' : ''  }}" 
        name="date_evento" 
        id="date_evento" 
        value="{{ isset($correspondencia->date_evento) ? $correspondencia->date_evento : old('date_evento', $now->format('Y-m-d')) }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('date_evento','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="hora_evento">{{'Hora de Acuse'}}</label>
    <input 
        type="time" 
        class="form-control {{ $errors->has('hora_evento') ? 'is-invalid' : ''  }}" 
        name="hora_evento" 
        id="hora_evento" 
        value="{{ isset($correspondencia->hora_evento) ? $correspondencia->hora_evento : old('hora_evento', $now->format('H:i')) }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('hora_evento','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Mod">{{'Mod'}}</label>
    <br>
    <label class="radio-inline">
        <input 
            type="radio" 
            name="prioridad" 
            value="1" 
            {{ isset($correspondencia->prioridad) ? ($correspondencia->prioridad== '1' ? "checked" : '') : 'checked' }}>
            Prioritario
    </label>
    <label class="radio-inline">
        <input 
            type="radio" 
            name="prioridad" 
            value="2" 
            {{ isset($correspondencia->prioridad) ? ($correspondencia->prioridad== '2' ? "checked" : '') : '' }}>
            Intersecretarial
    </label>
    <label class="radio-inline">
        <input 
            type="radio" 
            name="prioridad" 
            value="3" 
            {{ isset($correspondencia->prioridad) ? ($correspondencia->prioridad== '3' ? "checked" : '') : '' }}>
            Confidencial
    </label>
    <label class="radio-inline">
        <input 
            type="radio" 
            name="prioridad" 
            value="4" 
            {{ isset($correspondencia->prioridad) ? ($correspondencia->prioridad== '4' ? "checked" : '') : '' }}>
            Salida
    </label>
</div>

<div class="form-group">
    <label for="foto" class="control-label">{{'Foto'}}</label>
    @if(isset($correspondencia->foto))
        <br>
        <img src="{{ asset('storage').'/'.$correspondencia->foto}}" class="img-thumbnail img-fluid"  alt="" width="200">
        <br>
    @endif
    <input 
        type="file" 
        class="form-control {{ $errors->has('foto') ? 'is-invalid' : ''  }}" 
        name="foto" 
        id="foto" 
        value="{{ isset($correspondencia->foto) ? $correspondencia->foto : '' }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('foto','<div class="invalid-feedback">:message</div>') !!}
</div>

<input type="submit" class="btn btn-success" value="{{$Modo == 'crear' ? 'Agregar' : 'Modificar'}}">
<a href="{{ url('correspondencia') }}" class="btn btn-primary">Regresar</a>

 
<!-- <script type="text/javascript" defer>
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
</script>      -->       