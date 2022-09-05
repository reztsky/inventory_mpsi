<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable=[
        'nama_barang',
        'keterangan_barang',
        'harga',
        'satuan',
        'stok',
        'stok_minimal',
        'stok_maksimal'
    ];

    protected $casts=[
        'created_at'=>'datetime:d/m/Y H:i:s',
        'updated_at'=>'datetime:d/m/Y H:i:s',
    ];

    // protected function harga():Attribute{
    //     return Attribute::make(
    //         get:fn($value)=>"Rp. ".number_format($value,2,',','.'),
    //     );
    // }

    public function scopeSearchItem($query,$keyword){
        return $query
                ->select('id','harga')
                ->selectRaw('CONCAT(nama_barang," ",harga,"/",satuan) as name')
                ->where('nama_barang','LIKE',"%{$keyword}%");
    }
    
}
