<?php

namespace App\Http\Requests;

use App\Rules\UnderStok;
use App\Services\BarangKeluar\AutoGenerateNoTransaksi;
use Illuminate\Foundation\Http\FormRequest;

class CreateBarangKeluarRequest extends FormRequest
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
        $rules=[
            'no_transaksi'=>'required',
            'tanggal_keluar'=>'required|before:tomorrow|date',
            'tujuan_kirim'=>'required',
            'total_harga'=>'required|numeric|min:1',
        ];

        foreach ($this->barang_id as $index => $barang_id) {
            $rules['barang_id.'.$index]=['required','numeric',];
            $rules['jumlah.'.$index]=['required','numeric',new UnderStok($barang_id)];
            $rules['sub_total.'.$index]=['required','numeric','min:1'];
        }

        return $rules;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'no_transaksi'=>AutoGenerateNoTransaksi::generate()
        ]);
    }
}
