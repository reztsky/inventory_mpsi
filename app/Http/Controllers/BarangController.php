<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBarangRequest;
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
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
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
