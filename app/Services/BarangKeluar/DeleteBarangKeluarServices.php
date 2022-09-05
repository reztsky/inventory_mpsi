<?php 
namespace App\Services\BarangKeluar;

use App\Models\BarangKeluar;
use App\Services\StokBarangServices;

class DeleteBarangKeluarServices{
    public $barangKeluar;

    public function __construct(public $id)
    {
        $this->barangKeluar=BarangKeluar::findOrFail($this->id);
    }

    public function delete(){
        $this->incrementStok();
        $this->deleteDetailBarangKeluar();
        $this->deleteBarangKeluar();

        return $this->barangKeluar;
    }

    private function deleteBarangKeluar(){
        $this->barangKeluar->delete();
    }

    private function deleteDetailBarangKeluar(){
        $this->barangKeluar->details()->delete();
    }

    private function incrementStok(){
        foreach ($this->barangKeluar->details as $detail){
            StokBarangServices::increment($detail->barang_id,$detail->jumlah);
        }
    }
}