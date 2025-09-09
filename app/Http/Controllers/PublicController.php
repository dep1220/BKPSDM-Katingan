<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Hero;
use App\Models\Kontak;
use App\Models\Pejabat;
use App\Models\Unduhan;
use App\Models\Agenda;
use App\Models\VisiMisi;
use App\Enums\BeritaStatus;
use Illuminate\Http\Request;
use App\Enums\JabatanEnum;

class PublicController extends Controller
{
    // Halaman Beranda (Homepage)
    public function index()
    {
        $heroSlides = Hero::orderBy('order')->get();
        $latestBerita = Berita::where('status', BeritaStatus::PUBLISHED)->latest()->take(3)->get();
        $latestUnduhan = Unduhan::latest()->take(3)->get();
        $latestAgenda = Agenda::latest()->take(2)->get();
        
        // Perbaiki pencarian pimpinan sesuai enum
        $pimpinan = Pejabat::where('jabatan', JabatanEnum::KEPALA_DINAS->value)->orderBy('order')->first();
        $latestGaleri = Galeri::latest()->take(4)->get();

        // Ambil struktur pejabat sesuai enum
        $strukturPejabat = Pejabat::where('jabatan', JabatanEnum::SEKRETARIS->value)
                                    ->orWhere('jabatan', JabatanEnum::KEPALA_BIDANG->value)
                                    ->orderBy('order')
                                    ->get();

        // Kelompokkan pejabat berdasarkan jabatan
        $groupedPejabatsUnsorted = $strukturPejabat->groupBy('jabatan');

        $groupedPejabats = $groupedPejabatsUnsorted->sortBy(function ($group, $jabatan) {
            if ($jabatan === JabatanEnum::SEKRETARIS->value) {
                return 1; // Prioritas pertama
            } elseif ($jabatan === JabatanEnum::KEPALA_BIDANG->value) {
                return 2; // Prioritas kedua
            } else {
                return 3; // Prioritas lainnya
            }
        });

        return view('public.index', compact(
            'heroSlides', 
            'latestBerita', 
            'latestUnduhan',
            'latestAgenda',
            'pimpinan',
            'groupedPejabats',
            'latestGaleri'
        ));
    }

    // Halaman Daftar Semua Berita
    public function berita(Request $request)
    {
        $query = Berita::where('status', BeritaStatus::PUBLISHED);
        
        // Filter pencarian
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('content', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        $beritas = $query->latest()->paginate(9);
        
        return view('public.berita.index', compact('beritas'));
    }

    // Halaman Detail Satu Berita
    public function beritaShow(Berita $berita)
    {
        // Pastikan hanya berita yang sudah publish yang bisa diakses
        if ($berita->status !== BeritaStatus::PUBLISHED) {
            abort(404);
        }
        return view('public.berita.show', compact('berita'));
    }

    // Halaman Galeri
    public function galeri()
    {
        $galeris = Galeri::latest()->paginate(12);
        return view('public.galeri.index', compact('galeris'));
    }

    // Halaman Struktur Pejabat
    public function pejabat()
    {
        // 1. Ambil semua data pejabat, diurutkan berdasarkan kolom 'order'
        $allPejabats = Pejabat::orderBy('order')->get();

        // 2. Pisahkan pimpinan (Kepala Dinas)
        $pimpinan = $allPejabats->where('jabatan', JabatanEnum::KEPALA_DINAS->value)->first();

        // 3. Ambil semua pejabat lainnya dan kelompokkan berdasarkan jabatan mereka
        $staffPejabatsGrouped = $allPejabats->where('jabatan', '!=', JabatanEnum::KEPALA_DINAS->value)->groupBy('jabatan');

        // 4. Urutkan grup berdasarkan priority dari enum
        $staffPejabats = $staffPejabatsGrouped->sortBy(function ($group, $jabatan) {
            // Cari enum yang sesuai untuk mendapatkan priority
            foreach (JabatanEnum::cases() as $jabatanEnum) {
                if ($jabatanEnum->value === $jabatan) {
                    return $jabatanEnum->priority();
                }
            }
            return 999; // Priority default untuk jabatan yang tidak ada di enum
        });

        // 4. Kirim data yang sudah terstruktur ke view
        return view('public.pejabat.index', compact('pimpinan', 'staffPejabats'));
    }

    // Halaman Unduhan
    public function unduhan(Request $request)
    {
        $query = Unduhan::latest();
        
        // Filter pencarian berdasarkan judul
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        
        // Filter berdasarkan tipe file
        if ($request->filled('type') && $request->type !== 'all') {
            $typeFilters = [
                'pdf' => ['pdf'],
                'docs' => ['doc', 'docx', 'rtf', 'odt'],
                'sheets' => ['xls', 'xlsx', 'csv', 'ods'],
                'slides' => ['ppt', 'pptx', 'odp'],
                'archives' => ['zip', 'rar', '7z'],
            ];
            
            if (isset($typeFilters[$request->type])) {
                $extensions = $typeFilters[$request->type];
                $query->where(function($q) use ($extensions) {
                    foreach ($extensions as $ext) {
                        $q->orWhere('file_path', 'like', '%.' . $ext);
                    }
                });
            } elseif ($request->type === 'others') {
                // Filter untuk file yang bukan kategori umum
                $commonExtensions = ['pdf', 'doc', 'docx', 'rtf', 'odt', 'xls', 'xlsx', 'csv', 'ods', 'ppt', 'pptx', 'odp', 'zip', 'rar', '7z'];
                $query->where(function($q) use ($commonExtensions) {
                    foreach ($commonExtensions as $ext) {
                        $q->where('file_path', 'not like', '%.' . $ext);
                    }
                });
            }
        }
        
        $unduhans = $query->get();
        return view('public.unduhan.index', compact('unduhans'));
    }

    // Halaman Kontak
    public function kontak()
    {
        return view('public.kontak.index');
    }

    // Proses Form Kontak
    public function kontakStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'captcha' => 'required|string|size:6',
            'captcha_token' => 'required|string',
        ]);

        // Validasi CAPTCHA
        try {
            $expectedCaptcha = base64_decode($validated['captcha_token']);
            $userCaptcha = strtoupper($validated['captcha']);
            
            if ($userCaptcha !== $expectedCaptcha) {
                return redirect()->back()
                    ->withInput($request->except('captcha', 'captcha_token'))
                    ->withErrors(['captcha' => 'Kode CAPTCHA tidak sesuai. Silakan coba lagi.']);
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput($request->except('captcha', 'captcha_token'))
                ->withErrors(['captcha' => 'Token CAPTCHA tidak valid. Silakan refresh halaman.']);
        }

        // Simpan data kontak (tanpa menyimpan captcha)
        Kontak::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
        ]);

        return redirect()->route('public.kontak')->with('success', 'Pesan Anda telah berhasil terkirim!');
    }

    // Halaman Visi & Misi (Profil)
    public function visiMisi()
    {
        // Hanya ambil visi misi yang aktif
        $visiMisi = VisiMisi::active()->first();
        
        return view('public.profil.visi-misi', compact('visiMisi'));
    }
}
