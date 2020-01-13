Seccion para editar correspondencia

<form action=" {{ url('/correspondencia/'. $correspondencia->id) }} " method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    
    <!--el metodo PATCH nos dirige en automatico al metodo update-->
    {{ method_field('PATCH') }}


    <label for="Referencia">{{'Referencia'}}</label>
    <input type="text" name="Referencia" id="Referencia" value="{{ $correspondencia->referencia }}">
    <br>

    <label for="Promotor">{{'Promotor'}}</label>
    <input type="text" name="Promotor" id="Promotor" value="{{ $correspondencia->promotor }}">
    <br>

    <label for="Remitente">{{'Remitente'}}</label>
    <input type="text" name="Remitente" id="Remitente" value="{{ $correspondencia->remitente }}">
    <br>

    <label for="Dirigido">{{'Dirigido'}}</label>
    <input type="text" name="Dirigido" id="Dirigido" value="{{ $correspondencia->dirigido }}">
    <br>

    <label for="Particular">{{'Particular'}}</label>
    <input type="text" name="Particular" id="Particular" value="{{ $correspondencia->particular }}">
    <br>

    <label for="Asunto">{{'Asunto'}}</label>
    <input type="text" name="Asunto" id="Asunto" value="{{ $correspondencia->asunto }}">
    <br>

    <label for="Foto">{{'Foto'}}</label>
    <br>
    {{ $correspondencia->foto }}
    <br>
    <input type="file" name="Foto" id="Foto" value="{{ $correspondencia->foto }}">
    <br>

    <input type="submit" value="Editar">
</form>