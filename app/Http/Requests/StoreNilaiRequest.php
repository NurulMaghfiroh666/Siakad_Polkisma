<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNilaiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nilai.*.krs_detail_id' => 'required|exists:krs_details,id',
            'nilai.*.nilai_angka' => 'required|numeric|min:0|max:100',
        ];
    }

    public function messages()
    {
        return [
            'nilai.*.nilai_angka.required' => 'Nilai angka harus diisi!',
            'nilai.*.nilai_angka.numeric' => 'Nilai harus berupa angka!',
            'nilai.*.nilai_angka.min' => 'Nilai minimal 0!',
            'nilai.*.nilai_angka.max' => 'Nilai maksimal 100!',
        ];
    }
}
