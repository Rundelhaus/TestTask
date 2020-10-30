<?php

namespace App\Http\Requests;

use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users, email',
            'password' => 'required|confirmed',
            'birth' => 'required|date_format:d.m.Y',
            'sex' => 'required|string',
        ];

        switch ($this->user_type) {
            case 'student':
                return [
                        'entry' => 'required|date_format:d.m.Y',
                        'grade' => 'integer|required|min:1|max:11',
                        'parallel' => 'required|size:1|string',
                        'user_id' => 'required|integer|exists:users,id',
                    ] + $rules;

            case 'teacher':
                return [

                    'employment_date' => 'required|date_format:d.m.Y',
                    'layoff_date' => 'required|date_format:d.m.Y',
                    'user_id' => 'required|integer|exists:users,id',
                ] + $rules;
        }
    }
}
