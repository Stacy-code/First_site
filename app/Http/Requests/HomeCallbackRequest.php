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
            'name' => 'required|max:50',
            'content' => 'required|max:300',
            'email' => 'required|max:50',


        ];
    }
}
