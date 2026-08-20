<?php

namespace App\Http\Requests\Produk;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'purchase_price' => 'required|integer|min:0',
            'selling_price' => 'required|integer|min:0',
            'jenis_id' => 'required|exists:jenis,id',
            'stock' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'foto.image' => 'File yang diupload harus gambar.',
            'foto.mimes' => 'Extensi gambar harus jpeg, png, jpg.',
            'foto.max' => ' Maksimal ukuran gambar 2MB.',
            'name.required' => 'Nama wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'purchase_price.required' => 'purchase price wajib diisi.',
            'purchase_price.integer' => 'purchase price harus berupa angka.',
            'selling_price.required' => 'selling price wajib diisi.',
            'selling_price.integer' => 'selling price harus berupa angka.',
            'stock.required' => 'Stok wajib diisi.',
            'stock.integer' => 'Stok harus berupa angka.',
            'jenis_id.required' => 'Jenis produk wajib dipilih.',
            'jenis_id.exists' => 'Jenis produk tidak valid.',
        ];
    }
}
