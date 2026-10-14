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
            'nama'          => ['required', 'string', 'max:150', 'regex:/^[a-zA-Z\s\.\,\'\-]+$/'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'email'         => ['required', 'email:dns,rfc', 'max:150', Rule::unique('pesertas', 'email')->ignore($id)],
            'no_telepon'    => ['required', 'numeric', 'digits_between:8,13'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'alamat'        => ['required', 'string', 'max:500'],
            'skema_id'      => ['required', 'exists:skemas,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.regex'                => 'Nama lengkap tidak boleh mengandung angka.',
            'nik.digits'                => 'NIK harus terdiri dari tepat 16 digit angka.',
            'email.email'               => 'Format email harus valid dan wajib mengandung tanda @ (contoh: nama@gmail.com).',
            'no_telepon.numeric'        => 'Nomor telepon harus berupa angka.',
            'no_telepon.digits_between' => 'Nomor telepon harus berupa angka dengan panjang maksimal 13 digit.',
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