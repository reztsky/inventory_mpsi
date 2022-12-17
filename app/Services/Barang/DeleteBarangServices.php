<?php
namespace App\Services\Barang;

use App\Models\Barang;
use App\Services\BarangKeluar\DeleteBarangKeluarServices;
use App\Services\BarangMasuk\DeleteBarangMasukServices;

class DeleteBarangServices{
    public $barang;

    public function __construct($id_barang){
        $this->barang=Barang::findOrFail($id_barang);
    }

    public function delete(){
        $this->deleteBarangMasuk();
        $this->deleteBarangKeluar();
        $this->barang->delete();
        return $this->barang;
    }

    private function deleteBarangMasuk(){
        
        $barangMasuks=$this->barang->detailBarangMasuks()
            ->with('barangMasuk')
            ->get();
        $arrayBarangMasuk=$barangMasuks->pluck('barangMasuk')->pluck('id');

        $arrayBarangMasuk->each(function($id,$key){
            (new DeleteBarangMasukServices($id))->delete();
        });
        
    }

    private function deleteBarangKeluar(){
        $barangKeluars=$this->barang->detailBarangKeluars()
            ->with('barangKeluar')
            ->get();
        $arrayBarangKeluar=$barangKeluars->pluck('barangKeluar')->pluck('id');

        $arrayBarangKeluar->each(function($id,$key){
            (new DeleteBarangKeluarServices($id))->delete();
        });
    }
}