@extends('layout.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-2">Users</h1>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item active">Users</li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
        <div class="bg-white shadow border border-2 rounded-2 mb-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="title">
                    <i class="fa-solid fa-circle-plus"></i>
                    Create Users
                </div>
                <div class="handle">
                    <a class="btn btn-sm btn-danger" href="{{route('user.index')}}">Kembali</a>
                </div>
            </div>
            <hr>
            <form action="{{route('user.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="mb-2">
                            <label for="" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}" required placeholder="Nama">
                            @error('name')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">NIK</label>
                            <input type="text" class="form-control" name="nik" value="{{old('nik')}}" required placeholder="NIK">
                            @error('nik')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Jenis Kelamin</label>
                            <div class="d-flex gap-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_laki" value="L" {{old('jenis_kelamin')=='L' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="jenis_kelamin_laki">
                                        Laki-Laki
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_perempuan" value="P" {{old('jenis_kelamin')=='P' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="jenis_kelamin_perempuan">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                            @error('jenis_kelamin')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Alamat</label>
                            <textarea name="alamat" id="" rows="2" class="form-control" placeholder="Alamat">{{old('alamat')}}</textarea>
                            @error('alamat')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-2">
                            <label for="" class="form-label">No. Telefon</label>
                            <input type="text" class="form-control" name="no_telfon" placeholder="No. Telefon" value="{{old('no_telfon')}}" required>
                            @error('no_telfon')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Role</label>
                            <select name="role_id" id="" class="form-select">
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}" selected>{{$role->role_name}}</option>    
                                @endforeach
                            </select>
                            @error('role_id')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username" value="{{old('username')}}" required>
                            @error('username')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                            @error('password')
                                <div class="form-text text-danger">{{$message}}</div>
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