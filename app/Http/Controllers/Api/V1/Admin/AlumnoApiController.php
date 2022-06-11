<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAlumnoRequest;
use App\Http\Requests\UpdateAlumnoRequest;
use App\Http\Resources\Admin\AlumnoResource;
use App\Alumno;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AlumnoApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('alumno_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AlumnoResource(Alumno::all());
    }

    public function store(StoreAlumnoRequest $request)
    {
        $alumno = Alumno::create($request->all());

        if ($request->input('photo', false)) {
            $alumno->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return (new AlumnoResource($alumno))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Alumno $alumno)
    {
        abort_if(Gate::denies('alumno_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AlumnoResource($alumno);
    }

    public function update(UpdateAlumnoRequest $request, Alumno $alumno)
    {
        $alumno->update($request->all());

        if ($request->input('photo', false)) {
            if (!$alumno->photo || $request->input('photo') !== $alumno->photo->file_name) {
                $alumno->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($alumno->photo) {
            $alumno->photo->delete();
        }

        return (new AlumnoResource($alumno))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Alumno $alumno)
    {
        abort_if(Gate::denies('alumno_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alumno->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
