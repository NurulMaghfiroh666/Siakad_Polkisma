<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMahasiswaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $mahasiswaId = $this->route('mahasiswa');
        
        return [
            'NIM' => 'required|string|min:9|max:20|unique:mahasiswa,NIM,' . $mahasiswaId . ',IdMahasiswa',
            'Nama' => 'required|string|max:255',
            'Email' => 'required|email|unique:mahasiswa,Email,' . $mahasiswaId . ',IdMahasiswa',
            'NoTelpon' => 'required|string|max:20',
            'TahunMasuk' => 'required|digits:4|integer|min:2000|max:' . (date('Y') + 1),
            'IdJurusan' => 'required|exists:jurusan,IdJurusan',
        ];
    }

    public function messages()
    {
        return [
            'NIM.required' => 'NIM wajib diisi!',
            'NIM.unique' => 'NIM sudah terdaftar!',
            'Nama.required' => 'Nama wajib diisi!',
            'Email.required' => 'Email wajib diisi!',
            'Email.email' => 'Format email tidak valid!',
            'Email.unique' => 'Email sudah terdaftar!',
            'NoTelpon.required' => 'Nomor telepon wajib diisi!',
            'TahunMasuk.required' => 'Tahun masuk wajib diisi!',
            'TahunMasuk.digits' => 'Tahun masuk harus 4 digit!',
            'IdJurusan.required' => 'Jurusan wajib dipilih!',
        ];
    }
}
