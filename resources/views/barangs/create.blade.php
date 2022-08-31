@extends('layout.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-2">Barangs</h1>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item active">Barangs</li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
        <div class="bg-white shadow border border-2 rounded-2 mb-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="title">
                    <i class="fa-solid fa-circle-plus"></i>
                    Create Barang
                </div>
                <div class="handle">
                    <a class="btn btn-sm btn-danger" href="{{route('barang.index')}}">Kembali</a>
                </div>
            </div>
            <hr>
            <form action="{{route('barang.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="mb-2">
                            <label for="" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" placeholder="Nama Barang" name="nama_barang" value="{{old('nama_barang')}}">
                            @error('nama_barang')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Keterangan Barang</label>
                            <input type="text" class="form-control" placeholder="Keterangan Barang" name="keterangan_barang" value="{{old('keterangan_barang')}}">
                            @error('keterangan_barang')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Harga Barang (Rp.)</label>
                            <input type="text" class="form-control" placeholder="Harga Barang" name="harga" value="{{old('harga')}}">
                            @error('harga')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-2">
                            <div class="d-flex">
                                <div class="col-md-6 col-12 pe-3">
                                    <label for="" class="form-label">Stok Tersedia</label>
                                    <input type="text" class="form-control" placeholder="Stok Tersedia" name="stok" value="{{old('stok')}}">
                                    @error('stok')
                                        <div class="form-text text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="" class="form-label">Satuan</label>
                                    <input type="text" class="form-control" placeholder="Satuan Barang" name="satuan" value="{{old('satuan')}}">
                                    @error('satuan')
                                        <div class="form-text text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Stok Minimal</label>
                            <input type="text" class="form-control" placeholder="Stok Minimal" name="stok_minimal" value="{{old('stok_minimal')}}">
                            @error('stok_minimal')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Stok Maksimal</label>
                            <input type="text" class="form-control" placeholder="Stok Maksimal" name="stok_maksimal" value="{{old('stok_maksimal')}}">
                            @error('stok_maksimal')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-sm btn-primary" type="submit">Create</button>
                </div>
            </form>
        </div>        
    </div>
</main>
@endsection