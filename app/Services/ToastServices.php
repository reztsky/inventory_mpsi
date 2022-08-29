<?php
namespace App\Services;

class ToastServices{
    public static function success($aksi){
        return [
            'message'=>"Berhasil {$aksi} Data. ",
            'bg'=>'primary',
            'text'=>'white',
        ];
    }

    public static function failed($aksi){
        return [
            'message'=>"Gagal {$aksi} Data. ",
            'bg'=>'danger',
            'text'=>'white',
        ];
    }
}
