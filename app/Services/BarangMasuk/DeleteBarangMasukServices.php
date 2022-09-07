<?php
namespace App\Services\BarangMasuk;

use App\Models\BarangMasuk;
use App\Services\BuktiTerimaServices;
use App\Services\StokBarangServices;

class DeleteBarangMasukServices{

    protected $barangMasuk;

    public function __construct(public $id){
        $this->barangMasuk=BarangMasuk::findOrFail($this->id);
    }

    public function delete(){
        if(!$this->deleteBarangMasuk()) return false;
        $this->updateStok();
        $this->deleteDetailBarangMasuk();

        return $this->barangMasuk;
    }

    private function deleteDetailBarangMasuk(){
        $this->barangMasuk->details()->delete();
    }

    private function deleteBarangMasuk(){
       if(!(new BuktiTerimaServices)->deleteFoto($this->id)) return false;
       
       $this->barangMasuk->delete();
       return true;
        
    }

    private function updateStok(){
        foreach ($this->barangMasuk->details as $detail) {
            StokBarangServices::decrement($detail->barang_id,$detail->jumlah);
        }
    }
}