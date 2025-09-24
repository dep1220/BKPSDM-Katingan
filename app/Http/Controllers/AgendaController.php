<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        // Update status agenda berdasarkan waktu
        Agenda::batchUpdateStatus();
        
        $query = Agenda::query();

        // Filter pencarian jika ada
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // Filter bulan jika ada
        if ($request->filled('month')) {
            $month = $request->month;
            $query->whereMonth('created_at', $month);
        }

        // Filter tahun jika ada
        if ($request->filled('year')) {
            $year = $request->year;
            $query->whereYear('created_at', $year);
        }

        $agenda = $query->latest()->paginate(12);

        // Data untuk filter
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $years = Agenda::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('public.agenda.index', compact('agenda', 'months', 'years'));
    }

    public function show(Agenda $agenda)
    {
        // Update status agenda berdasarkan waktu
        $agenda->updateStatusBasedOnTime();
        
        return view('public.agenda.show', compact('agenda'));
    }
}
