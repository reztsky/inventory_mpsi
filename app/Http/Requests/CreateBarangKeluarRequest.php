<?php

namespace App\Http\Requests;

use App\Services\AutoGenerateNoTransaksi;
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
        return [
            'no_transaksi'=>'required',
            'tanggal_keluar'=>'required|before:tomorrow|date',
            'tujuan_kirim'=>'required',
            'total_harga'=>'required|numeric|min:1',
            'barang_id'=>'required|array|min:1',
            'barang_id.*'=>'required|numeric|min:1',
            'jumlah'=>'required|array|min:1',
            'jumlah.*'=>'required|numeric',
            'sub_total'=>'required|array|min:1',
            'sub_total.*'=>'required|numeric|min:1'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'no_transaksi'=>AutoGenerateNoTransaksi::generate()
        ]);
    }
}
