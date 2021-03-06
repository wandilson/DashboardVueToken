<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
            'name_first'  =>  'required',
            'cpf'   =>  ['required', 'unique:users,cpf,'.$this->id],
            'email' =>  ['required', 'unique:users,email,'.$this->id]
        ];
    }
}
