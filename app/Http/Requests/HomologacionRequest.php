<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomologacionRequest extends FormRequest
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
          'asig_progra_id' =>'required',
          'nota' =>'required|numeric|min:0|max:5',
          'adenda' =>'required'
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
          //
      ];
  }
}
