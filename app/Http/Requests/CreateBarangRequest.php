<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBarangRequest extends FormRequest
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
            'merek'=>'required',
            'jenis'=>'required',
            'nama_barang'=>'required',
            'keterangan_barang'=>'nullable',
            'harga'=>'required|numeric|min:1',
            'satuan'=>'required',
            'stok'=>'required|numeric',
            'stok_minimal'=>'numeric',
            'stok_maksimal'=>'numeric',
        ];
    }
}
