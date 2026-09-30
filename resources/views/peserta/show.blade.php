@extends('layouts.app')
@section('title', 'Detail Peserta')

@section('content')
<div class="card">
    <div class="card-body">
        <dl class="row detail-list mb-0">
            <dt class="col-sm-4 col-lg-3">Nomor peserta</dt><dd class="col-sm-8 col-lg-9">{{ $peserta->nomor_peserta }}</dd>
            <dt class="col-sm-4 col-lg-3">Nama</dt><dd class="col-sm-8 col-lg-9">{{ $peserta->nama }}</dd>
            <dt class="col-sm-4 col-lg-3">Email</dt><dd class="col-sm-8 col-lg-9">{{ $peserta->email }}</dd>
            <dt class="col-sm-4 col-lg-3">No. telepon</dt><dd class="col-sm-8 col-lg-9">{{ $peserta->no_telepon }}</dd>
            <dt class="col-sm-4 col-lg-3">Tanggal lahir</dt><dd class="col-sm-8 col-lg-9">{{ $peserta->tanggal_lahir->format('d/m/Y') }}</dd>
            <dt class="col-sm-4 col-lg-3">Alamat</dt><dd class="col-sm-8 col-lg-9">{{ $peserta->alamat }}</dd>
            <dt class="col-sm-4 col-lg-3">Skema sertifikasi</dt>
            <dd class="col-sm-8 col-lg-9">{{ $peserta->skema->nama_skema }} ({{ $peserta->skema->kode_skema }}, {{ $peserta->skema->jenis }})</dd>
        </dl>
        <div class="mt-4 d-flex gap-2">
            <a href="{{ route('peserta.edit', $peserta) }}" class="btn btn-warning">Ubah</a>
            <a href="{{ route('peserta.index') }}" class="btn btn-outline-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
