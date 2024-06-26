<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBarangKeluarRequest;
use App\Models\BarangKeluar;
use App\Services\BarangKeluar\CreateBarangKeluarServices;
use App\Services\BarangKeluar\DeleteBarangKeluarServices;
use App\Services\StokBarangServices;
use App\Services\ToastServices;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:barangKeluar-list|barangKeluar-create|barangKeluar-edit|barangKeluar-delete', ['only' => ['index','show']]);
        $this->middleware('permission:barangKeluar-create', ['only' => ['create','store']]);
        $this->middleware('permission:barangKeluar-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:barangKeluar-delete', ['only' => ['destroy']]);
    }

    public function index(){
        $barangKeluars=BarangKeluar::table();
        return view('barangKeluars.index',compact('barangKeluars'));
    }

    public function create(){
        return view('barangKeluars.create');
    }

    public function show($id){
        $barangKeluar=BarangKeluar::with(['details.barang'])->whereId($id)->get()->first();
        return view('barangKeluars.detail',compact('barangKeluar'));
    }

    public function store(CreateBarangKeluarRequest $request){
        $createBarangKeluarServices=new CreateBarangKeluarServices($request);
        $barangKeluar=$createBarangKeluarServices->store();
        
        if(!$barangKeluar){
            return redirect()->route('barangKeluar.index')->with('message',ToastServices::failed('Menambahkan'));
        }
        return redirect()->route('barangKeluar.index')->with('message',ToastServices::success('Menambahkan'));
    }

    public function edit($id){
        $barangKeluar=BarangKeluar::with('details.barang')->findOrFail($id);
        return view('barangKeluars.edit',compact('barangKeluar'));
    }

    public function update(Request $request,$id){

        $barangKeluar='';
        if(!$barangKeluar){
            return redirect()->route('barang.index')->with('message',ToastServices::failed('Mengupdate'));
        }
        return redirect()->route('barang.index')->with('message',ToastServices::success('Mengupdate'));
    }

    public function delete($id){
        $deleteBarangKeluarService=new DeleteBarangKeluarServices($id);
        $barangKeluar=$deleteBarangKeluarService->delete();
        
        if(!$barangKeluar){
            return redirect()->route('barangKeluar.index')->with('message',ToastServices::failed('Menghapus'));
        }
        return redirect()->route('barangKeluar.index')->with('message',ToastServices::success('Menghapus'));
    }

    public function checkStock(Request $request){
        if(StokBarangServices::checkStok($request->barang_id,$request->jumlah)){
            return response()->json(['message'=>''],200);
        }
        
        return response()->json(['message'=>'Stok Barang Kurang'],200);
    }
}
