@extends('layout.layout')
@push('style')
    
@endpush
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-2">Barang Masuk</h1>
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item active">Barang Masuk</li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
            <div class="bg-white border border-1 shadow rounded-3 p-3 my-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="title">
                        <i class="fa-solid fa-file-circle-question"></i>
                        Barang Masuk Detail
                    </div>
                    <div class="handle">
                        <a class="btn btn-sm btn-danger" href="{{route('barangMasuk.index')}}">Kembali</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-8 col-12">
                        <dl class="row">
                            <dt class="col-md-4 col-sm-6 col-12">Ditambahkan Oleh</dt>
                            <dd class="col-md-8 col-sm-6 col-12">{{$barangMasuk['user']['name']}}</dd>
                            <dt class="col-md-4 col-sm-6 col-12">Barang Dari</dt>
                            <dd class="col-md-8 col-sm-6 col-12">{{$barangMasuk['barang_dari']}}</dd>
                            <dt class="col-md-4 col-sm-6 col-12">No. Telp Pengirim</dt>
                            <dd class="col-md-8 col-sm-6 col-12">{{$barangMasuk['no_telfon']}}</dd>
                            <dt class="col-md-4 col-sm-6 col-12">Nama Penerima</dt>
                            <dd class="col-md-8 col-sm-6 col-12">{{$barangMasuk['nama_penerima']}}</dd>
                            <dt class="col-md-4 col-sm-6 col-12">Tanggal Diterima</dt>
                            <dd class="col-md-8 col-sm-6 col-12">{{$barangMasuk['tanggal_diterima']}}</dd>
                            <dt class="col-md-4 col-sm-6 col-12">Details</dt>
                            <dd class="col-md-8 col-sm-6 col-12">
                                <table class="table table-bordered my-2">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Barang</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($barangMasuk['details'] as $detail)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$detail['barang']['nama_barang']}} {{$detail['barang']['harga']}}/{{$detail['barang']['satuan']}}</td>
                                                <td>{{$detail['jumlah']}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </dd>
                            <dt class="col-md-4 col-sm-6 col-12">Bukti Terima</dt>
                            <dd class="col-md-8 col-sm-6 col-12">
                                <img src="{{asset('storage/BuktiTerima/'.$barangMasuk['bukti_terima'])}}" alt="" class="img-thumbnail" width="200px">
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('script')
    
@endpush