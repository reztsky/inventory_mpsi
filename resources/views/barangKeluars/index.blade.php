@extends('layout.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-2">Barang Keluar</h1>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item active">Barang Keluar</li>
        </ol>
        <div class="bg-white shadow border border-2 rounded-2 mb-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="title">
                    <i class="fas fa-table me-1"></i>
                    Barang Keluar Table
                </div>
                <div class="handle">
                    <a class="btn btn-sm btn-primary" href="{{route('barangKeluar.create')}}">Create</a>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table" id="tableBarangs">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal Kirim</th>
                            <th>No Transaksi</th>
                            <th>Tujuan</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barangKeluars as $barangKeluar)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$barangKeluar['tanggal_keluar']}}</td>
                                <td>{{$barangKeluar['no_transaksi']}}</td>
                                <td>{{$barangKeluar['tujuan_kirim']}}</td>
                                <td>{{$barangKeluar['total_harga']}}</td>
                                <td>
                                    <div class="gap-2">
                                        <a href="{{route('barangKeluar.show',$barangKeluar['id'])}}" class="btn-success btn btn-sm my-1 my-md-0">Detail</a>
                                        <a href="{{route('barangKeluar.edit',$barangKeluar['id'])}}"  class="btn btn-warning btn-sm my-1 my-md-0">Edit</a>
                                        <a href="{{route('barangKeluar.delete',$barangKeluar['id'])}}" class="btn-delete btn btn-danger btn-sm my-1 my-md-0">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
</main>
@endsection
@push('script')
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            // Simple-DataTables
            // https://github.com/fiduswriter/Simple-DataTables/wiki

            const datatablesSimple = document.getElementById('tableBarangs');
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }

            deleteButton();
        });

        function deleteButton() {
            const btn_deletes=document.getElementsByClassName('btn-delete');
            
            for (const btn_delete of btn_deletes){
                btn_delete.addEventListener('click', event => {
                   if(!confirm('Yakin ingin menghapus data ?')) event.preventDefault()
                })
            }
        }
    </script>
@endpush