<?php
namespace App\Services;

use App\Models\BarangKeluar;
use App\Models\DetailBarangKeluar;

class CreateBarangKeluarServices{

    public function __construct(public $request){
        
    }

    public function store(){
        $barangKeluar=$this->storeBarangKeluar();
        $this->storeDetailBarangKeluar($barangKeluar->id);
        return $barangKeluar;
    }

    private function storeBarangKeluar(){
        $barangKeluar=BarangKeluar::create($this->request->safe()->only([
            'no_transaksi',
            'tanggal_keluar',
            'tujuan_kirim',
            'total_harga',
        ]));

        return $barangKeluar;
    }

    private function storeDetailBarangKeluar($barangKeluarId){
        $detailBarangKeluar=$this->request->safe()->except(['no_transaksi','tangga_keluar','tujuan_kirim','total_harga',]);
        
        for ($i=0; $i < count($detailBarangKeluar['barang_id']) ; $i++) { 

            DetailBarangKeluar::create([
                'barang_keluar_id'=>$barangKeluarId,
                'barang_id'=>$detailBarangKeluar['barang_id'][$i],
                'jumlah'=>$detailBarangKeluar['jumlah'][$i],
                'sub_total'=>$detailBarangKeluar['sub_total'][$i]
            ]);

            StokBarangServices::decrement($detailBarangKeluar['barang_id'][$i],$detailBarangKeluar['jumlah'][$i]);
            
        }
    }
}