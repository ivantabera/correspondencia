<div class="form-group">
    <label class="control-label" for="name">{{'Nombre'}}</label>
    <input 
        type="text" 
        class="form-control {{ $errors->has('name') ? 'is-invalid' : ''  }}" 
        name="name" 
        id="name" 
        value="{{ isset($user->name) ? $user->name : old('name') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Nombre','<div class="invalid-feedback">:message</div>') !!}
</div>

<h3>Lista de roles</h3>

<div class="form-group">
    <ul class="list-unstyled">
        @foreach ($roles as $rol)
            <li>
                <label>
                    <input  type="checkbox" 
                            name="roles[]" 
                            value="{{ $rol->id }}" 
                            @if($user->roles->contains($rol->id)) 
                                checked=checked 
                            @endif
                    >
                    {{$rol->name}}
                    <em>({{$rol->description ?: 'No aplica' }})</em>
                </label>
            </li>
        @endforeach
    </ul>
</div>
<input type="submit" class="btn btn-success" value="{{$Modo == 'crear' ? 'Agregar' : 'Guardar'}}">
<a href="{{ url('users') }}" class="btn btn-primary">Regresar</a>