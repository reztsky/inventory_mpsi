<?php
namespace App\Services\Barang;

use App\Models\Barang;
use Rap2hpoutre\FastExcel\FastExcel;

class ExportBarangServices{

    public function excel(){
        return (new FastExcel($this->data()))->download($this->fileName());
    }

    private function fileName(){
        return "Barang_".date('Y_m_d').".xlsx";
    }

    private function data(){
        foreach (Barang::cursor() as $barang) {
            yield $barang;
        }
    }

}