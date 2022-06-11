<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAlumnoRequest;
use App\Http\Requests\StoreAlumnoRequest;
use App\Http\Requests\UpdateAlumnoRequest;
use App\App;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AlumnosController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('alumno_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alumno = Alumno::all();

        return view('admin.alumnos.index', compact('alumno'));
    }

    public function create()
    {
        abort_if(Gate::denies('alumno_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.alumnos.create');
    }

    public function store(StoreAlumnoRequest $request)
    {
        $alumno = Alumno::create($request->all());

        if ($request->input('photo', false)) {
            $alumno->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return redirect()->route('admin.alumno.index');
    }

    public function edit(Alumno $alumno)
    {
        abort_if(Gate::denies('alumno_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.alumnos.edit', compact('alumno'));
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

        return redirect()->route('admin.alumno.index');
    }

    public function show(Alumno $alumno)
    {
        abort_if(Gate::denies('alumno_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.alumnos.show', compact('alumno'));
    }

    public function destroy(Alumno $alumno)
    {
        abort_if(Gate::denies('alumno_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alumno->delete();

        return back();
    }

    public function massDestroy(MassDestroyAlumnoRequest $request)
    {
        Alumno::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
