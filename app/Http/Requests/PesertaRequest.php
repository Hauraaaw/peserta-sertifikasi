<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class PesertaRequest extends BaseRequest
{
    public function rules(): array
    {
        $id = $this->route('peserta')?->id;

        return [
            'nomor_peserta' => ['required', 'string', 'max:30', Rule::unique('pesertas', 'nomor_peserta')->ignore($id)],
            'nik'           => ['required', 'digits:16', Rule::unique('pesertas', 'nik')->ignore($id)],
            'nama'          => ['required', 'string', 'max:150'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'email'         => ['required', 'email', 'max:150', Rule::unique('pesertas', 'email')->ignore($id)],
            'no_telepon'    => ['required', 'regex:/^[0-9+\-\s]{8,20}$/'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'alamat'        => ['required', 'string', 'max:500'],
            'skema_id'      => ['required', 'exists:skemas,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nomor_peserta' => 'Nomor peserta',
            'nik'           => 'NIK',
            'nama'          => 'Nama',
            'jenis_kelamin' => 'Jenis kelamin',
            'email'         => 'Email',
            'no_telepon'    => 'No. telepon',
            'tanggal_lahir' => 'Tanggal lahir',
            'alamat'        => 'Alamat',
            'skema_id'      => 'Skema sertifikasi',
        ];
    }
}
