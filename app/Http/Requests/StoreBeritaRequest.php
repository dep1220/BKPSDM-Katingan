<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; 
use App\Enums\BeritaStatus;
use App\Enums\BeritaKategori;

class StoreBeritaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'kategori' => ['required', Rule::enum(BeritaKategori::class)],
            'status' => ['required', Rule::enum(BeritaStatus::class)],
        ];

        // Untuk create (POST), thumbnail wajib kecuali kategori pengumuman
        if ($this->isMethod('POST')) {
            if ($this->input('kategori') === BeritaKategori::PENGUMUMAN->value) {
                $rules['thumbnail'] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
            } else {
                $rules['thumbnail'] = 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
            }
            
            // Validasi file lampiran untuk kategori pengumuman
            if ($this->input('kategori') === BeritaKategori::PENGUMUMAN->value) {
                $rules['lampiran_file'] = 'nullable|file|mimes:pdf,doc,docx|max:5120'; // Max 5MB
            }
        }
        
        // Untuk update (PUT/PATCH), thumbnail opsional
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['thumbnail'] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
            $rules['status'] = ['required', Rule::enum(BeritaStatus::class)];
            
            // Validasi file lampiran untuk kategori pengumuman
            if ($this->input('kategori') === BeritaKategori::PENGUMUMAN->value) {
                $rules['lampiran_file'] = 'nullable|file|mimes:pdf,doc,docx|max:5120'; // Max 5MB
            }
        }

        return $rules;
    }
}
