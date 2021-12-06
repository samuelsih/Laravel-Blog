<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'min:10', 'max:80'],
            'slug' => ['required', 'unique:posts', 'min:5', 'max:40'],
            'description' => ['required', 'min:20', 'max:100'],
            'content' => ['required', 'min:50', 'max:1000'],
        ];
    }
}
