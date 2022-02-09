<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MuserUpdateRequest extends FormRequest
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
    'login'=>'max:255',
    'name' => 'required|max:255',
    'cat_id' => 'required|max:255',
    'vez_id' => 'required|max:255',
    'qeyd' => 'max:255',

        ];
    }
}
