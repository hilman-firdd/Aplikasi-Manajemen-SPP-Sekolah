@extends('layouts.master')

@section('site-name','Sistem Informasi SPP')
@section('page-name', 'Pengaturan')

@section('content')
    <div class="row">
        <div class="col-8">
            <form action="{{ route('pengaturan.store', $pengaturan->id) }}" method="post" class="card" enctype="multipart/form-data">
                <div class="card-header">
                    <h5 class="card-title">@yield('page-name')</h5>
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
                                <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{ $pengaturan->nama }}" required>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="oldImage" value="{{ asset('storage/logo').'/'.str_replace('public/logo/','', $pengaturan->logo) }}">
                                <div class="form-label">Logo</div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="logo">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="{{ url()->previous() }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-primary ml-auto ms-2">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection