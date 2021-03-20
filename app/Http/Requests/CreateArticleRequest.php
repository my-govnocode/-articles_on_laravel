<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateArticleRequest extends FormRequest {
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code' => 'required|unique:articles,id|regex:/[a-zA-Z0-9_\-]+/',
            'title' => 'required||between:5,100',
            'short_message' => 'required|max:255',
            'message' => 'required',
        ];
    }
}