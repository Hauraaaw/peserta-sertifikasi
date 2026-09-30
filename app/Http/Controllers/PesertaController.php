<?php

namespace App\Http\Controllers;

use App\Http\Requests\PesertaRequest;
use App\Models\Peserta;
use App\Models\Skema;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PesertaController extends Controller
{
    public function index(Request $request): View
    {
        $pesertas = Peserta::with('skema')
            ->cari($request->query('q'))
            ->when($request->query('skema_id'), fn ($q, $id) => $q->where('skema_id', $id))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('peserta.index', [
            'pesertas' => $pesertas,
            'skemas'   => Skema::orderBy('nama_skema')->get(),
        ]);
    }

    public function create(): View
    {
        return view('peserta.form', [
            'peserta' => new Peserta(),
            'skemas'  => Skema::orderBy('nama_skema')->get(),
        ]);
    }

    public function store(PesertaRequest $request): RedirectResponse
    {
        try {
            Peserta::create($request->validated());
        } catch (QueryException $e) {
            Log::error('Gagal menyimpan peserta', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Data peserta gagal disimpan. Silakan coba lagi.');
        }

        return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil ditambahkan.');
    }

    public function show(Peserta $peserta): View
    {
        return view('peserta.show', ['peserta' => $peserta->load('skema')]);
    }

    public function edit(Peserta $peserta): View
    {
        return view('peserta.form', [
            'peserta' => $peserta,
            'skemas'  => Skema::orderBy('nama_skema')->get(),
        ]);
    }

    public function update(PesertaRequest $request, Peserta $peserta): RedirectResponse
    {
        try {
            $peserta->update($request->validated());
        } catch (QueryException $e) {
            Log::error('Gagal mengubah peserta', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Perubahan data peserta gagal disimpan. Silakan coba lagi.');
        }

        return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil diperbarui.');
    }

    public function destroy(Peserta $peserta): RedirectResponse
    {
        try {
            $peserta->delete();
        } catch (QueryException $e) {
            Log::error('Gagal menghapus peserta', ['error' => $e->getMessage()]);

            return back()->with('error', 'Data peserta gagal dihapus.');
        }

        return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil dihapus.');
    }
}
