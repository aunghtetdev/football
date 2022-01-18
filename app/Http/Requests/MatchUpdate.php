<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatchUpdate extends FormRequest
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
            'home_team_id' => 'required',
            'away_team_id' => 'required',
            'home_team_goal' => 'required',
            'away_team_goal' => 'required',
            'finished' => 'required',
            'date' => 'required'
        ];
    }
}
