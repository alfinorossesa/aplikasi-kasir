<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataMenuRequest extends FormRequest
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
            'nama_menu' => 'required|max:255',
            'harga' => 'required|numeric|min:1',
            'kategori' => 'required',
            'photo' => 'required|image|mimes:jpg,png|file|max:1024',
        ];
    }
}
