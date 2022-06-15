@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.clases.title_singular') }} {{ trans('cruds.clases.practicas.title_singular') }}
    </div>
    <div class="card-body">
        <form action="{{ route("admin.clases.update", [$clase->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div id="ruta" class="pb-2">
                <select class="form-control " name="recorrido" required >
                    <option value="">Selecciona una</option>
                    <option value="Zona 1">Ruta 1</option>
                    <option value="Zona 2">Ruta 2</option>
                    <option value="Zona 3">Ruta 3</option>
                    <option value="Zona 4">Ruta 4</option>
                    <option value="Zona 5">Ruta 5</option>
                </select>
            </div>
            <div id="faltas">
                <div class="card card-danger">
                    <a class="d-block" data-toggle="collapse" href="#fallos">
                        <div class="card-header row">
                            <h4 class="card-title float-left">
                                Fallos
                            </h4>
                        </div>
                    </a>
                    <div id="fallos" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            @foreach ($grupos as $grupo)
                                <div class="card card-danger">
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
                                                            <input type="checkbox" name="faltas[]" value="{{ $falta->id }}" id="r{{ $falta->id }}"/>
                                                            @if ($falta->tipo == 'Leve')
                                                                <label class="fallo" for="r{{ $falta->id }}"><span class="dot dot-leve"></span>{{ $falta->fallo }}</label>
                                                            @elseif ($falta->tipo == 'Deficiente')
                                                                <label class="fallo" for="r{{ $falta->id }}"><span class="dot dot-deficiente"></span>{{ $falta->fallo }}</label>
                                                            @elseif ($falta->tipo == 'Eliminatoria')
                                                                <label class="fallo" for="r{{ $falta->id }}"><span class="dot dot-eliminatoria"></span>{{ $falta->fallo }}</label>
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
            </div>
            <div>
                <button class="btn btn-danger btn-circle btn-xl" id="btn-finalizar" type="submit"><i class="fas fa-check-circle"></i></button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script type="text/javascript">
/*
$(document).ready(function(){
  $("#buscar").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#fallos *").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
*/
</script>
@endsection
