<?php
namespace App\Services;

class BuktiTerimaServices{

    protected $path='BuktiTerima';

    public function upload($buktiTerima){
        $filename=time().'_'.$buktiTerima->getClientOriginalName();
        $buktiTerima->storeAs($this->path,$filename,'public');
        return $filename;
    }
}