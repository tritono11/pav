<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfiloPost extends FormRequest
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
            't_nome'            => 'required',
            't_cognome'         => 'required',
            't_sesso'           => 'required',
            'd_nascita'         => 'required|date',
            't_comune_nascita'  => 'required',
            't_cf'              => ['required',
                                    'regex:/^(?:[B-DF-HJ-NP-TV-Z](?:[AEIOU]{2}|[AEIOU]X)|[AEIOU]{2}X|[B-DF-HJ-NP-TV-Z]{2}[A-Z]){2}[\dLMNP-V]{2}(?:[A-EHLMPR-T](?:[04LQ][1-9MNP-V]|[1256LMRS][\dLMNP-V])|[DHPS][37PT][0L]|[ACELMRT][37PT][01LM])(?:[A-MZ][1-9MNP-V][\dLMNP-V]{2}|[A-M][0L](?:[\dLMNP-V][1-9MNP-V]|[1-9MNP-V][0L]))[A-Z]$/i'],
            't_piva'            => 'required',
            't_ci'              => 'required',
            't_patente'         => 'required',
            't_telefono'        => 'required',
            't_indirizzo'       => 'required',
            't_numero_civico'   => 'required',
            't_cap'             => 'required',
            't_comune'          => 'required',
            't_provincia'       => 'required',
            't_regione'         => 'required',
            't_stato'           => 'required',
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
            //'t_nome.required'       => 'A title is required',
            //'t_cognome.required'    => 'A message is required',
        ];
    }
}
