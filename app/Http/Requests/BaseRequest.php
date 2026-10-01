<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'max'      => ':attribute maksimal :max karakter.',
            'email'    => 'Format :attribute tidak valid.',
            'unique'   => ':attribute sudah digunakan.',
            'exists'   => ':attribute yang dipilih tidak valid.',
            'date'     => 'Format :attribute tidak valid.',
            'before'   => ':attribute harus sebelum hari ini.',
            'regex'    => 'Format :attribute tidak valid.',
            'in'       => ':attribute yang dipilih tidak valid.',
            'digits'   => ':attribute harus terdiri dari :digits digit angka.',
        ];
    }
}
