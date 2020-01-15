Seccion para crear correspondencia

<form action="{{ url('/correspondencia') }}" method="POST" enctype="multipart/form-data">
    
    <!--imprime una llave "token" de acceso para que nos deje entrar a la funcion -->
    {{ csrf_field() }}

    <!--Incluir contenido  y enviar variable Modo=crear para saber en que modo poner el formulario-->
    @include('correspondencia.formulario', ['Modo'=>'crear'])

</form>