<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $fillable=[
        'barang_id',
        'jumlah',
        'barang_dari',
        'nama_penerima',
        'tanggal_diterima',
        'bukti_terima',
    ];

    public function barang(){
        return $this->belongsTo(Barang::class,'barang_id','id');
    }

    public function scopeTable($query){
        return $query->select(['id','barang_id','jumlah','barang_dari','tanggal_diterima'])
                        ->with('barang');
    }
}
