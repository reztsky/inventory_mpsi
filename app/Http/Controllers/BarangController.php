<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\Barang;
use App\Services\ToastServices;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    
    public function index()
    {
        $barangs=Barang::all(['id','nama_barang','keterangan_barang','harga','satuan','stok']);
        return view('barangs.index',compact('barangs'));
    }

   
    public function create()
    {
        return view('barangs.create');
    }

   
    public function store(CreateBarangRequest $request)
    {
        $barang=Barang::create($request->validated());

        if(!$barang){
            return redirect()->route('barang.index')->with('message',ToastServices::failed('Menambahkan'));
        }
        return redirect()->route('barang.index')->with('message',ToastServices::success('Menambahkan'));
    }

    
    public function show($id)
    {
        $barang=Barang::findOrFail($id)->toArray();
        return view('barangs.detail',compact('barang'));
    }

    
    public function edit($id)
    {
        $barang=Barang::findOrFail($id);
        return view('barangs.edit',compact('barang'));
    }

    
    public function update(UpdateBarangRequest $request, $id)
    {
        $barang=Barang::findOrFail($id)->update($request->validated());
        if(!$barang){
            return redirect()->route('barang.index')->with('message',ToastServices::failed('Mengupdate'));
        }
        return redirect()->route('barang.index')->with('message',ToastServices::success('Mengupdate'));
    }

    
    public function destroy($id)
    {
        $barang=Barang::destroy($id);
        if(!$barang){
            return redirect()->route('barang.index')->with('message',ToastServices::failed('Menghapus'));
        }
        return redirect()->route('barang.index')->with('message',ToastServices::success('Menghapus'));
    }
}
