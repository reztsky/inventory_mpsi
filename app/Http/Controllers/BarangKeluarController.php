<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBarangKeluarRequest;
use App\Models\BarangKeluar;
use App\Services\ToastServices;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index(){
        $barangKeluars=BarangKeluar::table();
        return view('barangKeluars.index',compact('barangKeluars'));
    }

    public function create(){
        return view('barangKeluars.create');
    }

    public function store(CreateBarangKeluarRequest $request){

        dd($request);
        if(!$barangKeluar){
            return redirect()->route('barangKeluar.index')->with('message',ToastServices::failed('Menambahkan'));
        }
        return redirect()->route('barangKeluar.index')->with('message',ToastServices::success('Menambahkan'));
    }

    public function edit($id){
        return view('barangKeluars.edit');
    }

    public function update(Request $request,$id){

        $barangKeluar='';
        if(!$barangKeluar){
            return redirect()->route('barang.index')->with('message',ToastServices::failed('Mengupdate'));
        }
        return redirect()->route('barang.index')->with('message',ToastServices::success('Mengupdate'));
    }

    public function delete($id){

        $barangKeluar='';
        if(!$barangKeluar){
            return redirect()->route('barang.index')->with('message',ToastServices::failed('Menghapus'));
        }
        return redirect()->route('barang.index')->with('message',ToastServices::success('Menghapus'));
    }
}
