@extends('layouts.app')
@php $isEdit = $skema->exists; @endphp
@section('title', $isEdit ? 'Ubah Skema' : 'Tambah Skema')

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ $isEdit ? route('skema.update', $skema) : route('skema.store') }}" novalidate>
            @csrf
            @if ($isEdit) @method('PUT') @endif

            <div class="row g-3">
                <div class="col-12 col-md-4">
                    <label for="kode_skema" class="form-label">Kode skema</label>
                    <input type="text" id="kode_skema" name="kode_skema" maxlength="30"
                           value="{{ old('kode_skema', $skema->kode_skema) }}"
                           class="form-control @error('kode_skema') is-invalid @enderror" required>
                    @error('kode_skema')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12 col-md-8">
                    <label for="nama_skema" class="form-label">Nama skema</label>
                    <input type="text" id="nama_skema" name="nama_skema" maxlength="150"
                           value="{{ old('nama_skema', $skema->nama_skema) }}"
                           class="form-control @error('nama_skema') is-invalid @enderror" required>
                    @error('nama_skema')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12 col-md-4">
                    <label for="jenis" class="form-label">Jenis skema</label>
                    <select id="jenis" name="jenis" class="form-select @error('jenis') is-invalid @enderror" required>
                        <option value="">Pilih jenis</option>
                        @foreach (\App\Models\Skema::JENIS as $j)
                            <option value="{{ $j }}" @selected(old('jenis', $skema->jenis) === $j)>{{ $j }}</option>
                        @endforeach
                    </select>
                    @error('jenis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3" maxlength="1000"
                              class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $skema->deskripsi) }}</textarea>
                    @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Simpan perubahan' : 'Simpan' }}</button>
                <a href="{{ route('skema.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
