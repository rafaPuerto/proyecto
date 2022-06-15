@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.clases.title_singular') }} {{ trans('cruds.clases.practicas.title_singular') }}
    </div>

    <div class="card-body">
        
        <form action="{{ route('admin.clases.update', [$clase->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div id="timer" class="d-flex justify-content-center row">
                <h3 class="col-sm-1">
                    <div class="row" id="reloj">
                        <div id="hour" class="">00</div>
                        <div class="divider">:</div>
                        <div id="minute" class="">00</div>
                        <div class="divider">:</div>
                        <div id="second" class="">00</div>                
                    </div>
                </h3>
                <button class="col-sm-1" id="btn-comenzar" type="button">Pausar Clase</button>
            </div>
            <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                <label for="comentarios">{{ trans('cruds.clases.fields.comentarios') }}</label>
                <textarea id="comentarios" name="comentarios" class="form-control ">{{ old('value', isset($clase) ? $clase->comentarios : '') }}</textarea>
                @if($errors->has('comentarios'))
                    <p class="help-block">
                        {{ $errors->first('comentarios') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.clases.fields.comentarios_helper') }}
                </p>
            </div>
            <div>
                <button class="btn btn-danger btn-circle btn-xl" id="btn-finalizar" type="submit"><i class="fas fa-check-circle"></i></button>
            </div>
        </form>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
$(document).ready(function(){
var tiempo = {
    hora: 0,
    minuto: 0,
    segundo: 0
};

var tiempo_corriendo = null;

    tiempo_corriendo = setInterval(function(){
        // Segundos
        tiempo.segundo++;
        if(tiempo.segundo >= 60)
        {
            tiempo.segundo = 0;
            tiempo.minuto++;
        }      

        // Minutos
        if(tiempo.minuto >= 60)
        {
            tiempo.minuto = 0;
            tiempo.hora++;
        }

        $("#hour").text(tiempo.hora < 10 ? '0' + tiempo.hora : tiempo.hora);
        $("#minute").text(tiempo.minuto < 10 ? '0' + tiempo.minuto : tiempo.minuto);
        $("#second").text(tiempo.segundo < 10 ? '0' + tiempo.segundo : tiempo.segundo);
    }, 1000);

    $("#btn-comenzar").click(function(){
        if($(this).text() == "Pausar Clase"){
            $(this).text("Continuar Clase");
            clearInterval(tiempo_corriendo);
        }else{
            $(this).text("Pausar Clase");
            tiempo_corriendo = setInterval(function(){
                // Segundos
                tiempo.segundo++;
                if(tiempo.segundo >= 60)
                {
                    tiempo.segundo = 0;
                    tiempo.minuto++;
                }

                // Minutos
                if(tiempo.minuto >= 60)
                {
                    tiempo.minuto = 0;
                    tiempo.hora++;
                }

                $("#hour").text(tiempo.hora < 10 ? '0' + tiempo.hora : tiempo.hora);
                $("#minute").text(tiempo.minuto < 10 ? '0' + tiempo.minuto : tiempo.minuto);
                $("#second").text(tiempo.segundo < 10 ? '0' + tiempo.segundo : tiempo.segundo);
            }, 1000);
        }
    });
});
</script>