<div class="form-group">
    {{-- <label class="control-label" for="folio">{{'Folio'}}</label> --}}
    <input 
        type="hidden" 
        class="form-control {{ $errors->has('folio') ? 'is-invalid' : ''  }}" 
        name="folio" 
        id="folio" 
        value="{{ isset($correspondencia->id) ? $correspondencia->id : $turno->folio }}">
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
        value="{{ $Modo == 'crear' ? $correspondencia->num_entrada : $turno->oficio}} " readonly>
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('oficio','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    {{-- <label class="control-label" for="turno_num">{{'turno_num'}}</label> --}}
    <input 
        type="hidden" 
        class="form-control {{ $errors->has('turno_num') ? 'is-invalid' : ''  }}" 
        name="turno_num" 
        id="turno_num" 
        value="{{ isset($turno_num) ? $turno_num : $turno->turno_num }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('turno_num','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="fecha_turno">{{'Fecha'}}</label>
    <input 
        type="date" 
        class="form-control {{ $errors->has('fecha_turno') ? 'is-invalid' : ''  }}" 
        name="fecha_turno" 
        id="fecha_turno" 
        value="{{ isset($turno->fecha_turno) ? $turno->fecha_turno :  $now->format('Y-m-d') }}" readonly>
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('fecha_turno','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="turnado_a">{{'Turnado a'}}</label>
    <select 
        class="form-control {{ $errors->has('turnado_a') ? 'is-invalid' : ''  }} turnado_a" 
        name="turnado_a[]" 
        id="turnado_a" 
        value="{{ isset($turnadoa->id) ? $turnadoa->id : old('turnado_a') }}"
        multiple
        size="5">
        @if(isset($turnado_a))
        <option value="{{$turnado_a[0]->id}}">{{$turnado_a[0]->nombre}}</option>
        @else
            <option value="0">Selecciona alguna opción</option>
        @endif
            @foreach($turnadoa as $turna)
                <option value="{{$turna->id}}">{{$turna->nombre}}</option>
            <br>
            @endforeach
    </select>
    {!! $errors->first('turnado_a','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="ccp">{{'C.C.P'}}</label>
    <select 
        class="form-control {{ $errors->has('ccp') ? 'is-invalid' : ''  }} ccp" 
        name="ccp[]" 
        id="ccp" 
        value="{{ isset($ccpSel->id) ? $ccpSel->id : '' }}"
        multiple
        size="5">
        @if(isset($ccpSel))
            @foreach($ccpSel as $ccpselect)
                <option value="{{$ccpselect->id}}" selected>{{$ccpselect->nombre}}</option>
            <br>
            @endforeach
        @else
            <option value="0">Selecciona alguna opción</option>
        @endif
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
        value="{{ isset($turnadopor->id) ? $turnadopor->id : old('turnado_por') }}">
        @if(isset($turnado_por))
        <option value="{{$turnado_por[0]->id}}">{{$turnado_por[0]->nombre}}</option>
        @else
            <option value="0">Selecciona alguna opción</option>
        @endif
            @foreach($turnadopor as $turnx)
                <option value="{{$turnx->id}}">{{$turnx->nombre}}</option>
            <br>
            @endforeach
    </select>
    {!! $errors->first('turnado_por','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="instruccion_adicional">{{'Instrucciones adicionales'}}</label>
    <input 
        type="text" 
        class="form-control {{ $errors->has('instruccion_adicional') ? 'is-invalid' : ''  }}" 
        name="instruccion_adicional" 
        id="instruccion_adicional" 
        value="{{ isset($turno->instruccion_adicional) ? $turno->instruccion_adicional : old('instruccion_adicional') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('instruccion_adicional','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="instruccion">{{'Instrucción'}}</label>
    <select 
        class="form-control {{ $errors->has('instruccion') ? 'is-invalid' : ''  }} instruccion" 
        name="instruccion" 
        id="instruccion" 
        value="{{ isset($instruccion->id) ? $instruccion->id : old('instruccion') }}">
        @if(isset($instruccion))
        <option value="{{$instruccion[0]->id}}">{{$instruccion[0]->nombre}}</option>
        @else
            <option value="0">Selecciona alguna opción</option>
        @endif
            @foreach($instrucciones as $instr)
                <option value="{{$instr->id}}">{{$instr->nombre}}</option>
            <br>
            @endforeach
    </select>
    {!! $errors->first('instruccion','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="semaforo">{{'Prioridad'}}</label>
    <br>
    <label class="radio-inline">
        <input 
            type="radio" 
            name="semaforo" 
            value="1" 
            id="semaforo0"
            {{ isset($turno->semaforo) ? ($turno->semaforo== '0' ? "checked" : '') : 'checked'}} >
            <label class="btn btn-secondary"  for="semaforo0">0</label>
    </label>
    <label class="radio-inline">
        <input 
            type="radio" 
            name="semaforo" 
            value="2" 
            id="semaforo3"
            {{ isset($turno->semaforo) ? ($turno->semaforo== '3' ? "checked" : '') : '' }} >
            <label class="btn btn-success" for="semaforo3">3</label>
    </label>
    <label class="radio-inline">
        <input 
            type="radio" 
            name="semaforo" 
            value="3" 
            id="semaforo2"
            {{ isset($turno->semaforo) ? ($turno->semaforo== '2' ? "checked" : '') : '' }}>
            <label class="btn btn-warning" for="semaforo2">2</label>
    </label>
    <label class="radio-inline">
        <input 
            type="radio" 
            name="semaforo" 
            value="4" 
            id="semaforo1"
            {{ isset($turno->semaforo) ? ($turno->semaforo== '1' ? "checked" : '') : '' }}>
            <label class="btn btn-danger" for="semaforo1">1</label>
    </label>
</div>

<div class="form-group">
    <label class="control-label" for="respuesta_auto">{{'Respuesta'}}</label>
    <input 
        type="text" 
        class="form-control {{ $errors->has('respuesta_auto') ? 'is-invalid' : ''  }} respuesta_auto" 
        name="respuesta_auto" 
        id="respuesta_auto" 
        value="{{ isset($turno->respuesta_auto) ? $turno->respuesta_auto : "" }}" readonly>
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('respuesta_auto','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="compromiso_date">{{'Compromiso'}}</label>
    <input 
        type="text" 
        class="form-control {{ $errors->has('compromiso_date') ? 'is-invalid' : ''  }} compromiso_date" 
        name="compromiso_date" 
        id="compromiso_date" 
        value="{{ isset($turno->compromiso_date) ? $turno->compromiso_date : "" }}" readonly>
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('compromiso_date','<div class="invalid-feedback">:message</div>') !!}
</div>


<input type="submit" class="btn btn-success" value="{{$Modo == 'crear' ? 'Agregar' : 'Modificar'}}">

<a href="{{ isset($turno->folio) ? url('turno/index/'.$turno->folio) : url('turno/index/'.$correspondencia->id ) }}" class="btn btn-primary">Regresar</a>