<?php
namespace App\Services\Report;

use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel ;

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

    public static function exportExcel($request){
        $parameter=[
            'dari_tanggal'=>$request['dari_tanggal_export'],
            'sampai_tanggal'=>$request['sampai_tanggal_export'],
        ];

        
        $dataExport=self::report($parameter);
        $filename=self::fileNameExcel($parameter);
        
        return (new FastExcel($dataExport))->download($filename);
    }

    public static function exportPDF($request){
        $parameter=[
            'dari_tanggal'=>$request['dari_tanggal_export'],
            'sampai_tanggal'=>$request['sampai_tanggal_export'],
        ];

        $dataExport=self::report($parameter);
        $filename=self::fileNamePdf($parameter);

        return[
            'report'=>$dataExport,
            'fileName'=>$filename,
        ];  
    }

    private static function fileNamePdf($parameter){
        return "Barang Keluar_P_{$parameter['dari_tanggal']}_{$parameter['sampai_tanggal']}.pdf";
    }

    private static function fileNameExcel($parameter){
        return "Barang Keluar_P_{$parameter['dari_tanggal']}_{$parameter['sampai_tanggal']}.xlsx";
    }
}