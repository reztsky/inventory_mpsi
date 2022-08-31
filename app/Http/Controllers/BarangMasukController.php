<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index(){
        $barangMasuks=BarangMasuk::table()->get();
        return view('barangMasuks.index',compact('barangMasuks'));
    }

    public function create(){
        return view('barangMasuks.create');
    }

    public function show($id){
        return view('barangMasuks.detail');
    }

    public function store(Request $request){

    }

    public function edit($id){
        return view('barangMasuks.edit');
    }

    public function update(Request $request,$id){

    }

    public function delete($id){

    }

    public function autoComplete(Request $request){
        $barangs=Barang::searchItem($request->keyword)->get();
        return response()->json($barangs);
    }
}
