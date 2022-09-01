<?php
namespace App\Services;

use App\Models\Barang;

class StokBarangServices{

    public static function increment($idBarang,$jumlah){
        $barang=Barang::findOrFail($idBarang);
        $barang->stok=$barang->stok+$jumlah;
        $barang->save();
    }
}