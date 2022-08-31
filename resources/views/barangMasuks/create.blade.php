@extends('layout.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-2">Barang Masuks</h1>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item active">Barang Masuks</li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
        <div class="bg-white shadow border border-2 rounded-2 mb-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="title">
                    <i class="fa-solid fa-circle-plus"></i>
                    Create Barang Masuk
                </div>
                <div class="handle">
                    <a class="btn btn-sm btn-danger" href="{{route('barangMasuk.index')}}">Kembali</a>
                </div>
            </div>
            <hr>
            <form action="{{route('barangMasuk.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="mb-2">
                            <label for="" class="form-label">Barang</label>
                            <input type="text" id="search" data-provide="typeahead" name="search" placeholder="Barang" class="form-control" />
                            <input type="hidden" id="barang_id" name="barang_id">
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" placeholder="Jumlah">
                            @error('jumlah')
                                <div class="form-text tex-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Barang Dari</label>
                            <input type="text" class="form-control" name="barang_dari" placeholder="Barang Dari">
                            @error('barang_dari')
                                <div class="form-text tex-danger">{{$message}}</div>
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
</script>
@endpush