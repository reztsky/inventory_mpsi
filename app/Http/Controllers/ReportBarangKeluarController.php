<?php

namespace App\Http\Controllers;

use App\Services\Report\ReportBarangKeluarServices;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportBarangKeluarController extends Controller
{
    public function index(Request $request){
        $report=[];
        $status_export=false;
        if($request->filled(['dari_tanggal','sampai_tanggal'])){
            $request->validate([
                'dari_tanggal'=>'required',
                'sampai_tanggal'=>'required|after_or_equal:dari_tanggal',
            ]);
            $report=ReportBarangKeluarServices::report($request->only(['dari_tanggal','sampai_tanggal']));
            $status_export=true;
        }

        return view('reportBarangKeluar.index',compact('report','status_export'));
    }

    public function export(Request $request){
        $validated=$request->validate([
                        'dari_tanggal_export'=>'required',
                        'sampai_tanggal_export'=>'required|after_or_equal:dari_tanggal',
                    ]);
        return ReportBarangKeluarServices::exportExcel($validated);
    }

    public function exportPdf(Request $request){
        $validated=$request->validate([
            'dari_tanggal_export'=>'required',
            'sampai_tanggal_export'=>'required|after_or_equal:dari_tanggal',
        ]);

        $exportPdf=ReportBarangKeluarServices::exportPDF($validated);

        $pdf = Pdf::loadView('reportBarangKeluar.pdf',['report'=>$exportPdf['report']]);
    	return $pdf->download($exportPdf['fileName']);
    }
}
