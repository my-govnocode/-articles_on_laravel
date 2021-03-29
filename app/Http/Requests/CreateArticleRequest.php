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
        $rules = [
            'code' => 'required|regex:/[a-zA-Z0-9_\-]+/|unique:articles,code,',
            'title' => 'required|between:5,100',
            'short_message' => 'required|max:255',
            'message' => 'required',
        ];

        if ($this->route()->named('articles.update')) {
            $rules['code'] .= $this->article->id;
        }

        return $rules;
    }
}
