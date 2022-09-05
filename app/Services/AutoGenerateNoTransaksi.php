<?php
namespace App\Services;

use App\Models\BarangKeluar;

class AutoGenerateNoTransaksi{
    //Patern Auto Generate No Transaksi
    //TRSK => Transkasi Keluar
    //dateTime=> Format year(2 digits)/day/month hour:i(minutes):second (Example  22-09-05 11:14:14)
    //Id Transksai => get Last ID From Table Transaksi Keluar
    public static function generate(){
        $date= date('ydmhis');
        $lastId=BarangKeluar::latest()->first();

        if($lastId==null){
            return "TRSK_{$date}_1";
        }

        $idTrs=$lastId->id+1;
        return "TRSK_{$date}_{$idTrs}";
    }
}