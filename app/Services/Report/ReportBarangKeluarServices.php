<?php
namespace App\Services\Report;

use Illuminate\Support\Facades\DB;

class ReportBarangKeluarServices{

    public static function report($parameter){
        return DB::table('detail_barang_keluars')
                ->select([
                    'barangs.nama_barang',
                    'barangs.harga',
                    'barangs.satuan',
                ])
                ->selectRaw('sum(detail_barang_keluars.jumlah) as stok_berkurang')
                ->selectRaw('sum(detail_barang_keluars.sub_total) as total_penjualan')
                ->join('barangs','barangs.id','=','detail_barang_keluars.barang_id')
                ->join('barang_keluars','barang_keluars.id','=','detail_barang_keluars.barang_keluar_id')
                ->whereBetween('barang_keluars.tanggal_keluar',[$parameter['dari_tanggal'],$parameter['sampai_tanggal']])
                ->groupBy([
                    'detail_barang_keluars.barang_id',
                    'barangs.nama_barang',
                    'barangs.harga',
                    'barangs.satuan',
                ])
                ->get();
    }

    public static function exportExcel($parameter){

    }
}