<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GrupoRequest extends FormRequest
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
            'select_liga' => 'required',
            'input_nombre' => 'required',
            'input_clasifican' => 'required'
        ];
    }

    /**
   * Get the error messages for the defined validation rules.
   *
   * @return array
   */
    public function messages()
    {
        return [
            'select_liga.required' => 'El id de la liga es obligatorio',
            'input_nombre.required'  => 'La nombre es obligatorio',
            'input_clasifican.required'  => 'La cantidad de equipos que clasifican es obligatorio',
            'grupo_id.required'  => 'El id del grupo es obligatorio',
        ];
    }
}
