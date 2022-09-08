<?php
namespace App\Services\Dashboard;

use Illuminate\Support\Facades\DB;

class DashboardServices{

    //Group By Month/Year
    protected static $groupBy=[
                            'month'=>'%M',
                            'year'=>'%Y',
                        ];

    public static function chartBarangMasuk(){
        $groupBy=self::$groupBy;

        return DB::table('detail_barang_masuks')
                ->selectRaw("date_format(barang_masuks.tanggal_diterima,'{$groupBy['month']} %Y') as periode")
                ->selectRaw("sum(detail_barang_masuks.jumlah) as jumlah")
                ->join('barang_masuks','barang_masuks.id','=','detail_barang_masuks.barang_masuk_id')
                ->groupBy("periode")
                ->orderBy('barang_masuks.tanggal_diterima','desc')
                ->limit(10)
                ->get();
    }

    public static function chartBarangKeluar(){
        $groupBy=self::$groupBy;

        return DB::table('detail_barang_keluars')
                ->selectRaw("date_format(barang_keluars.tanggal_keluar,'{$groupBy['month']} %Y') as periode")
                // ->selectRaw("sum(detail_barang_keluars.jumlah) as jumlah")
                ->selectRaw("sum(detail_barang_keluars.sub_total) as jumlah")
                ->join('barang_keluars','barang_keluars.id','=','detail_barang_keluars.barang_keluar_id')
                ->groupBy("periode")
                ->orderBy('barang_keluars.tanggal_keluar','desc')
                ->limit(10)
                ->get();

    }
}