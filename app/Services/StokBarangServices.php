<?php
namespace App\Services;

use App\Models\Barang;

class StokBarangServices{

    public static function increment($idBarang,$jumlah){
        $barang=Barang::findOrFail($idBarang);
        $barang->stok=$barang->stok+$jumlah;
        $barang->save();
    }

    public static function decrement($idBarang,$jumlah){
        $barang=Barang::findOrFail($idBarang);
        $barang->stok=$barang->stok-$jumlah;
        $barang->save();
    }

    public static function checkStok($idBarang,$jumlah){
        $barang=Barang::findOrFail($idBarang);
        if($barang->stok<$jumlah){
            return false;
        } 
        
        return true;
    }
}