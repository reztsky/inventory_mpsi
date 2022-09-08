<?php

namespace App\Http\Controllers;

use App\Services\Dashboard\DashboardServices;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $chartTransaksi=[
            'barang_keluar'=>DashboardServices::chartBarangKeluar(),
            'barang_masuk'=>DashboardServices::chartBarangMasuk(),
        ];

        return view('dashboard.dashboard',compact('chartTransaksi'));
    }
}
