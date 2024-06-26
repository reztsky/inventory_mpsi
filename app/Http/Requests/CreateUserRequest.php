<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'roles'=>'required',
            'name'=>'required',
            'nik'=>'required|numeric|digits:16',
            'jenis_kelamin'=>['required',Rule::in(['L','P'])],
            'alamat'=>'required',
            'no_telfon'=>'required|numeric',
            'username'=>'required|unique:users,username',
            'password'=>'required|min:6',
        ];
    }
}
