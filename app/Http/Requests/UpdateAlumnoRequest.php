<?php

namespace App\Http\Requests;

use App\Alumno;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateAlumnoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('alumno_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
            ],
        ];
    }
}