<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBarangMasukRequest;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Services\BuktiTerimaServices;
use App\Services\StokBarangServices;
use App\Services\ToastServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(CreateBarangMasukRequest $request,BuktiTerimaServices $buktiTerimaServices){
        //Prepare For Storing Barang Masuk to DB   
        $barangMasukForm=$request->safe()->except('bukti_terima');
        $barangMasukForm['bukti_terima']=$buktiTerimaServices->upload($request->bukti_terima);
        $barangMasukForm['inserted_by']=Auth::user()->id;

        $barangMasuk=BarangMasuk::create($barangMasukForm);
        StokBarangServices::increment($request->barang_id,$request->jumlah);

        if(!$barangMasuk){
            return redirect()->route('barangMasuk.index')->with('message',ToastServices::failed('Menambahkan'));
        }
        return redirect()->route('barangMasuk.index')->with('message',ToastServices::success('Menambahkan'));
        
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
