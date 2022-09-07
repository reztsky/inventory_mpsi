<?php
namespace App\Services;

use App\Models\BarangMasuk;
use Illuminate\Support\Facades\Storage;

class BuktiTerimaServices{

    protected $path='BuktiTerima';

    public function upload($buktiTerima){
        $filename=time().'_'.$buktiTerima->getClientOriginalName();
        $buktiTerima->storeAs($this->path,$filename,'public');
        return $filename;
    }

    public function updateFoto($buktiTerima,$id){
        $barangMasuk=BarangMasuk::findOrFail($id);
        if(Storage::disk('public')->exists("{$this->path}/{$barangMasuk->bukti_terima}")){
            Storage::disk('public')->delete("{$this->path}/{$barangMasuk->bukti_terima}");
        }

        return $this->upload($buktiTerima);
    }

    public function deleteFoto($id){
        $barangMasuk=BarangMasuk::findOrFail($id);
        if(Storage::disk('public')->exists("{$this->path}/{$barangMasuk->bukti_terima}")){
            Storage::disk('public')->delete("{$this->path}/{$barangMasuk->bukti_terima}");
            return true;
        }
        return false;
    }
}