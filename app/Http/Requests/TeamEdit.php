<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamEdit extends FormRequest
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
            'league_id' => 'required',
            'name_mm' => 'required',
            'name_en' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'league_id.required' => 'The league field is required'
        ];
    }
}
