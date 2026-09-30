<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Skema;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard', [
            'totalPeserta'  => Peserta::count(),
            'totalSkema'    => Skema::count(),
            'pesertaTerbaru' => Peserta::with('skema')->latest()->take(5)->get(),
            'perSkema'      => Skema::withCount('pesertas')->orderByDesc('pesertas_count')->get(),
        ]);
    }
}
