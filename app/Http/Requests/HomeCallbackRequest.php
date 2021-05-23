<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class HomeCallbackRequest
 *
 * @package App\Http\Requests
 */
class HomeCallbackRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Правила валыдації
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:50',
            'content' => 'required|max:300',
            'email' => 'required|max:50',
        ];
    }
}
