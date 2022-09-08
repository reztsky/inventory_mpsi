@extends('layout.layout')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-md-6 col-12 mb-3 mb-md-0">
                <div class="bg-white shadow p-3 rounded-3 border border-2">
                    <h5>Barang Masuk</h5>
                    <canvas id="chartBarangMasuk"></canvas>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="bg-white shadow p-3 rounded-3 border border-2">
                    <h5>Barang Keluar</h5>
                    <canvas id="chartBarangKeluar"></canvas>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function setConfigChart(data,color,label){
            var config={
                type:'bar',
                data:{
                    datasets:[{
                        label:label,
                        backgroundColor: color,
                        borderColor: color,
                        data:data
                    }]
                },
                options:{
                    parsing:{
                        xAxisKey:'periode',
                        yAxisKey:'jumlah'
                    },
                }
            }

            return config
        }
        var barangMasuk={!!$chartTransaksi['barang_masuk']!!}
        var barangKeluar={!!$chartTransaksi['barang_keluar']!!}

        const chartBarangMasuk = new Chart(
            document.getElementById('chartBarangMasuk'),
            setConfigChart(barangMasuk,'rgb(255, 99, 132)','Barang Masuk')
        )

        const chartBarangKeluar = new Chart(
            document.getElementById('chartBarangKeluar'),
            setConfigChart(barangKeluar,'rgb(54, 162, 235)','Barang Keluar')
        )
        
    </script>
@endpush