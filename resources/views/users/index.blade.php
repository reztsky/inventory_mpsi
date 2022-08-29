@extends('layout.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-2">Users</h1>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item active">Users</li>
        </ol>
        <div class="bg-white shadow border border-2 rounded-2 mb-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="title">
                    <i class="fas fa-table me-1"></i>
                    Users Table
                </div>
                <div class="handle">
                    <a class="btn btn-sm btn-primary" href="{{route('user.create')}}">Create</a>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table" id="tableUser">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Alamat</th>
                            <th>No. Telefon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->alamat}}</td>
                                <td>{{$user->no_telfon}}</td>
                                <td>
                                    <div class="gap-2">
                                        <button class="btn-success btn btn-sm my-1 my-md-0">Detail</button>
                                        <button class="btn btn-warning btn-sm my-1 my-md-0">Edit</button>
                                        <button class="btn btn-danger btn-sm my-1 my-md-0">Delete</button>
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

            const datatablesSimple = document.getElementById('tableUser');
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        });
    </script>
@endpush