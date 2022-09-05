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
    public function __construct(public $barangs_id)
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
        //return StokBarangServices::checkStok($this->barangs_id[0],$value[0]);
        foreach ($value as $index=>$jumlah) {
            StokBarangServices::checkStok($this->barangs_id[$index],$jumlah);
        }
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
