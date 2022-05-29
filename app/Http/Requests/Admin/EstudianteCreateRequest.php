<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EstudianteCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'documento'         => 'bail|required|unique:estudiante|max:15',
            // 'codigo_estudiante' => 'bail|required|unique:estudiante|digits:14',
            'apellido_paterno'  => 'bail|required|max:40',
            'apellido_materno'  => 'bail|required|max:40',
            'nombres'           => 'bail|required|max:40',
            'fecha_nacimiento'  => 'bail|required|date',
            'nivel'             => 'bail|required|in:INICIAL,PRIMARIA,SECUNDARIA',
            'grado'             => 'bail|required|in:PRIMERO,SEGUNDO,TERCERO,CUARTO,QUINTO',
            'seccion'           => 'bail|required',
        ];
    }
}
