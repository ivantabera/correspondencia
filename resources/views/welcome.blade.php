<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Correspondencia</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        {{-- <a href="{{ url('/home') }}">Home</a> --}}

                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Cerrar Sesión') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}">Iniciar Sesión</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Registrate</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Correspondencia STC
                </div>

                <div class="links">
                    @can('correspondencia.index')
                        <a href="{{ url('correspondencia') }}">Correspondencia</a>
                    @endcan
                    @can('promoremit.index')
                        <a href="{{ url('promoremit') }}">Promotores y remitentes</a>
                    @endcan
                    @can('destinatario.index')
                        <a href="{{ url('destinatario') }}">Destinatarios</a>
                    @endcan
                    @can('expedientes.index')
                        <a href="{{ url('expedientes') }}">Expedientes</a>
                    @endcan
                    @can('dirigido.index')
                        <a href="{{ url('dirigido') }}">Dirigido</a>
                    @endcan
                    @can('tipodocumento.index')
                        <a href="{{ url('tipodocumento') }}">Tipos de documento</a>
                    @endcan
                    @can('users.index')
                        <a href="{{ url('users') }}">Usuarios</a>
                    @endcan
                    @can('roles.index')
                        <a href="{{ url('roles') }}">Roles</a>
                    @endcan
                </div>
            </div>
        </div>
    </body>
</html>
