<?php

namespace App\Http\Requests;

use App\Models\Skema;
use Illuminate\Validation\Rule;

class SkemaRequest extends BaseRequest
{
    public function rules(): array
    {
        $id = $this->route('skema')?->id;

        return [
            'kode_skema' => ['required', 'string', 'max:30', Rule::unique('skemas', 'kode_skema')->ignore($id)],
            'nama_skema' => ['required', 'string', 'max:150'],
            'jenis'      => ['required', Rule::in(Skema::JENIS)],
            'deskripsi'  => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'kode_skema' => 'Kode skema',
            'nama_skema' => 'Nama skema',
            'jenis'      => 'Jenis skema',
            'deskripsi'  => 'Deskripsi',
        ];
    }
}
