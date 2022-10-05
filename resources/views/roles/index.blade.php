@extends('layout.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-2">Roles</h1>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item active">Roles</li>
        </ol>
        <div class="bg-white shadow border border-2 rounded-2 mb-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="title">
                    <i class="fas fa-table me-1"></i>
                    Roles Table
                </div>
                <div class="handle">
                    <a class="btn btn-sm btn-primary" href="{{route('role.create')}}">Create</a>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table" id="tableUser">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$role->name}}</td>
                                <td>
                                    <a href="{{route('role.edit',$role->id)}}" class="btn btn-sm btn-success">Edit</a>
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