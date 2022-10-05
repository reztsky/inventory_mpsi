@extends('layout.layout')
@push('style')
    
@endpush
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-2">Users</h1>
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item active">Users</li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
            <div class="bg-white border border-1 shadow rounded-3 p-3 my-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="title">
                        <i class="fa-solid fa-file-circle-question"></i>
                        User Detail
                    </div>
                    <div class="handle">
                        <a class="btn btn-sm btn-danger" href="{{route('user.index')}}">Kembali</a>
                    </div>  
                </div>
                <hr>
                
                <div class="row">
                    <div class="col-md-6 col-12">
                        <dl class="row">
                            <dt class="col-md-4 col-sm-6 col-12">Nama</dt>
                            <dd class="col-md-8 col-sm-6 col-12">{{$user->name}}</dd>
                            <dt class="col-md-4 col-sm-6 col-12">NIK</dt>
                            <dd class="col-md-8 col-sm-6 col-12">{{$user->nik}}</dd>
                            <dt class="col-md-4 col-sm-6 col-12">Alamat</dt>
                            <dd class="col-md-8 col-sm-6 col-12">{{$user->alamat}}</dd>
                            <dt class="col-md-4 col-sm-6 col-12">No. Telefon</dt>
                            <dd class="col-md-8 col-sm-6 col-12">{{$user->no_telfon}}</dd>
                            <dt class="col-md-4 col-sm-6 col-12">Username</dt>
                            <dd class="col-md-8 col-sm-6 col-12">{{$user->username}}</dd>
                            <dt class="col-md-4 col-sm-6 col-12">Role</dt>
                            <dd class="col-md-8 col-sm-6 col-12">{{$user->roles->first()->name}}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('script')
    
@endpush