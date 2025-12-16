<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDosenRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $dosenId = $this->route('dosen');
        
        return [
            'NIP' => 'required|string|min:10|max:20|unique:dosen,NIP,' . $dosenId . ',IdDosen',
            'Nama' => 'required|string|max:255',
            'Email' => 'required|email|unique:dosen,Email,' . $dosenId . ',IdDosen',
            'NoTelpon' => 'required|string|max:20',
        ];
    }

    public function messages()
    {
        return [
            'NIP.required' => 'NIP wajib diisi!',
            'NIP.unique' => 'NIP sudah terdaftar!',
            'NIP.min' => 'NIP minimal 10 karakter!',
            'Nama.required' => 'Nama wajib diisi!',
            'Email.required' => 'Email wajib diisi!',
            'Email.email' => 'Format email tidak valid!',
            'Email.unique' => 'Email sudah terdaftar!',
            'NoTelpon.required' => 'Nomor telepon wajib diisi!',
        ];
    }
}
