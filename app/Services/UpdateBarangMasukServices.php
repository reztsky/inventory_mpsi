<?php
namespace App\Services;

use App\Models\BarangMasuk;

class UpdateBarangMasukServices{
    public $request,$id, $barangMasuk;
    protected $formBarangMasuk;

    public function __construct($request,$id){
        $this->barangMasuk=BarangMasuk::findOrFail($id);
        $this->request=$request;
        $this->id=$id;
        $this->formBarangMasuk=$request->validated();
    }
    public function update(){
        $this->prepareForUpdate();
        $barangMasuk=$this->barangMasuk->update($this->formBarangMasuk);
        $this->barangMasuk->save();
        $this->incrementStokBarang();
        return $barangMasuk;
    }

    private function prepareForUpdate(){
        if($this->request->hasFile('bukti_terima')){
            $this->formBarangMasuk['bukti_terima']=$this->updateFotoBuktiTerima();
        }
        $this->decrementStokBarang();
        
    }

    private function updateFotoBuktiTerima(){
        return (new BuktiTerimaServices)->updateFoto($this->request->bukti_terima,$this->id);
    }

    private function decrementStokBarang(){
        //Return Stok Of Barang Before Add This Barang Masuk
        StokBarangServices::decrement($this->barangMasuk->barang_id,$this->barangMasuk->jumlah);
    }

    private function incrementStokBarang(){
        StokBarangServices::increment($this->request->barang_id,$this->request->jumlah);
    }

}