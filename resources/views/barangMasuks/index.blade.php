@extends('layout.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-2">Barang Masuk</h1>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item active">Barang Masuk</li>
        </ol>
        <div class="bg-white shadow border border-2 rounded-2 mb-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="title">
                    <i class="fas fa-table me-1"></i>
                    Barang Masuk Table
                </div>
                <div class="handle">
                    <a class="btn btn-sm btn-primary" href="{{route('barangMasuk.create')}}">Create</a>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table" id="tableBarangs">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal Terima</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Barang Dari</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barangMasuks as $barangMasuk)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$barangMasuk['tanggal_diterima']}}</td>
                                <td>{{$barangMasuk['barang']['nama_barang']}}</td>
                                <td>{{$barangMasuk['jumlah']}}</td>
                                <td>{{$barangMasuk['barang_dari']}}</td>
                                <td>
                                    <div class="gap-2">
                                        <a href="{{route('barangMasuk.show',$barangMasuk['id'])}}" class="btn-success btn btn-sm my-1 my-md-0">Detail</a>
                                        <a href="{{route('barangMasuk.edit',$barangMasuk['id'])}}"  class="btn btn-warning btn-sm my-1 my-md-0">Edit</a>
                                        <a href="{{route('barangMasuk.delete',$barangMasuk['id'])}}" class="btn-delete btn btn-danger btn-sm my-1 my-md-0">Delete</a>
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