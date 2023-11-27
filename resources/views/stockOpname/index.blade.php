@extends('layout.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-2">Barangs > Stock Opname</h1>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item active">Stock Opname</li>
        </ol>
        <div class="bg-white shadow border border-2 rounded-2 mb-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="title">
                    <i class="fas fa-table me-1"></i>
                    Barangs Table
                </div>
                <div class="handle">
                    <a href="{{route('barang.index')}}" class="btn btn-sm btn-danger">Kembali</a>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table" id="tableBarangs">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Merek</th>
                            <th>Nama Barang</th>
                            <th>Jenis/Type</th>
                            <th>Harga/Satuan</th>
                            <th>Stok Tersedia</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barangs as $barang)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$barang->merek}}</td>
                            <td>{{$barang->nama_barang}}</td>
                            <td>{{$barang->jenis}}</td>
                            <td>{{$barang->harga}} / {{$barang->satuan}}</td>
                            <td>{{$barang->stok}}</td>
                            <td>
                                <div class="gap-2">
                                    <a href="{{route('barang.show',$barang->id)}}"
                                        class="btn-success btn btn-sm my-1 my-md-0">Detail</a>
                                    <a href="{{route('barang.edit',$barang->id)}}"
                                        class="btn btn-warning btn-sm my-1 my-md-0">Edit</a>
                                    <a href="{{route('barang.delete',$barang->id)}}"
                                        class="btn-delete btn btn-danger btn-sm my-1 my-md-0">Delete</a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">No Found Record</td>
                        </tr>
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
            const datTable=new simpleDatatables.DataTable('#tableBarangs');

            deleteButton();
        });

        function deleteButton() {
            const btn_deletes=document.getElementsByClassName('btn-delete');
            
            for (const btn_delete of btn_deletes){
                btn_delete.addEventListener('click', event => {
                   if(!confirm('Yakin ingin menghapus data ?, menghapus data barang akan menghapus semua transaksi terkait barang tersebut')) event.preventDefault()
                })
            }
        }
</script>
@endpush