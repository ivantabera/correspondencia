<label for="Referencia">{{'Referencia'}}</label>
<input type="text" name="Referencia" id="Referencia" value="{{ isset($correspondencia->referencia) ? $correspondencia->referencia : '' }}">
<br>

<label for="Promotor">{{'Promotor'}}</label>
<input type="text" name="Promotor" id="Promotor" value="{{ isset($correspondencia->promotor) ? $correspondencia->promotor : '' }}">
<br>

<label for="Remitente">{{'Remitente'}}</label>
<input type="text" name="Remitente" id="Remitente" value="{{ isset($correspondencia->remitente) ? $correspondencia->remitente : '' }}">
<br>

<label for="Dirigido">{{'Dirigido'}}</label>
<input type="text" name="Dirigido" id="Dirigido" value="{{ isset($correspondencia->dirigido) ? $correspondencia->dirigido : '' }}">
<br>

<label for="Particular">{{'Particular'}}</label>
<input type="text" name="Particular" id="Particular" value="{{ isset($correspondencia->particular) ? $correspondencia->particular : '' }}">
<br>

<label for="Asunto">{{'Asunto'}}</label>
<input type="text" name="Asunto" id="Asunto" value="{{ isset($correspondencia->asunto) ? $correspondencia->asunto : '' }}">
<br>

<label for="Foto">{{'Foto'}}</label>
@if(isset($correspondencia->foto))
<br>
<img src="{{ asset('storage').'/'.$correspondencia->foto}}" alt="" width="200">
<br>
@endif
<input type="file" name="Foto" id="Foto" value="{{ isset($correspondencia->foto) ? $correspondencia->foto : '' }}">
<br>

<input type="submit" value="{{$Modo == 'crear' ? 'Agregar' : 'Modificar'}}">
<a href="{{ url('correspondencia') }}">Regresar</a>