<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\LogsActivity;
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    use LogsActivity;
    /**
     * Menampilkan daftar semua slide.
     * Tidak ada lagi firstOrCreate().
     */
    public function index()
    {
        $slides = Hero::orderBy('order')->get();
        return view('admin.hero.index', compact('slides'));
    }

    /**
     * Menampilkan form untuk membuat slide baru.
     */
    public function create()
    {
        return view('admin.hero.create');
    }

    /**
     * Menyimpan slide baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'background_image' => 'required|image|max:2048', // Di sini kita wajibkan gambar
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|url',
            'order' => 'required|integer',
        ]);

        $data['background_image'] = $request->file('background_image')->store('hero', 'public');
        $hero = Hero::create($data);
        $this->logCreate($hero, "Menambahkan slide hero: {$hero->title}");
        
        return redirect()->route('hero.index')->with('success', 'Slide baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit slide yang ada.
     */
    public function edit(Hero $hero)
    {
        return view('admin.hero.edit', compact('hero'));
    }

    /**
     * Memperbarui slide yang ada.
     */
    public function update(Request $request, Hero $hero)
    {
        $oldValues = $hero->toArray();
        
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'background_image' => 'nullable|image|max:2048', // Boleh null karena mungkin hanya ganti teks
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|url',
            'order' => 'required|integer',
        ]);

        if ($request->hasFile('background_image')) {
            if ($hero->background_image) {
                Storage::disk('public')->delete($hero->background_image);
            }
            $data['background_image'] = $request->file('background_image')->store('hero', 'public');
        }

        $hero->update($data);
        $this->logUpdate($hero, $oldValues, "Mengubah slide hero: {$hero->title}");
        
        return redirect()->route('hero.index')->with('success', 'Slide berhasil diperbarui!');
    }

    /**
     * Menghapus slide.
     */
    public function destroy(Hero $hero)
    {
        $title = $hero->title ?? 'Slide tanpa judul';
        
        if ($hero->background_image) {
            Storage::disk('public')->delete($hero->background_image);
        }
        
        $this->logDelete($hero, "Menghapus slide hero: {$title}");
        $hero->delete();
        
        return redirect()->route('hero.index')->with('success', 'Slide berhasil dihapus!');
    }
}