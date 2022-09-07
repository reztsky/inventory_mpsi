<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Services\Report\ReportBarangMasukServices;
use Illuminate\Http\Request;

class ReportBarangMasukController extends Controller
{
    public function index(Request $request){
        $report=[];
        $status_export=false;
        if($request->filled(['dari_tanggal','sampai_tanggal'])){
            $request->validate([
                'dari_tanggal'=>'required',
                'sampai_tanggal'=>'required|after_or_equal:dari_tanggal',
            ]);
            $report=ReportBarangMasukServices::report($request->only(['dari_tanggal','sampai_tanggal']));
            $status_export=true;
        }

        return view('reportBarangMasuk.index',compact('report','status_export'));
    }

    public function export(Request $request){
        $validated=$request->validate([
                        'dari_tanggal_export'=>'required',
                        'sampai_tanggal_export'=>'required|after_or_equal:dari_tanggal',
                    ]);
        return ReportBarangMasukServices::exportExcel($validated);
    }
}
