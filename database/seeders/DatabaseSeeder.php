<?php

namespace Database\Seeders;

use App\Models\Peserta;
use App\Models\Skema;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /** Seluruh data di sini adalah data dummy untuk demonstrasi. */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.test'],
            ['name' => 'Administrator', 'password' => Hash::make('password')]
        );

        $jwd = Skema::create([
            'kode_skema' => 'JWD-001',
            'nama_skema' => 'Junior Web Developer',
            'jenis'      => 'Okupasi',
            'deskripsi'  => 'Skema sertifikasi okupasi Junior Web Developer.',
        ]);
        $klaster = Skema::create([
            'kode_skema' => 'KLS-001',
            'nama_skema' => 'Pemrograman Dasar (Dummy)',
            'jenis'      => 'Klaster',
            'deskripsi'  => 'Data dummy untuk demonstrasi relasi.',
        ]);
        $kkni = Skema::create([
            'kode_skema' => 'KKNI-001',
            'nama_skema' => 'Analis Basis Data (Dummy)',
            'jenis'      => 'KKNI',
            'deskripsi'  => 'Data dummy untuk demonstrasi relasi.',
        ]);

        $data = [
            ['P-0001', 'Andi Pratama',  'andi@example.test',  '081200000001', '2004-03-12', 'Jl. Contoh No. 1, Jakarta',  $jwd],
            ['P-0002', 'Sari Lestari',  'sari@example.test',  '081200000002', '2003-07-25', 'Jl. Contoh No. 2, Bandung',  $jwd],
            ['P-0003', 'Budi Santoso',  'budi@example.test',  '081200000003', '2002-11-08', 'Jl. Contoh No. 3, Bogor',    $klaster],
            ['P-0004', 'Dewi Anggraini','dewi@example.test',  '081200000004', '2004-01-30', 'Jl. Contoh No. 4, Depok',    $kkni],
            ['P-0005', 'Rizky Maulana', 'rizky@example.test', '081200000005', '2003-09-17', 'Jl. Contoh No. 5, Bekasi',   $jwd],
        ];

        foreach ($data as [$nomor, $nama, $email, $telp, $lahir, $alamat, $skema]) {
            Peserta::create([
                'nomor_peserta' => $nomor,
                'nama'          => $nama,
                'email'         => $email,
                'no_telepon'    => $telp,
                'tanggal_lahir' => $lahir,
                'alamat'        => $alamat,
                'skema_id'      => $skema->id,
            ]);
        }
    }
}
