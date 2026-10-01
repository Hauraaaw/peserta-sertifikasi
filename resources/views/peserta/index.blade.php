@extends('layouts.app')
@section('title', 'Data Peserta')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex flex-column flex-md-row gap-3 justify-content-between mb-3">
            <form method="GET" action="{{ route('peserta.index') }}" class="row g-2 flex-grow-1">
                <div class="col-12 col-sm">
                    <input type="search" name="q" value="{{ request('q') }}" class="form-control"
                           placeholder="Cari nomor, NIK, nama, atau email" aria-label="Kata kunci pencarian">
                </div>
                <div class="col-12 col-sm-auto">
                    <select name="skema_id" class="form-select" aria-label="Filter skema">
                        <option value="">Semua skema</option>
                        @foreach ($skemas as $s)
                            <option value="{{ $s->id }}" @selected(request('skema_id') == $s->id)>{{ $s->nama_skema }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-auto d-flex gap-2">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Cari</button>
                    @if (request()->hasAny(['q', 'skema_id']))
                        <a href="{{ route('peserta.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </div>
            </form>
            <div>
                <a href="{{ route('peserta.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> Tambah peserta</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Peserta</th>
                        <th>Nomor peserta / NIK</th>
                        <th>Jenis kelamin</th>
                        <th>Skema</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($pesertas as $p)
                    <tr>
                        <td>{{ $pesertas->firstItem() + $loop->index }}</td>
                        <td>
                            <div class="fw-semibold">{{ $p->nama }}</div>
                            <div class="small text-muted">{{ $p->email }}</div>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $p->nomor_peserta }}</div>
                            <div class="small text-muted">{{ $p->nik }}</div>
                        </td>
                        <td class="text-nowrap">{{ $p->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td>{{ $p->skema->nama_skema }}</td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                <a href="{{ route('peserta.show', $p) }}" class="btn btn-sm btn-outline-primary"
                                   title="Detail" aria-label="Detail"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('peserta.edit', $p) }}" class="btn btn-sm btn-outline-warning"
                                   title="Ubah" aria-label="Ubah"><i class="bi bi-pencil"></i></a>
                                <button type="button" class="btn btn-sm btn-outline-danger"
                                        title="Hapus" aria-label="Hapus"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-action="{{ route('peserta.destroy', $p) }}" data-name="{{ $p->nama }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Data peserta tidak ditemukan.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{ $pesertas->links() }}
    </div>
</div>
@include('partials.delete-modal')
@endsection
