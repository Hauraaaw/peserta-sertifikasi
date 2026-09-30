@extends('layouts.app')
@section('title', 'Data Skema')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex flex-column flex-md-row gap-3 justify-content-between mb-3">
            <form method="GET" action="{{ route('skema.index') }}" class="row g-2 flex-grow-1">
                <div class="col-12 col-sm">
                    <input type="search" name="q" value="{{ request('q') }}" class="form-control"
                           placeholder="Cari kode, nama, atau jenis skema" aria-label="Kata kunci pencarian">
                </div>
                <div class="col-12 col-sm-auto d-flex gap-2">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Cari</button>
                    @if (request()->filled('q'))
                        <a href="{{ route('skema.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </div>
            </form>
            <div>
                <a href="{{ route('skema.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> Tambah skema</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th><th>Kode skema</th><th>Nama skema</th><th>Jenis</th><th>Jumlah peserta</th><th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($skemas as $s)
                    <tr>
                        <td>{{ $skemas->firstItem() + $loop->index }}</td>
                        <td>{{ $s->kode_skema }}</td>
                        <td>{{ $s->nama_skema }}</td>
                        <td>{{ $s->jenis }}</td>
                        <td>{{ $s->pesertas_count }}</td>
                        <td class="text-end text-nowrap">
                            <a href="{{ route('skema.edit', $s) }}" class="btn btn-sm btn-outline-warning">Ubah</a>
                            <button type="button" class="btn btn-sm btn-outline-danger"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    data-action="{{ route('skema.destroy', $s) }}" data-name="{{ $s->nama_skema }}">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Data skema tidak ditemukan.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{ $skemas->links() }}
    </div>
</div>
@include('partials.delete-modal')
@endsection