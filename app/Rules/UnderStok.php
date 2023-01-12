<?php

namespace App\Rules;

use App\Models\Barang;
use App\Services\StokBarangServices;
use Illuminate\Contracts\Validation\Rule;

class UnderStok implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(protected $barang_id)
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return StokBarangServices::checkStok($this->barang_id,$value);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return [
            'jumlah.*'=>'Periksa Stok Tersedia',
        ];
    }
}
