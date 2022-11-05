@extends('layouts.master')

@section('site-name','Sistem Informasi SPP')
@section('page-name', (isset($user) ? 'Ubah Pengguna' : 'Pengguna Baru'))

@section('content')
    <div class="row">
        <div class="col-8">
            <form action="{{ (isset($user) ? route('user.update', $user->id) : route('user.create')) }}" method="post" class="card">
                <div class="card-header">
                    <h3 class="card-title">@yield('page-name')</h3>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-12">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" placeholder="Nama" value="{{ isset($user) ? $user->name : old('name') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">EMail</label>
                                <input type="text" class="form-control" name="email" placeholder="Email" value="{{ isset($user) ? $user->email : old('email') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" value="" {{ isset($user) ? '' : 'required' }}>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" name="password_confirmation" value="" {{ isset($user) ? '' : 'required' }}>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <select id="select-beast" class="form-control custom-select" name="role">
                                    <?php if(isset($user->role)): ?>
                                    @foreach ($user->role as $data)
                                    <option value="{{ $data->id }}" {{ isset($user) ? ($data->name == $data->name ? 'selected' : '') : '' }}>{{ $data->name }}</option>
                                    @endforeach
                                    <option value="" disabled>--------------------</option>
                                    <?php endif;?>
                                    <option value="1" {{ isset($user) ? ($user->role == 'superadmin' ? 'selected' : '') : '' }}>superadmin</option>
                                    <option value="2" {{ isset($user) ? ($user->role == 'admin' ? 'selected' : '') : '' }}>admin</option>
                                    <option value="3" {{ isset($user) ? ($user->role == 'kepsek' ? 'selected' : '') : '' }}>kepsek</option>
                                    <option value="4" {{ isset($user) ? ($user->role == 'bendahara' ? 'selected' : '') : '' }}>bendahara</option>
                                    <option value="5" {{ isset($user) ? ($user->role == 'siswa' ? 'selected' : '') : '' }}>siswa</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="{{ url()->previous() }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-primary ms-2">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
<script>
    $(document).ready(function () {
        $('#select-beast').selectize({});
    });
</script>
@endpush