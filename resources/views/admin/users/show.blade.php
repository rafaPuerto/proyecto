@extends('layouts.admin')
@section('content')
@if (Auth::user()->hasRole('Instructor'))
<div>
    <form action="{{ route('admin.clases.create', compact('user')) }}" method="GET">
        @method('GET')
        @csrf
        <label for="verificacion">Introduce el código de verificacion del alumno: </label>
        <input type="text" name="verificacion" id="verificacion">
        <input type="text" name="user" value="{{ $user->id }}" hidden>
        <button class="btn btn-app bg-danger" type="submit"><p class='text-bright'><i class='fas fa-play'></i> Empezar Clase Práctica </p></button>
    </form>
</div>
@endif
@if (Auth::user()->hasRole('Alumno'))
<div>
    <label for="verificacion_alumno">Mostrar código de verificación: </label>
    <input type="text" name="verificacion_alumno" id="verificacion_alumno" value="*****" disabled>
    <button class="btn btn-app bg-danger" onclick="mostrarVerificacion()" value="Mostrar">Mostrar</button>
</div>
@endif
<div class="card">
    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.nombre') }}
                        </th>
                        <td>
                            {{ $user->nombre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.apellidos') }}
                        </th>
                        <td>
                            {{ $user->apellidos }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.dni') }}
                        </th>
                        <td>
                            {{ $user->dni }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.fecha_nacimiento') }}
                        </th>
                        <td>
                            {{ \Carbon\Carbon::createFromFormat('Y-m-d',$user->fecha_nacimiento)->format('d/m/Y') }}<br>{{ " Edad: ".$user->age()." años." }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.telefono') }}
                        </th>
                        <td>
                            {{ $user->telefono }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <h3 class="d-inline pr-5">CLASES PRÁCTICAS</h3><h4 class="d-inline">Cantidad de clases: {{ count($clases) }}</h4>
            <div class="row pt-4">
                @foreach($clases as $clase)
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <a class="card bg-light d-flex flex-fill" href="{{ route('admin.clases.show', $clase) }}">
                            <div class="card-header text-muted border-bottom-0">
                                <p class="badge badge-success">{{ count($clases)-$loop->index }}</p>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>Día: {{ $clase->hora_inicio->format('d/m/Y') }}</b></h2>
                                        <h2 class="lead"><b>Hora: {{ $clase->hora_inicio->format('H:i') }}</b></h2>
                                        <h5><small>     </small></h5>
                                        <p class="text-muted text-sm"><b>Ruta: </b> {{ $clase->recorrido }} </p>
                                    </div>
                                </div>
                            </div>            
                        </a>
                    </div>
                @endforeach
            </div>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
@include('sweetalert::alert')
@endsection
<script type="text/javascript">
    function mostrarVerificacion(){
        $('#verificacion_alumno').attr('value','{{ $user->cadena_unica }}');
    };
</script>