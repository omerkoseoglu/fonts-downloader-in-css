<?php

namespace App\Http;

use Illuminate\Foundation\Http\FormRequest;

class FontDownloadRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'files' => [
                'required',
                'array',
            ],
            'files.*' => [
                'file',
                'mimetypes:text/plain'
            ]
        ];
    }
}
