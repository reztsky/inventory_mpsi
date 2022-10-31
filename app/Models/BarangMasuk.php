<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $fillable=[
        'barang_dari',
        'no_telfon',
        'nama_penerima',
        'tanggal_diterima',
        'bukti_terima',
        'inserted_by',
    ];

    protected $casts=[
        'tanggal_diterima'=>'date:d-M-Y'
    ];

    public function details(){
        return $this->hasMany(DetailBarangMasuk::class,'barang_masuk_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'inserted_by','id');
    }

    public function scopeTable($query){
        return $query->select(['id','barang_dari','tanggal_diterima'])
                    ->with('details.barang');
    }

}
