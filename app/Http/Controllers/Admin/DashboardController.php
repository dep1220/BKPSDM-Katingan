<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\Berita;
    use App\Models\Galeri;
    use App\Models\Unduhan;
    use App\Models\Agenda;
    use App\Models\User;
    use App\Models\Kontak;
    use App\Models\ActivityLog;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class DashboardController extends Controller
    {
        public function index()
        {
            // Menghitung jumlah data dari setiap model
            $data['beritaCount'] = Berita::count();
            $data['galeriCount'] = Galeri::count();
            $data['unduhanCount'] = Unduhan::count();
            $data['userCount'] = User::count();
            
            // Menghitung jumlah agenda menggunakan model Agenda
            $data['agendaCount'] = Agenda::count();

            // Mengambil 5 berita terbaru
            $data['latestBerita'] = Berita::with('user')->latest()->take(5)->get();
            
            // Mengambil activity log dari 1 bulan terakhir, diurutkan berdasarkan yang terbaru
            $data['recentActivities'] = ActivityLog::with('user')
                ->where('created_at', '>=', now()->subMonth())
                ->latest()
                ->get()
                ->unique('id'); // Menghilangkan duplikat berdasarkan ID

            // Statistics untuk berita dari 1 bulan terakhir (30 hari)
            $data['monthlyBeritaCount'] = Berita::where('created_at', '>=', now()->subDays(30))->count();
            
            // Total aktivitas dalam 1 bulan terakhir
            $data['totalActivitiesCount'] = ActivityLog::where('created_at', '>=', now()->subMonth())->count();

            // Kirim semua data ke view
            return view('admin.dashboard', $data);
        }
    }
    