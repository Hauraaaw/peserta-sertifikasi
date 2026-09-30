@extends('layouts.app')
@section('title', 'Data Peserta')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex flex-column flex-md-row gap-3 justify-content-between mb-3">
            <form method="GET" action="{{ route('peserta.index') }}" class="row g-2 flex-grow-1">
                <div class="col-12 col-sm">
                    <input type="search" name="q" value="{{ request('q') }}" class="form-control"
                           placeholder="Cari nomor, nama, atau email" aria-label="Kata kunci pencarian">
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
                        <th>No</th><th>Nomor peserta</th><th>Nama</th><th>Skema</th><th>Email</th><th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($pesertas as $p)
                    <tr>
                        <td>{{ $pesertas->firstItem() + $loop->index }}</td>
                        <td>{{ $p->nomor_peserta }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->skema->nama_skema }}</td>
                        <td>{{ $p->email }}</td>
                        <td class="text-end text-nowrap">
                            <a href="{{ route('peserta.show', $p) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                            <a href="{{ route('peserta.edit', $p) }}" class="btn btn-sm btn-outline-warning">Ubah</a>
                            <button type="button" class="btn btn-sm btn-outline-danger"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    data-action="{{ route('peserta.destroy', $p) }}" data-name="{{ $p->nama }}">Hapus</button>
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
