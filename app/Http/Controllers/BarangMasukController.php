<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBarangMasukRequest;
use App\Http\Requests\UpdateBarangMasukRequest;
use App\Models\BarangMasuk;
use App\Services\BarangMasuk\CreateBarangMasukServices;
use App\Services\BarangMasuk\DeleteBarangMasukServices;
use App\Services\StokBarangServices;
use App\Services\ToastServices;
use App\Services\UpdateBarangMasukServices;

class BarangMasukController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:barangMasuk-list|barangMasuk-create|barangMasuk-edit|barangMasuk-delete', ['only' => ['index','show']]);
        $this->middleware('permission:barangMasuk-create', ['only' => ['create','store']]);
        $this->middleware('permission:barangMasuk-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:barangMasuk-delete', ['only' => ['destroy']]);
    }

    public function index(){
        $barangMasuks=BarangMasuk::table()->get()->toArray();
        return view('barangMasuks.index',compact('barangMasuks'));
    }

    public function create(){
        return view('barangMasuks.create');
    }

    public function show($id){
        $barangMasuk=BarangMasuk::with(['details.barang','user'])->findOrFail($id)->toArray();
        return view('barangMasuks.detail',compact('barangMasuk'));
    }

    public function store(CreateBarangMasukRequest $request){
        $createBarangMasukService=new CreateBarangMasukServices($request);
        $barangMasuk=$createBarangMasukService->store();
        
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
        $barangMasuk=(new DeleteBarangMasukServices($id))->delete();
        if(!$barangMasuk){
            return redirect()->route('barangMasuk.index')->with('message',ToastServices::failed('Menghapus'));
        }
        return redirect()->route('barangMasuk.index')->with('message',ToastServices::success('Menghapus'));
    }

}
