@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-12 col-sm-6">
        <div class="card stat-card">
            <div class="card-body">
                <div class="stat-label">Total peserta</div>
                <div class="stat-value">{{ $totalPeserta }}</div>
                <a href="{{ route('peserta.index') }}" class="stretched-link small">Lihat data peserta</a>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <div class="card stat-card">
            <div class="card-body">
                <div class="stat-label">Total skema</div>
                <div class="stat-value">{{ $totalSkema }}</div>
                <a href="{{ route('skema.index') }}" class="stretched-link small">Lihat data skema</a>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-12 col-xl-7">
        <div class="card">
            <div class="card-header">Peserta terbaru</div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr><th>Nomor</th><th>Nama</th><th>Skema</th></tr>
                    </thead>
                    <tbody>
                    @forelse ($pesertaTerbaru as $p)
                        <tr>
                            <td>{{ $p->nomor_peserta }}</td>
                            <td><a href="{{ route('peserta.show', $p) }}">{{ $p->nama }}</a></td>
                            <td>{{ $p->skema->nama_skema }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center text-muted py-4">Belum ada data peserta.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-5">
        <div class="card">
            <div class="card-header">Jumlah peserta per skema</div>
            <ul class="list-group list-group-flush">
                @forelse ($perSkema as $s)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $s->nama_skema }}</span>
                        <span class="badge text-bg-primary rounded-pill">{{ $s->pesertas_count }}</span>
                    </li>
                @empty
                    <li class="list-group-item text-center text-muted py-4">Belum ada data skema.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
