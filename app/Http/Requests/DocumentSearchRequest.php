<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentSearchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'search' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'year' => 'nullable|integer|min:2000|max:' . (date('Y') + 1),
            'per_page' => 'nullable|integer|min:5|max:50',
        ];
    }

    public function messages()
    {
        return [
            'year.min' => 'Tahun tidak sah.',
            'year.max' => 'Tahun tidak sah.',
            'per_page.min' => 'Minimum 5 dokumen per halaman.',
            'per_page.max' => 'Maksimum 50 dokumen per halaman.',
        ];
    }
}
