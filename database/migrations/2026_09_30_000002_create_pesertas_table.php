<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_peserta', 30)->unique();
            $table->string('nik', 16)->unique();
            $table->string('nama', 150);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('email', 150)->unique();
            $table->string('no_telepon', 20);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->foreignId('skema_id')->constrained('skemas')->restrictOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
