<?php

namespace App\Http\Requests;

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
            'tanggal_keluar'=>'required|before:tomorrow|date',
            'tujuan_kirim'=>'required',
            'total_harga'=>'required|numeric|min:1',

        ];
    }

    protected function prepareForValidation()
    {
        // $this->merge([
        //     'no_transaksi'=>
        // ])
    }
}
