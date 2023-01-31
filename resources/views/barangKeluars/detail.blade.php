@extends('layout.layout')
@push('style')
    
@endpush
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-2">Barang Keluar</h1>
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item active">Barang Keluar</li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
            <div class="bg-white border border-1 shadow rounded-3 p-3 my-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="title">
                        <i class="fa-solid fa-file-circle-question"></i>
                        Barang Keluar Detail
                    </div>
                    <div class="handle">
                        <a class="btn btn-sm btn-danger" href="{{route('barangKeluar.index')}}">Kembali</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-8 col-12">
                        <dl class="row">
                            <dt class="col-md-4 col-sm-6 col-12">No. Transaksi</dt>
                            <dd class="col-md-8 col-sm-6 col-12">{{$barangKeluar->no_transaksi}}</dd>
                            <dt class="col-md-4 col-sm-6 col-12">Tanggal Transaksi</dt>
                            <dd class="col-md-8 col-sm-6 col-12">{{$barangKeluar->tanggal_keluar}}</dd>
                            <dt class="col-md-4 col-sm-6 col-12">Tujuan Kirim</dt>
                            <dd class="col-md-8 col-sm-6 col-12">{{$barangKeluar->tujuan_kirim}}</dd>
                            <dt class="col-md-4 col-sm-6 col-12">Total Harga</dt>
                            <dd class="col-md-8 col-sm-6 col-12">Rp. {{number_format($barangKeluar->total_harga,2,',','.')}}</dd>
                            <dt class="col-md-4 col-sm-6 col-12">Details Barang :</dt>
                            <dd class="col-md-12 col-sm-12 col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered mt-2 table-custom-responsive">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Barang</th>
                                                <th>Jenis/Type</th>
                                                <th>Merek</th>
                                                <th>Jumlah</th>
                                                <th>Sub. Total (Rp.)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($barangKeluar->details as $detail)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$detail->barang->nama_barang}}</td>
                                                    <td>{{$detail->barang->jenis}}</td>
                                                    <td>{{$detail->barang->merek}}</td>
                                                    <td>{{$detail->jumlah}}</td>
                                                    <td>{{number_format($detail->sub_total,0,',','.')}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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