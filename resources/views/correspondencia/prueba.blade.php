@foreach($users as $correspon)
    {{$correspon->referencia}}
    {{$correspon->promo}}
    {{$correspon->hola}}
    <br>
@endforeach

@foreach($correspondencia as $hola)
<p>Hola mundo *****</p>
    {{$hola->referencia}}
    {{$hola->promotor}}
    {{$hola->remitente}}
    {{$hola->dirigido}}
    
    <br>
@endforeach