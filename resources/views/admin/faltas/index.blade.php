@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header bg-red">
        <h4 class="card-title float-left">Fallos</h4>
        <input class="float-right" type="text" id="buscar" placeholder="Buscar fallos">
    </div>
    <div class="card-body">
        <div class="card-body" id="fallos">
            @foreach ($grupos as $grupo)
                <div class="card card-danger" id="fallo_{{ $loop->iteration }}">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            <a class="d-block w-100" data-toggle="collapse" href="#grupo_{{ $loop->iteration }}">
                                {{ $grupo->numero }}. {{ $grupo->grupo }}
                            </a>
                        </h4>
                    </div>
                    <div id="grupo_{{ $loop->iteration }}" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            @foreach($subGrupos->where('grupo_id',$grupo->id) as $subGrupo)
                                <h4>{{ $grupo->numero }}.{{ $subGrupo->orden }}@if ($subGrupo->suborden != 0).{{ $subGrupo->suborden }}@endif {{ $subGrupo->subgrupo }}</h4>
                                @foreach($faltas->where('subgrupo_id',$subGrupo->id) as $falta)
                                    <ul>
                                        <div id="fallos">
                                            @if ($falta->tipo == 'Leve')
                                                <p><span class="dot dot-leve"></span>{{ $falta->fallo }}</p>
                                            @elseif ($falta->tipo == 'Deficiente')
                                                <p><span class="dot dot-deficiente"></span>{{ $falta->fallo }}</p>
                                            @elseif ($falta->tipo == 'Eliminatoria')
                                                <p><span class="dot dot-eliminatoria"></span>{{ $falta->fallo }}</p>
                                            @endif
                                        </div>
                                    </ul>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script type="text/javascript">
$(document).ready(function(){
    $("#buscar").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $('div[id^="fallo_"]').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
@endsection