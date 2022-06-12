@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('css.adminltev3') }}">
<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.users.store") }}" method="POST" enctype="multipart/form-data" >
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-md-6 form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
                    <label for="nombre">{{ trans('cruds.user.fields.nombre') }}*</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', isset($user) ? $user->nombre : '') }}" required>
                    @if($errors->has('nombre'))
                        <p class="help-block">
                            {{ $errors->first('nombre') }}
                        </p>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.user.fields.nombre_helper') }}
                    </p>
                </div>
                <div class="col-md-6 form-group {{ $errors->has('apellidos') ? 'has-error' : '' }}">
                    <label for="apellidos">{{ trans('cruds.user.fields.apellidos') }}*</label>
                    <input type="text" id="apellidos" name="apellidos" class="form-control" value="{{ old('apellidos', isset($user) ? $user->apellidos : '') }}" required>
                    @if($errors->has('apellidos'))
                        <p class="help-block">
                            {{ $errors->first('apellidos') }}
                        </p>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.user.fields.apellidos_helper') }}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 form-group {{ $errors->has('dni') ? 'has-error' : '' }}">
                    <label for="dni">{{ trans('cruds.user.fields.dni') }}*</label>
                    <input type="text" id="dni" name="dni" class="form-control" value="{{ old('dni', isset($user) ? $user->dni : '') }}" required>
                    @if($errors->has('dni'))
                        <p class="help-block">
                            {{ $errors->first('dni') }}
                        </p>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.user.fields.dni_helper') }}
                    </p>
                </div>
                <div class="col-md-4 form-group {{ $errors->has('fecha_nacimiento') ? 'has-error' : '' }}"" >
                    <label for="fecha_nacimiento">{{ trans('cruds.user.fields.fecha_nacimiento') }}*</label>
                    <input id="fecha_nacimiento" name="fecha_nacimiento" class="date-picker form-control parsley-error" value="{{ old('fecha_nacimiento', isset($fecha_nacimiento) ? $user->fecha_nacimiento : '') }}" placeholder="dd/mm/yyyy" type="date" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)" data-parsley-id="16"/>
                </div>
                <div class="col-sm-2 offset-sm-1 form-group {{ $errors->has('teorico') ? 'has-error' : '' }}">
                    <label for="teorico pl-2">{{ trans('cruds.user.fields.teorico') }}*</label>
                    <div class="row">
                        <label class="font-weight-bold col-md-2" for="customSwitches">No</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="teorico" class="custom-control-input" id="customSwitches" />
                            <input type="hidden" name="teorico" value="No" id="teorico_hidden"/>
                            <label class="custom-control-label" for="customSwitches">Si</label>
                        </div>
                    </div>
                    <p class="helper-block">
                        {{ trans('cruds.user.fields.teorico_helper') }}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group {{ $errors->has('telefono') ? 'has-error' : '' }}">
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
                <div class="col-md-4 form-group {{ $errors->has('email') ? 'has-error' : '' }}">
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
                <div class="col-md-4 form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password">{{ trans('cruds.user.fields.password') }}</label>
                    <input type="text" id="password" name="password" class="form-control" value="{{ Str::random(8) }}" required>
                    @if($errors->has('password'))
                        <p class="help-block">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.user.fields.password_helper') }}
                    </p>
                </div>
            </div>
            <div class="row">
            <div class="col-md-6 form-group {{ $errors->has('roles_id') ? 'has-error' : '' }}">
                <label for="roles_id">Tipo de usuario*</label>
                <select class="form-control" name="roles_id" id="roles_id" required>
                    @foreach ($roles as $rol)
                        @if ($rol->id == 2)
                            <option value="{{ $rol->id }}" selected>{{ $rol->title }}</option>
                        @elseif($rol->id == 4)
                        
                        @else
                            <option value="{{ $rol->id }}">{{ $rol->title }}</option>
                        @endif
                    @endforeach
                </select>
                @if($errors->has('roles_id'))
                    <p class="help-block">
                        {{ $errors->first('roles_id') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.roles_helper') }}
                </p>
            </div>
            <div class="col-md-6 pb-3">
                <label for="instructor_id">Selecciona un Instructor*</label>
                <select name="instructor_id" class="form-control" id="instructor_id">
                    <option value="">Es un Instructor o un Administrativo</option>
                    @foreach ($instructores as $instructor)
                        <option value="{{ $instructor->id }}">{{ $instructor->nombre }} {{ $instructor->apellidos }}</option>
                    @endforeach
                </select>
            </div>
        </div>
            <!-- DROPZONE PARA FOTOS
            
            -->
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>

<script type="text/javascript">
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