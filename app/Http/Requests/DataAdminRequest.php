<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataAdminRequest extends FormRequest
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
            'nama' => 'required|max:255',
            'username' => 'required|max:25|unique:users',
            'no_telepon' => 'required|min:11|max:13',
            'role' => 'required',
            'password' => 'required|min:8|max:12',
        ];
    }
}
