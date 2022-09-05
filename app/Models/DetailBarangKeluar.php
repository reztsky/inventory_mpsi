<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBarangKeluar extends Model
{
    use HasFactory;

    protected $fillable=[
        'barang_keluar_id',
        'barang_id',
        'jumlah',
        'sub_total',
    ];

    public function barangKeluar(){
        return $this->belongsTo(BarangKeluar::class,'barang_keluar_id','id');
    }

    public function barang(){
        return $this->belongsTo(Barang::class,'barang_id','id');
    }
}
