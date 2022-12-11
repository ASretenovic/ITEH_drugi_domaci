<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // default vrednost je false
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
                'title' => 'required|unique:books',
                'author' => 'required',
                'excerpt' => 'required',
                'number_of_pages' => 'required',
                'category' => 'required'
            ];
    }
}
