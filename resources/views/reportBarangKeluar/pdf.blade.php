<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Export PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<style type="text/css">
    *{
        font-family: Arial, Helvetica, sans-serif;
    }
    td, th{
        border: solid 2px black;
    }
    th{
        text-align: center;
    }
    td, th{
        padding: 0.5rem
    }
</style>
<body>
    <h5 class="text-center h5 fw-bold">Report Barang Keluar</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Barang</th>
                <th>Jenis/Type</th>
                <th>Merek</th>
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
                    <td>{{$item->nama_barang}} {{$item->harga}}/{{$item->satuan}}</td>
                    <td>{{$item->jenis}}</td>
                    <td>{{$item->merek}}</td>
                    <td>{{$item->stok_berkurang}}</td>
                    <td>{{number_format($item->total_penjualan,0,',','.')}}</td>
                </tr>
                @php
                    $totalPenjualan+=$item->total_penjualan;
                @endphp
            @empty
                <tr>
                    <td colspan="4" align="left">No Found Record</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" align="left">Total (Rp.)</th>
                <th>{{number_format($totalPenjualan,0,',','.')}}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>