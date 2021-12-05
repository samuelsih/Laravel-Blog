<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PivotTableRequest extends FormRequest
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
        //validasi untuk table pivot category_post 
        return [
            'post_id' => ['unique:category_post,required'],
            'user_id' => ['unique:category_post,required'],
        ];
    }
}
