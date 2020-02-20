<div class="form-group">
    <label class="control-label" for="name">{{'Nombre'}}</label>
    <input 
        type="text" 
        class="form-control 
        {{ $errors->has('name') ? 'is-invalid' : ''  }}" 
        name="name" 
        id="name" 
        value="{{ isset($roles->name) ? $roles->name : old('name') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Nombre','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="slug">{{'Url Amigable'}}</label>
    <input 
        type="text" 
        class="form-control 
        {{ $errors->has('slug') ? 'is-invalid' : ''  }}" 
        name="slug" 
        id="slug" 
        value="{{ isset($roles->slug) ? $roles->slug : old('slug') }}">
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Slug','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label class="control-label" for="description">{{'Descripción'}}</label>
    <textarea 
        id="description" 
        class="form-control {{ $errors->has('description') ? 'is-invalid' : ''  }}"
        rows="4" 
        cols="50"
        name="description">{{ isset($roles->description) ? $roles->description : old('description') }}</textarea>
    <!--mensaje para mostrar el error si el formulario viene vacio o formato invalido-->
    {!! $errors->first('Descripción','<div class="invalid-feedback">:message</div>') !!}
</div>

<h3>Permiso especial</h3>
<div class="form-group">
    <label class="radio-inline">
        <input 
            type="radio" 
            name="special" 
            value="all-access" 
            @if($roles->special == 'all-access') 
            checked=checked 
            @endif
        >
        Acceso total
    </label>
    <label class="radio-inline">
        <input 
            type="radio" 
            name="special" 
            value="no-access"
            @if($roles->special == 'no-access') 
            checked=checked 
            @endif
        >
        Ningun acceso
    </label>
</div>

<hr>

<h3>Lista de permisos</h3>

<div class="form-group">
    <ul class="list-unstyled">
        @foreach ($permisos as $permission)
            <li>
                <label>
                    <input  type="checkbox" 
                            name="permisos[]" 
                            value="{{ $permission->id }}" 
                            @if($roles->permissions->contains($permission->id)) 
                                checked=checked 
                            @endif
                    >
                    {{$permission->name}}
                    <em>({{$permission->description ?: 'No aplica' }})</em>
                </label>
            </li>
        @endforeach
    </ul>
</div>

<input type="submit" class="btn btn-success" value="{{$Modo == 'crear' ? 'Agregar' : 'Modificar'}}">
<a href="{{ url('roles') }}" class="btn btn-primary">Regresar</a>