<div class="form-group">
<label class="control-label" for="Referencia">{{'Referencia'}}</label>
<input type="text" class="form-control" name="Referencia" id="Referencia" value="{{ isset($correspondencia->referencia) ? $correspondencia->referencia : '' }}">
</div>

<div class="form-group">
<label class="control-label" for="Promotor">{{'Promotor'}}</label>
<input type="text" class="form-control" name="Promotor" id="Promotor" value="{{ isset($correspondencia->promotor) ? $correspondencia->promotor : '' }}">
</div>

<div class="form-group">
<label class="control-label" for="Remitente">{{'Remitente'}}</label>
<input type="text" class="form-control" name="Remitente" id="Remitente" value="{{ isset($correspondencia->remitente) ? $correspondencia->remitente : '' }}">
</div>

<div class="form-group">
<label class="control-label" for="Dirigido">{{'Dirigido'}}</label>
<input type="text" class="form-control" name="Dirigido" id="Dirigido" value="{{ isset($correspondencia->dirigido) ? $correspondencia->dirigido : '' }}">
</div>

<div class="form-group">
<label class="control-label" for="Particular">{{'Particular'}}</label>
<input type="text" class="form-control" name="Particular" id="Particular" value="{{ isset($correspondencia->particular) ? $correspondencia->particular : '' }}">
</div>

<div class="form-group">
<label class="control-label" for="Asunto">{{'Asunto'}}</label>
<input type="text" class="form-control" name="Asunto" id="Asunto" value="{{ isset($correspondencia->asunto) ? $correspondencia->asunto : '' }}">
</div>

<div class="form-group">
<label for="Foto" class="control-label">{{'Foto'}}</label>
@if(isset($correspondencia->foto))
<br>
<img src="{{ asset('storage').'/'.$correspondencia->foto}}" class="img-thumbnail img-fluid"  alt="" width="200">
<br>
@endif
<input type="file" class="form-control" name="Foto" id="Foto" value="{{ isset($correspondencia->foto) ? $correspondencia->foto : '' }}">
</div>

<input type="submit" class="btn btn-success" value="{{$Modo == 'crear' ? 'Agregar' : 'Modificar'}}">
<a href="{{ url('correspondencia') }}" class="btn btn-primary">Regresar</a>