@extends('layout.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Report Barang Keluar</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Report</li>
            <li class="breadcrumb-item active">Barang Keluar</li>
        </ol>
        <div class="bg-white shadow p-3 rounded-3 border border-2">
            <form action="" method="get">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="mb-2">
                            <label for="" class="form-label">Dari Tanggal</label>
                            <input type="date" name="dari_tanggal" id="" class="form-control" value="{{old('dari_tanggal')==null ? request('dari_tanggal') : old('dari_tanggal') }}">
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-2">
                            <label for="" class="form-label">Sampai Tanggal</label>
                            <input type="date" name="sampai_tanggal" id="" class="form-control" value="{{old('sampai_tanggal')==null ? request('sampai_tanggal') : old('sampai_tanggal') }}">
                            @error('sampai_tanggal')
                                <div class="text-form text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-end">
                            <button class="btn-primary btn-sm btn">Report</button>
                        </div>
                    </div>
                </div>
            </form>
            <hr>
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center p-2">
                        <span class="fw-bold">Report Barang Keluar Periode {{request('dari_tanggal')}} s/d {{request('sampai_tanggal')}}</span>
                        @if ($status_export)
                            <div class="export-btn d-flex gap-2">
                                <form action="{{route('reportBarangKeluar.exportPdf')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="dari_tanggal_export" value="{{request('dari_tanggal')}}">
                                    <input type="hidden" name="sampai_tanggal_export" value="{{request('sampai_tanggal')}}">
                                    <button type="submit" class="btn btn-sm btn-danger">Export PDF</button>
                                </form>
                                <form action="{{route('reportBarangKeluar.export')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="dari_tanggal_export" value="{{request('dari_tanggal')}}">
                                    <input type="hidden" name="sampai_tanggal_export" value="{{request('sampai_tanggal')}}">
                                    <button type="submit" class="btn btn-sm btn-success">Export Excel</button>
                                </form>
                            </div>
                        @endif            
                    </div>
                </div>
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Merek</th>
                                    <th>Jenis/Type</th>
                                    <th>Barang</th>
                                    <th>Stok Berkurang</th>
                                    <th>Total Penjualan (Rp.)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalPenjualan=0;
                                @endphp
                                @forelse ($report as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->merek}}</td>
                                        <td>{{$item->jenis}}</td>
                                        <td>{{$item->nama_barang}} {{$item->harga}}/{{$item->satuan}}</td>
                                        <td>{{$item->stok_berkurang}}</td>
                                        <td>{{number_format($item->total_penjualan,0,',','.')}}</td>
                                    </tr>
                                    @php
                                        $totalPenjualan+=$item->total_penjualan;
                                    @endphp
                                @empty
                                    
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5">Total (Rp.)</th>
                                    <th>{{number_format($totalPenjualan,0,',','.')}}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection