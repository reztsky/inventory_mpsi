@extends('layout.layout')
@push('style')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-2">Barang Keluars</h1>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item active">Barang Keluars</li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
        <div class="bg-white shadow border border-2 rounded-2 mb-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="title">
                    <i class="fa-solid fa-circle-plus"></i>
                    Create Barang Keluar
                </div>
                <div class="handle">
                    <a class="btn btn-sm btn-danger" href="{{route('barangKeluar.index')}}">Kembali</a>
                </div>
            </div>
            <hr>
            <form action="{{route('barangKeluar.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row" id="app">
                    <div class="col-md-4 col-12">
                        <div class="mb-2">
                            <label for="" class="form-label">Tujuan Kirim</label>
                            <input type="text" class="form-control" name="tujuan_kirim" value="{{old('tujuan_kirim')}}" placeholder="Tujuan Kirim">
                            @error('tujuan_kirim')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Tanggal Kirim</label>
                            <input type="date" class="form-control" name="tanggal_keluar" value="{{old('tanggal_keluar')}}">
                            @error('tanggal_keluar')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Total Harga</label>
                            <input type="text" class="form-control" placeholder="Total Harga" name="total_harga" readonly v-model="total">
                            @error('total_harga')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-8 col-12" id="cardBarang"> 
                        <div class="card">
                            <div class="card-header d-flex justify-content-end">
                                <div class="d-flex justify-content-end">
                                    <button @click="addMore()" type="button" class="btn btn-sm btn-success">Tambah Barang</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div v-for="(barang,index) in barangs">      
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-12">
                                            <div class="mb-2">
                                                <label for="" class="form-label">Barang</label>
                                                <input type="text" class="form-control search" placeholder="Barang" @keyup="searchBarang(index)" @focusout="setBarangId(index)">
                                                <input type="hidden" :id="'barang_id-'+index">
                                                <input type="hidden" :id="'harga_barang-'+index">
                                                <input type="hidden" class="barang-id" name="barang_id[]" v-model="barang.barang_id">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-5 col-12">
                                            <div class="mb-2">
                                                <label for="" class="form-label">Jumlah</label>
                                                <input type="number" class="form-control" placeholder="Jumlah" name="jumlah[]" @keyup="calculateSubTotal(index)" v-model="barang.jumlah">
                                                <div class="form-text text-danger" :id="'warning-text-'+index"></div>
                                                @error('jumlah.*')
                                                    <div class="form-text text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-5 col-12">
                                            <label for="" class="form-label">Sub Total</label>
                                            <div class="mb-2 input-group">
                                                <input type="text" class="form-control" placeholder="Sub Total" readonly name="sub_total[]" v-model="barang.sub_total">
                                                <button  v-show="index !=0 " class="btn btn-sm btn-danger input-group-text" @click="removeBarang(index)">X</button>
                                            </div>
                                            @error('sub_total.*')
                                                <div class="form-text text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                     
                        <hr>
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
<script src="https://unpkg.com/vue@3"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</script>
<script>
    const { createApp,onMounted } = Vue
  
    createApp({
      data() {
        return {
            total:0,
            barangs:[
                {
                    'search_barang':'',
                    'barang_id':'',
                    'jumlah':'',
                    'sub_total':0,
                }
            ],
            searchs:[]
        }
      },
      methods:{
        addMore(){
            this.barangs.push({
                'search_barang':'',
                'barang_id':'',
                'jumlah':'',
                'sub_total':0,
            })
        },
        removeBarang(index){
            this.barangs.splice(index,1)
            this.calculateTotal()
        },
        searchBarang(index){
            var route="{{route('barang.autoComplete')}}"
                var searchInput=$(`.search:eq(${index})`)

                searchInput.autocomplete({
                    source:function(request,response){
                        $.ajax({
                            url:route,
                            data:{
                                name:request.term
                            },
                            dataType:"json",
                            success:function(data){
                                var resp=$.map(data,function(obj){
                                    return {
                                        value:obj.name,
                                        label:obj.name,
                                        id:obj.id,
                                        harga:obj.harga
                                    }
                                })
                                response(resp);
                            }
                        })
                    },
                    select:function(event,ui){
                        $(`#barang_id-${index}`).val(ui.item.id)
                        $(`#harga_barang-${index}`).val(ui.item.harga)
                    }
                })
        },
        setBarangId(index){
            var barangId=$(`#barang_id-${index}`).val()
            this.barangs[index].barang_id=barangId
        },
        calculateSubTotal(index){
            var harga_barang=$(`#harga_barang-${index}`).val()
            this.barangs[index].sub_total=this.barangs[index].jumlah*parseInt(harga_barang)
            this.calculateTotal()
            this.checkStock(index)
        },
        checkStock(index){
            var barangId=$(`#barang_id-${index}`).val()
            var route="{{route('barangKeluar.checkStock')}}"
            var jumlah=this.barangs[index].jumlah
            if(jumlah=='') return
            $.ajax({
                url:route,
                data:{
                    barang_id:barangId,
                    jumlah:jumlah
                },
                success:function(response){
                    $(`#warning-text-${index}`).html(response.message)
                }
            })
        },
        calculateTotal(){
            this.total=0
            this.barangs.forEach((row,index)=>{
                this.total+=row.sub_total
            })
        }
      }
    }).mount('#app')
</script>
@endpush
