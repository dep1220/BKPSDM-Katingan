<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; 
use App\Enums\BeritaStatus;

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
        ];

        // Untuk create (POST), thumbnail wajib
        if ($this->isMethod('POST')) {
            $rules['thumbnail'] = 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240';
        }
        
        // Untuk update (PUT/PATCH), thumbnail opsional
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['thumbnail'] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240';
            $rules['status'] = ['required', Rule::enum(BeritaStatus::class)];
        }

        return $rules;
    }
}
