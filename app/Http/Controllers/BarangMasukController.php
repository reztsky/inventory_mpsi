<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBarangMasukRequest;
use App\Http\Requests\UpdateBarangMasukRequest;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Services\BuktiTerimaServices;
use App\Services\StokBarangServices;
use App\Services\ToastServices;
use App\Services\UpdateBarangMasukServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangMasukController extends Controller
{
    public function index(){
        $barangMasuks=BarangMasuk::table()->get()->toArray();
        return view('barangMasuks.index',compact('barangMasuks'));
    }

    public function create(){
        return view('barangMasuks.create');
    }

    public function show($id){
        $barangMasuk=BarangMasuk::with(['barang','user'])->findOrFail($id)->toArray();
        return view('barangMasuks.detail',compact('barangMasuk'));
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
        $barangMasuk=BarangMasuk::with('barang')->findOrFail($id);
        return view('barangMasuks.edit',compact('barangMasuk'));
    }

    public function update(UpdateBarangMasukRequest $request,$id){
       $updateBarangMasukServices=new UpdateBarangMasukServices($request,$id);
       if(!$updateBarangMasukServices->update()){
        return redirect()->route('barangMasuk.index')->with('message',ToastServices::failed('Mengupdate'));
        }
        return redirect()->route('barangMasuk.index')->with('message',ToastServices::success('Mengupdate'));

    }

    public function delete($id){
        $barangMasuk=BarangMasuk::findOrFail($id);
        StokBarangServices::decrement($barangMasuk->barang_id,$barangMasuk->jumlah);
        $barangMasuk=BarangMasuk::destroy($id);
        if(!$barangMasuk){
            return redirect()->route('barangMasuk.index')->with('message',ToastServices::failed('Menghapus'));
        }
        return redirect()->route('barangMasuk.index')->with('message',ToastServices::success('Menghapus'));
    }

}
