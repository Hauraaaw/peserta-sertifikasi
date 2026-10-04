# Aplikasi Pengelolaan Data Peserta Sertifikasi

Laravel + PHP + MySQL + Blade + Bootstrap 5 (CDN) + CSS/JS custom.
Folder ini berisi file aplikasi saja. Salin ke project Laravel 11/12/13 baru.

## Instalasi

1. Buat project baru:
   composer create-project laravel/laravel peserta-sertifikasi
2. Salin semua isi folder ini ke dalam project tersebut, timpa file yang sudah ada
   (`routes/web.php`, `app/Providers/AppServiceProvider.php`, `database/seeders/DatabaseSeeder.php`).
3. Buat database MySQL kosong, misal `peserta_sertifikasi`.
4. Ubah `.env`:
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=peserta_sertifikasi
   DB_USERNAME=root
   DB_PASSWORD=
5. Jalankan:
   php artisan migrate
6. Buat akun admin (dummy) lewat tinker:
   php artisan tinker
   \App\Models\User::create(['name' => 'Administrator', 'email' => 'admin@gmail.com', 'password' => \Illuminate\Support\Facades\Hash::make('password')]);
   exit
7. Jalankan server:
   php artisan serve
8. Buka http://127.0.0.1:8000 lalu login.

## Urutan pengisian data
Tambah dulu data skema (menu Data Skema), baru tambah data peserta.

## Library pre-existing
- Laravel: routing, Eloquent ORM, validasi (Form Request), autentikasi session, migration
- Bootstrap 5.3 dan Bootstrap Icons (CDN): grid responsif, tabel, form, modal, ikon
