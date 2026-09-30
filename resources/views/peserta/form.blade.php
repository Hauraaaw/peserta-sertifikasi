@extends('layouts.app')
@php $isEdit = $peserta->exists; @endphp
@section('title', $isEdit ? 'Ubah Peserta' : 'Tambah Peserta')

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ $isEdit ? route('peserta.update', $peserta) : route('peserta.store') }}" novalidate>
            @csrf
            @if ($isEdit) @method('PUT') @endif

            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label for="nomor_peserta" class="form-label">Nomor peserta</label>
                    <input type="text" id="nomor_peserta" name="nomor_peserta" maxlength="30"
                           value="{{ old('nomor_peserta', $peserta->nomor_peserta) }}"
                           class="form-control @error('nomor_peserta') is-invalid @enderror" required>
                    @error('nomor_peserta')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12 col-md-6">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" id="nama" name="nama" maxlength="150"
                           value="{{ old('nama', $peserta->nama) }}"
                           class="form-control @error('nama') is-invalid @enderror" required>
                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" maxlength="150"
                           value="{{ old('email', $peserta->email) }}"
                           class="form-control @error('email') is-invalid @enderror" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12 col-md-6">
                    <label for="no_telepon" class="form-label">No. telepon</label>
                    <input type="text" id="no_telepon" name="no_telepon" maxlength="20"
                           value="{{ old('no_telepon', $peserta->no_telepon) }}"
                           class="form-control @error('no_telepon') is-invalid @enderror" required>
                    @error('no_telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12 col-md-6">
                    <label for="tanggal_lahir" class="form-label">Tanggal lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                           value="{{ old('tanggal_lahir', $peserta->tanggal_lahir?->format('Y-m-d')) }}"
                           class="form-control @error('tanggal_lahir') is-invalid @enderror" required>
                    @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12 col-md-6">
                    <label for="skema_id" class="form-label">Skema sertifikasi</label>
                    <select id="skema_id" name="skema_id" class="form-select @error('skema_id') is-invalid @enderror" required>
                        <option value="">Pilih skema</option>
                        @foreach ($skemas as $s)
                            <option value="{{ $s->id }}" @selected(old('skema_id', $peserta->skema_id) == $s->id)>{{ $s->nama_skema }}</option>
                        @endforeach
                    </select>
                    @error('skema_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3" maxlength="500"
                              class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', $peserta->alamat) }}</textarea>
                    @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Simpan perubahan' : 'Simpan' }}</button>
                <a href="{{ route('peserta.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
