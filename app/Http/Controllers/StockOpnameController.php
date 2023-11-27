<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class StockOpnameController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:stockOpname-list|stockOpname-create|stockOpname-edit|stockOpname-delete', ['only' => ['index','show']]);
        $this->middleware('permission:barang-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:barang-delete', ['only' => ['destroy']]);
    }

    public function index(){
        $barangs=Barang::select(['id','merek','jenis','nama_barang','keterangan_barang','harga','satuan','stok'])->orderBy('merek')->get();
        return view('stockOpname.index',compact('barangs'));
    }
}
