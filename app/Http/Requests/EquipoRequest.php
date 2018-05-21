<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipoRequest extends FormRequest
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
            'select_grupo' => 'required'
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
            'select_grupo.required'  => 'El id del grupo es obligatorio',
        ];
    }
}
