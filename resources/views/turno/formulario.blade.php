<div class="form-group">
    {{-- <label class="control-label" for="folio">{{'Folio'}}</label> --}}
    <input 
        type="hidden" 
        class="form-control {{ $errors->has('folio') ? 'is-invalid' : ''  }}" 
        name="folio" 
        id="folio" 
        value="{{ isset($correspondencia->id) ? $correspondencia->id : "" }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('folio','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="oficio">{{'Folio Oficio'}}</label>
    <input 
        type="text" 
        class="form-control {{ $errors->has('folio') ? 'is-invalid' : ''  }}" 
        name="oficio" 
        id="oficio" 
        value="{{ isset($correspondencia->num_entrada) ? $correspondencia->num_entrada : $num_entrada }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('oficio','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="fecha_turno">{{'Fecha'}}</label>
    <input 
        type="date" 
        class="form-control {{ $errors->has('fecha_turno') ? 'is-invalid' : ''  }}" 
        name="fecha_turno" 
        id="fecha_turno" 
        value="{{ isset($correspondencia->fecha_turno) ? $correspondencia->fecha_turno : old('fecha_turno', $now->format('Y-m-d')) }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('fecha_turno','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="turnado_a">{{'Turnado a'}}</label>
    <select 
        class="form-control {{ $errors->has('turnado_a') ? 'is-invalid' : ''  }} turnado_a" 
        name="turnado_a" 
        id="turnado_a" 
        value="{{ isset($turnado_a->id) ? $turnado_a->id : old('turnado_a') }}">
        @if(isset($turnoa))
        <option value="{{$turnoa[0]->id}}">{{$turnoa[0]->nombre}}</option>
        @else
            <option value="0">Selecciona alguna opción</option>
        @endif
            @foreach($turnadoa as $turna)
                <option value="{{$turna->id}}">{{$turna->nombre}}</option>
            <br>
            @endforeach
    </select>
    {!! $errors->first('remitente','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="ccp">{{'C.C.P'}}</label>
    <select 
        class="form-control {{ $errors->has('ccp') ? 'is-invalid' : ''  }} ccp" 
        name="ccp" 
        id="ccp" 
        value="{{ isset($ccp->id) ? $ccp->id : old('ccp') }}"
        multiple
        size="5">
        {{-- @if(isset($ccp1))
        <option value="{{$ccp1[0]->id}}">{{$ccp1[0]->nombre}}</option>
        @else
            <option value="0">Selecciona alguna opción</option>
        @endif --}}
            @foreach($ccp as $ccps)
                <option value="{{$ccps->id}}">{{$ccps->nombre}}</option>
            <br>
            @endforeach
    </select>
    {!! $errors->first('ccp','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="turnado_por">{{'Turnado por'}}</label>
    <select 
        class="form-control {{ $errors->has('turnado_por') ? 'is-invalid' : ''  }} turnado_por" 
        name="turnado_por" 
        id="turnado_por" 
        value="{{ isset($turnado_por->id) ? $turnado_por->id : old('turnado_por') }}">
        @if(isset($turnopor))
        <option value="{{$turnopor[0]->id}}">{{$turnopor[0]->nombre}}</option>
        @else
            <option value="0">Selecciona alguna opción</option>
        @endif
            @foreach($turnadopor as $turnx)
                <option value="{{$turnx->id}}">{{$turnx->nombre}}</option>
            <br>
            @endforeach
    </select>
    {!! $errors->first('remitente','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="ints_adic">{{'Instrucciones adicionales'}}</label>
    <input 
        type="text" 
        class="form-control {{ $errors->has('ints_adic') ? 'is-invalid' : ''  }}" 
        name="ints_adic" 
        id="ints_adic" 
        value="{{ isset($turno->instruccion_adicional) ? $turno->instruccion_adicional : old('ints_adic') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('ints_adic','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="instruccion">{{'Instrucción'}}</label>
    <select 
        class="form-control {{ $errors->has('instruccion') ? 'is-invalid' : ''  }} instruccion" 
        name="instruccion" 
        id="instruccion" 
        value="{{ isset($instruccion->id) ? $instruccion->id : old('instruccion') }}">
        @if(isset($intruc))
        <option value="{{$intruc[0]->id}}">{{$intruc[0]->nombre}}</option>
        @else
            <option value="0">Selecciona alguna opción</option>
        @endif
            @foreach($instrucciones as $instr)
                <option value="{{$instr->id}}">{{$instr->nombre}}</option>
            <br>
            @endforeach
    </select>
    {!! $errors->first('remitente','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="Mod">{{'Prioridad'}}</label>
    <br>
    <label class="radio-inline">
        <input 
            type="radio" 
            name="prioridad" 
            value="0" 
            id="prioridad0"
            {{ isset($turno->semaforo) ? ($turno->semaforo== '0' ? "checked" : '') : 'checked' }}>
            <label class="alert alert-secondary" for="prioridad0">0</label>
    </label>
    <label class="radio-inline">
        <input 
            type="radio" 
            name="prioridad" 
            value="3" 
            id="prioridad3"
            {{ isset($turno->semaforo) ? ($turno->semaforo== '3' ? "checked" : '') : '' }}>
            <label class="alert alert-success" for="prioridad3">3</label>
    </label>
    <label class="radio-inline">
        <input 
            type="radio" 
            name="prioridad" 
            value="2" 
            id="prioridad2"
            {{ isset($turno->semaforo) ? ($turno->semaforo== '2' ? "checked" : '') : '' }}>
            <label class="alert alert-warning" for="prioridad2">2</label>
    </label>
    <label class="radio-inline">
        <input 
            type="radio" 
            name="prioridad" 
            value="1" 
            id="prioridad1"
            {{ isset($turno->semaforo) ? ($turno->semaforo== '1' ? "checked" : '') : '' }}>
            <label class="alert alert-danger" for="prioridad1">1</label>
    </label>
</div>

<div class="form-group">
    <label class="control-label" for="respuesta_auto">{{'Respuesta'}}</label>
    <input 
        type="text" 
        class="form-control {{ $errors->has('respuesta_auto') ? 'is-invalid' : ''  }}" 
        name="respuesta_auto" 
        id="respuesta_auto" 
        value="{{ isset($correspondencia['respuesta_auto']) ? $correspondencia['respuesta_auto'] : old('respuesta_auto') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('respuesta_auto','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="compromiso_date">{{'Compromiso'}}</label>
    <input 
        type="date" 
        class="form-control {{ $errors->has('compromiso_date') ? 'is-invalid' : ''  }}" 
        name="compromiso_date" 
        id="compromiso_date" 
        value="{{ isset($correspondencia->compromiso_date) ? $correspondencia->compromiso_date : old('compromiso_date', $now->format('Y-m-d')) }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('compromiso_date','<div class="invalid-feedback">:message</div>') !!}
</div>


<input type="submit" class="btn btn-success" value="{{$Modo == 'crear' ? 'Agregar' : 'Modificar'}}">

<a href="{{ url('correspondencia') }}" class="btn btn-primary">Regresar</a>