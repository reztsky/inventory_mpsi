<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $fillable=[
        'no_tranksaksi',
        'tanggal_keluar',
        'tujuan_kirim',
        'total_harga',
    ];

    public function detailBarangKeluar(){
        $this->hasMany(DetailBarangKeluar::class,'barang_keluar_id','id');
    }

    public function scopeTable($query){
        return $query->get([
            'id',
            'tanggal_keluar',
            'no_transaksi',
            'tujuan_kirim',
            'total_harga'
        ])->toArray();
    }
}
