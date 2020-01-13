Seccion para crear correspondencia

<form action="{{ url('/correspondencia') }}" method="POST" enctype="multipart/form-data">
    
    <!--imprime una llave "token" de acceso para que nos deje entrar a la funcion -->
    {{ csrf_field() }}

    <label for="Referencia">{{'Referencia'}}</label>
    <input type="text" name="Referencia" id="Referencia" value="">
    <br>

    <label for="Promotor">{{'Promotor'}}</label>
    <input type="text" name="Promotor" id="Promotor" value="">
    <br>

    <label for="Remitente">{{'Remitente'}}</label>
    <input type="text" name="Remitente" id="Remitente" value="">
    <br>

    <label for="Dirigido">{{'Dirigido'}}</label>
    <input type="text" name="Dirigido" id="Dirigido" value="">
    <br>

    <label for="Particular">{{'Particular'}}</label>
    <input type="text" name="Particular" id="Particular" value="">
    <br>

    <label for="Asunto">{{'Asunto'}}</label>
    <input type="text" name="Asunto" id="Asunto" value="">
    <br>

    <label for="Foto">{{'Foto'}}</label>
    <input type="file" name="Foto" id="Foto" value="">
    <br>

    <input type="submit" value="Agregar">

</form>