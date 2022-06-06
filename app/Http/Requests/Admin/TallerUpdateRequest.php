<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TallerUpdateRequest extends FormRequest
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
            'cod_taller' => 'bail|required|max:100',
            'nombre'     => 'bail|required|max:100|unique:taller,nombre,'.$this->request->all()['taller_id'].',taller_id',
            'vacantes'   => 'bail|required|numeric',
            'estado'     => 'bail|required|in:Activo,Inactivo',
        ];
    }
}
