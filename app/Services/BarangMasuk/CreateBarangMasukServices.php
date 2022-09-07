<?php
namespace App\Services\BarangMasuk;

use App\Models\BarangMasuk;
use App\Models\DetailBarangMasuk;
use App\Services\BuktiTerimaServices;
use App\Services\StokBarangServices;

class CreateBarangMasukServices{

    public function __construct(public $request){}

    public function store(){
        // Prepare For Storing
        $barangMasukForm=$this->request->safe()->except(['bukti_terima','barang_id','jumlah']);
        $barangMasukForm['bukti_terima']=(new BuktiTerimaServices)->upload($this->request->bukti_terima);

        // Store Barang Masuk
        $barangMasuk=BarangMasuk::create($barangMasukForm);

        // Store Detail Barang Masuk
        $this->storeDetailBarangMasuk($barangMasuk->id);

        return $barangMasuk;
    }

    private function storeDetailBarangMasuk($barangMasukId){
        $detailBarangMasuk=$this->request->safe()->only(['barang_id','jumlah']);

        for ($i=0; $i <count($detailBarangMasuk['barang_id']) ; $i++) { 

            DetailBarangMasuk::create([
                'barang_masuk_id'=>$barangMasukId,
                'barang_id'=>$detailBarangMasuk['barang_id'][$i],
                'jumlah'=>$detailBarangMasuk['jumlah'][$i],
            ]);

            // Increment Barang
            StokBarangServices::increment($detailBarangMasuk['barang_id'][$i],$detailBarangMasuk['jumlah'][$i]);
        }

    }
}