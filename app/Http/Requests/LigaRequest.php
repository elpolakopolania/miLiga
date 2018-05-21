<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LigaRequest extends FormRequest
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
            'input_nombre' => 'required',
            'input_fecha_ini' => 'required',
            'input_fecha_fin' => 'required'
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
            'input_nombre.required' => 'El nombre de la liga es obligatorio',
            'input_fecha_ini.required'  => 'La fecha inicial es obligatoria',
            'input_fecha_fin.required'  => 'La fecha final es obligatoria',
        ];
    }
}
