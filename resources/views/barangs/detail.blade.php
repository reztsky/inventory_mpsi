@extends('layout.layout')
@push('style')
    
@endpush
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-2">Barangs</h1>
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item active">Barangs</li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
            <div class="bg-white border border-1 shadow rounded-3 p-3 my-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="title">
                        <i class="fa-solid fa-file-circle-question"></i>
                        Barang Detail
                    </div>
                    <div class="handle">
                        <a class="btn btn-sm btn-danger" href="{{ url()->previous()}}">Kembali</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <dl class="row">
                            @foreach ($barang as $key=>$data)
                                @continue($key=='id')
                                <dt class="col-md-4 col-sm-6 col-12">{{Str::title(str_replace('_',' ',$key))}}</dt>
                                <dd class="col-md-8 col-sm-6 col-12">{{$data}}</dd>
                            @endforeach
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('script')
    
@endpush