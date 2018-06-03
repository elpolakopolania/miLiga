<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JugadorRequest extends FormRequest
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
            'select_equipo' => 'required',
            'select_tipoDoc' => 'required',
            'input_doc' => 'required',
            'input_nombre' => 'required',
            'input_apellido' => 'required',
            'select_genero' => 'required',
            'input_fecha_nac' => 'required',
            'input_correo' => 'email'
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
            'select_liga.required' => 'Elige una liga',
            'select_equipo.required'  => 'Elige un equipo',
            'select_tipoDoc.required'  => 'Elige un tipo de documento',
            'input_doc.required'  => 'El número de documento es obligatorio',
            'input_nombre.required'  => 'El nombre es obligatorio',
            'input_apellido.required'  => 'El apellido es obligatorio',
            'select_genero.required'  => 'El género es obligatorio',
            'input_fecha_nac.required'  => 'La fecha de nacimiento es obligatoria',
            'input_correo.email' => 'El campo correo no corresponde con una dirección de e-mail válida.'
        ];
    }
}
