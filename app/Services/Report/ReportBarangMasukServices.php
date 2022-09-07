<?php
namespace App\Services\Report;

use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\StyleBuilder;


class ReportBarangMasukServices{

    public static function report($parameter){
        return DB::table('detail_barang_masuks')
                ->select([
                    'barangs.nama_barang',
                    'barangs.harga',
                    'barangs.satuan'
                ])
                ->selectRaw('sum(detail_barang_masuks.jumlah) as stok_bertambah')
                ->join('barangs','barangs.id','=','detail_barang_masuks.barang_id')
                ->join('barang_masuks','barang_masuks.id','=','detail_barang_masuks.barang_masuk_id')
                ->whereBetween('barang_masuks.tanggal_diterima',[$parameter['dari_tanggal'],$parameter['sampai_tanggal']])
                ->groupBy([
                    'detail_barang_masuks.barang_id',
                    'barangs.nama_barang',
                    'barangs.harga',
                    'barangs.satuan',
                ])
                ->get();
    }

    public static function exportExcel($request){
        $parameter=[
            'dari_tanggal'=>$request['dari_tanggal_export'],
            'sampai_tanggal'=>$request['sampai_tanggal_export'],
        ];

        $dataExport=self::report($parameter);
        $filename=self::fileNameExcel($parameter);
        
        return (new FastExcel($dataExport))->download($filename);

    }

    private static function fileNameExcel($parameter){
        return "Barang Masuk_P_{$parameter['dari_tanggal']}_{$parameter['sampai_tanggal']}.xlsx";
    }
}