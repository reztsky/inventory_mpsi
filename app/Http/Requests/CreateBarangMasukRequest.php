<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateBarangMasukRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'barang_id.*'=>'required|numeric',
            'jumlah.*'=>'required|numeric',
            'barang_dari'=>'required',
            'no_telfon'=>'required|numeric',
            'nama_penerima'=>'required',
            'tanggal_diterima'=>'required|date|before:tomorrow',
            'bukti_terima'=>'nullable|max:2048|image',
            'inserted_by'=>'required|numeric',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'inserted_by'=>Auth::user()->id,
        ]);
    }
}
