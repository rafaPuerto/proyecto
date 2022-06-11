@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.users.update", [$user->id]) }}" method="POST" enctype="multipart/form-data" >
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
                <label for="nombre">{{ trans('cruds.user.fields.nombre') }}</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', isset($user->nombre) ? $user->nombre : '') }}" >
                @if($errors->has('nombre'))
                    <p class="help-block">
                        {{ $errors->first('nombre') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.nombre_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('apellidos') ? 'has-error' : '' }}">
                <label for="apellidos">{{ trans('cruds.user.fields.apellidos') }}</label>
                <input type="text" id="apellidos" name="apellidos" class="form-control" value="{{ old('apellidos', isset($user) ? $user->apellidos : '') }}" >
                @if($errors->has('apellidos'))
                    <p class="help-block">
                        {{ $errors->first('apellidos') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.apellidos_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('dni') ? 'has-error' : '' }}">
                <label for="dni">{{ trans('cruds.user.fields.dni') }}</label>
                <input type="text" id="dni" name="dni" class="form-control" value="{{ old('dni', isset($user) ? $user->dni : '') }}" >
                @if($errors->has('dni'))
                    <p class="help-block">
                        {{ $errors->first('dni') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.dni_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('fecha_nacimiento') ? 'has-error' : '' }}">
                <div class="col-md-6 col-sm-6 ">
                    <label for="fecha_nacimiento">{{ trans('cruds.user.fields.fecha_nacimiento') }}</label>
                    <input id="fecha_nacimiento" name="fecha_nacimiento" class="date-picker form-control parsley-error"  value="{{ old('fecha_nacimiento', isset($user) ? $user->fecha_nacimiento : '') }}" placeholder="dd-mm-aaaa" type="date" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" data-parsley-id="16"/>
                </div>
            </div>
            <div class="form-group {{ $errors->has('telefono') ? 'has-error' : '' }}">
                <label for="telefono">{{ trans('cruds.user.fields.telefono') }}</label>
                <input type="text" id="telefono" name="telefono" class="form-control" value="{{ old('telefono', isset($user) ? $user->telefono : '') }}">
                @if($errors->has('telefono'))
                    <p class="help-block">
                        {{ $errors->first('telefono') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.telefono_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('teorico') ? 'has-error' : '' }}">
                <label for="teorico">{{ trans('cruds.user.fields.teorico') }}</label>
                <div class="form-inline">
                    <label class="font-weight-bold pr-2" for="customSwitches">No</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="teorico" class="custom-control-input" id="customSwitches" @if($user->teorico == 'Si') checked @endif  />
                        <input type="hidden" name="teorico" value="{{ $user->teorico  }}" id="teorico_hidden"/>
                        <label class="custom-control-label" for="customSwitches">Si</label>
                    </div>
                </div>
                <p class="helper-block">
                    {{ trans('cruds.user.fields.teorico_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('cruds.user.fields.email') }}</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}">
                @if($errors->has('email'))
                    <p class="help-block">
                        {{ $errors->first('email') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.email_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password">{{ trans('cruds.user.fields.password') }}</label>
                <input type="text" id="password" name="password" class="form-control" >
                <a class="btn btn-danger" onClick="javascript:regenerarContraseña();">Regenerar contraseña</a>
                @if($errors->has('password'))
                    <p class="help-block">
                        {{ $errors->first('password') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.password_helper') }}
                </p>
            </div>
            <div>
                <select name="instructor_id" class="form-control" id="instructor_id">
                    @foreach ($instructores as $instructor)
                        <option value="{{ old('instructor_id', isset($instructor) ? $instructor->id : '') }}" @if ($user->instructor_id == $instructor->id) selected @endif>{{ $instructor->nombre }} {{ $instructor->apellidos }}</option>
                    @endforeach
                </select>
            </div>
            <!-- DROPZONE PARA FOTOS
            
            -->
            <div>
                <input class="btn btn-close" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>

<script type="text/javascript">
    function regenerarContraseña(){
            $('#password').val("{{ Str::random(8) }}");
        }

$(document).ready(function () {
    $('#customSwitches').change(function(event) {
        if($(this).next().val() == 'No')
        {
            $(this).next().val('Si');
        }
        else
        {
            $(this).next().val('No');
        }
    });

    $("#datetime").datetimepicker({
        format: 'yyyy-mm-dd hh:ii'
    });

    

    //DROPZONE
    /*var uploadedPhotosMap = {}
    Dropzone.options.photosDropzone = {
    url: '{{ route('admin.users.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    dictDefaultMessage: "Foto de perfíl",
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
        size: 2,
        width: 4096,
        height: 4096
    },
    success: function (file, response) {
        $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
        uploadedPhotosMap[file.name] = response.name
    },
    removedfile: function (file) {
        console.log(file)
        file.previewElement.remove()
        var name = ''
        if (typeof file.file_name !== 'undefined') {
        name = file.file_name
        } else {
        name = uploadedPhotosMap[file.name]
        }
        $('form').find('input[name="photos[]"][value="' + name + '"]').remove()
    },
    init: function () {
    @if(isset($user) && $user->photos)
        var files =
        {!! json_encode($user->photos) !!}
            for (var i in files) {
            var file = files[i]
            this.options.addedfile.call(this, file)
            this.options.thumbnail.call(this, file, file.url)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
        }
    @endif
    },
        error: function (file, response) {
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error')
            _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _results = []
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i]
                _results.push(node.textContent = message)
            }

            return _results
        }
    }*/
});
</script>
@endsection