@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.clases.title_singular') }} {{ trans('cruds.clases.practicas.title_singular') }}
    </div>
    
    <div class="card-body">
            <p>Dia de la clase: {{ $clase->hora_inicio->format('d/m/Y') }} </p>
            <p>Inicio de la clase: {{ $clase->hora_inicio->format('H:i') }} </p>
            <p>Faltas: 
                <ul>
                @foreach ( $clase->faltas as $falta)
                    <li>{{ $falta->fallo }}</li>    
                @endforeach
                </ul>
            </p>
            <p>Final de la clase: {{ $clase->hora_final->format('H:i') }}</p>
            <p>Duración: {{ $clase->hora_inicio->diffInMinutes($clase->hora_final) }} minutos</p>
            
    </div>
</div>
@endsection
