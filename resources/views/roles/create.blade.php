@extends('layout.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-2">Roles</h1>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item active">Roles</li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
        <div class="bg-white shadow border border-2 rounded-2 mb-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="title">
                    <i class="fa-solid fa-circle-plus"></i>
                    Create Roles
                </div>
                <div class="handle">
                    <a class="btn btn-sm btn-danger" href="{{route('role.index')}}">Kembali</a>
                </div>
            </div>
            <hr>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('role.store')}}" method="post">
               @csrf
                <div class="col-md-6 col-12">
                    <div class="mb-2">
                        <label for="" class="form-label">Role Name</label>
                        <input type="text" class="form-control" name="role_name" placeholder="Role Name">
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Permission</label>
                        @foreach($permissions as $permission)
                            <div class="form-check">
                                <input class="form-check-input" name="permissions[]" type="checkbox" value="{{$permission->id}}" id="{{$permission->id}}">
                                <label class="form-check-label" for="{{$permission->id}}">
                                {{$permission->name}}
                                </label>
                            </div>
                        @endforeach
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