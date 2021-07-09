<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'code' => 'required|regex:/[a-zA-Z0-9_\-]+/|unique:news,code,',
            'title' => 'required|between:5,100',
            'short_message' => 'required|max:255',
            'message' => 'required',
            'tags' => 'nullable|string'
        ];

        if ($this->route()->named('news.update')) {
            $rules['code'] .= $this->news->id;
        }

        return $rules;
    }
}
