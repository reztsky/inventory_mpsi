@extends('layout.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-2">Barang Masuks</h1>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item active">Barang Masuks</li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
        <div class="bg-white shadow border border-2 rounded-2 mb-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="title">
                    <i class="fa-solid fa-file-pen"></i>
                    Edit Barang Masuk
                </div>
                <div class="handle">
                    <a class="btn btn-sm btn-danger" href="{{route('barangMasuk.index')}}">Kembali</a>
                </div>
            </div>
            <hr>
            <form action="{{route('barangMasuk.update',$barangMasuk->id)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="mb-2">
                            <label for="" class="form-label">Barang</label>
                            <input type="text" id="search" data-provide="typeahead" name="search" placeholder="Barang" class="form-control" value="{{$barangMasuk->barang->nama_barang}} {{$barangMasuk->barang->harga}}/{{$barangMasuk->barang->satuan}}"/>
                            <input type="hidden" id="barang_id" name="barang_id" value="{{$barangMasuk->barang_id}}">
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" placeholder="Jumlah" value="{{$barangMasuk->jumlah}}">
                            @error('jumlah')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Barang Dari</label>
                            <input type="text" class="form-control" name="barang_dari" placeholder="Barang Dari" value="{{$barangMasuk->barang_dari}}">
                            @error('barang_dari')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-2">
                            <label for="" class="form-label">Nama Penerima</label>
                            <input type="text" class="form-control" name="nama_penerima" placeholder="Nama Penerima" value="{{$barangMasuk->nama_penerima}}">
                            @error('nama_penerima')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Tanggal Diterima</label>
                            <input type="date" class="form-control" name="tanggal_diterima" value="{{$barangMasuk->tanggal_diterima->format('Y-m-d')}}">
                            @error('tanggal_diterima')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Bukti Terima</label>
                            <input type="file" name="bukti_terima" id="" class="form-control">
                            <div class="form-text">
                                <ul class="list-unstyled mb-0">
                                    <li>Jika Tidak Ingin Mengubah Bukti Terima Biarkan Kosong</li>
                                    <li>Maksimal File 2MB</li>
                                    <li>Format File Berupa Foto <span class="fw-italic">(jpg, png, jpeg)</span> </li>
                                </ul>
                            </div>
                            @error('bukti_terima')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-sm btn-success" type="submit">Update</button>
                </div>
            </form>
        </div>        
    </div>
</main>
@endsection
@push('script')
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
</script>
<script>
    var route="{{route('barangMasuk.autoComplete')}}"
   
    $('#search').typeahead({
        source:function(keyword,process){
            return $.get(route,{keyword:keyword}, function(data){
                return process(data)
            })
        },
        afterSelect:function(selected){
            $('#barang_id').val(selected.id)
        },
     })
     $('#search').change(function(){
        var current=$('#search').val()
        if(!current){
            $('#barang_id').val('')
        }
     })
</script>
@endpush