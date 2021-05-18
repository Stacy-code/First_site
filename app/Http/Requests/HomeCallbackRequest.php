<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeCallbackRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'content' => 'required|max:512',
            'email' => 'required|unique:callback|max:255',


        ];
    }
}
