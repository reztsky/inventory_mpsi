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
    <h5 class="text-center h5 fw-bold">Report Barang Masuk</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Barang</th>
                <th>Jenis/Type</th>
                <th>Merek</th>
                <th>Stok Bertambah</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($report as $item)
                @php
                    $total=0
                @endphp 
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->nama_barang}} {{$item->harga}}/{{$item->satuan}}</td>
                    <td>{{$item->jenis}}</td>
                    <td>{{$item->merek}}</td>
                    <td>{{$item->stok_bertambah}}</td>
                </tr>
                @php
                    $total=$total+$item->stok_bertambah
                @endphp
            @empty
                <tr>
                    <td colspan="5">No Found Record</td>
                </tr>
            @endforelse
        </tbody>  
        <tfoot>
            <tr>
                <td colspan="4">Total</td>
                <td>{{$total}}</td>
            </tr>
        </tfoot>    
    </table>
</body>
</html>