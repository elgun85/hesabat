<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MuserRequest extends FormRequest
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
    'login'=>'max:255|unique:mhm_logins',
    'name' => 'required|min:2|max:255',
    'cat_id' => 'required|max:255',
    'vez_id' => 'required|max:255',
    'qeyd' => 'max:255',

        ];
    }


        public function attributes()
    {
        return [
            'login'=>'İstifadəçi adı ',
            'name' =>'Ad,soyad  xanası',
            'cat_id' =>'Şöbə xanası',
            'vez_id' =>'Vəzifə xanası',
            'qeyd' =>'Qeyd xanası',

        ];
    }
}
