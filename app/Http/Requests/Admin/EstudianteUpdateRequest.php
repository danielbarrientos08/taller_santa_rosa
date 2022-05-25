<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EstudianteUpdateRequest extends FormRequest
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
            'documento'         => 'bail|required|max:15|unique:estudiante,documento,'.$this->request->all()['estudiante_id'].',estudiante_id',
            'codigo_estudiante' => 'bail|required|digits:14|unique:estudiante,codigo_estudiante,'.$this->request->all()['estudiante_id'].',estudiante_id',
            'apellido_paterno'  => 'bail|required|max:40',
            'apellido_materno'  => 'bail|required|max:40',
            'nombres'           => 'bail|required|max:40',
            'fecha_nacimiento'  => 'bail|required|date',
            'estado_matricula'  => 'bail|required',
            'sexo'              => 'bail|required|in:Mujer,Varón',
            'grado'             => 'bail|required|in:PRIMERO,SEGUNDO,TERCERO,CUARTO,QUINTO',
            'seccion'           => 'bail|required',
        ];
    }
}
