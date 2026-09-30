<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkemaRequest;
use App\Models\Skema;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class SkemaController extends Controller
{
    public function index(Request $request): View
    {
        return view('skema.index', [
            'skemas' => Skema::withCount('pesertas')
                ->cari($request->query('q'))
                ->orderBy('nama_skema')
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    public function create(): View
    {
        return view('skema.form', ['skema' => new Skema()]);
    }

    public function store(SkemaRequest $request): RedirectResponse
    {
        try {
            Skema::create($request->validated());
        } catch (QueryException $e) {
            Log::error('Gagal menyimpan skema', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Data skema gagal disimpan. Silakan coba lagi.');
        }

        return redirect()->route('skema.index')->with('success', 'Data skema berhasil ditambahkan.');
    }

    public function edit(Skema $skema): View
    {
        return view('skema.form', ['skema' => $skema]);
    }

    public function update(SkemaRequest $request, Skema $skema): RedirectResponse
    {
        try {
            $skema->update($request->validated());
        } catch (QueryException $e) {
            Log::error('Gagal mengubah skema', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Perubahan data skema gagal disimpan. Silakan coba lagi.');
        }

        return redirect()->route('skema.index')->with('success', 'Data skema berhasil diperbarui.');
    }

    public function destroy(Skema $skema): RedirectResponse
    {
        $jumlah = $skema->pesertas()->count();

        if ($jumlah > 0) {
            return back()->with('error', "Skema tidak dapat dihapus karena masih digunakan oleh {$jumlah} peserta.");
        }

        try {
            $skema->delete();
        } catch (QueryException $e) {
            Log::error('Gagal menghapus skema', ['error' => $e->getMessage()]);

            return back()->with('error', 'Data skema gagal dihapus.');
        }

        return redirect()->route('skema.index')->with('success', 'Data skema berhasil dihapus.');
    }
}