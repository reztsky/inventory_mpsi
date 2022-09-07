<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class DetailBarangMasuk extends Model
{
    use HasFactory;

    protected $fillable=[
        'barang_masuk_id',
        'barang_id',
        'jumlah',
    ];

    public function barangMasuk(){
        return $this->belongsTo(BarangMasuk::class,'barang_masuk_id','id');
    }

    public function barang(){
        return $this->belongsTo(Barang::class,'barang_id','id');
    }
}
