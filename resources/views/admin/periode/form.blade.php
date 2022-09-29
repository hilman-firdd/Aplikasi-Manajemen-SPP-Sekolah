@extends('layouts.master')

@section('site-name','Sistem Informasi SPP')
@section('page-name', (isset($periode) ? 'Ubah Periode' : 'Periode Baru'))

@push('css')
<link rel="stylesheet" href="{{ asset('css/component-custom-switch.min.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-8">
            <form action="{{ (isset($periode) ? route('periode.update', $periode->id) : route('periode.create')) }}" method="post" class="card">
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif
                <div class="row p-3">
                    <div class="col-12">
                        @csrf
                        <div class="form-group my-3">
                            <label for="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{ isset($periode) ? $periode->nama : old('nama') }}" required>
                        </div>
                        <div class="form-group my-3">
                            <label for="form-label">Tanggal mulai s/d selesai</label>
                            <div class="row gutters-xs">
                                <div class="col-6">
                                    <input type="text" class="form-control" name="tgl_mulai" data-toggle="datepicker" placeholder="Tanggal Mulai" required autocomplete="off" value="{{ isset($periode) ? $periode->tgl_mulai : old('tgl_mulai') }}">
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" name="tgl_selesai" data-toggle="datepicker" placeholder="Tanggal Selesai" required autocomplete="off" value="{{ isset($periode) ? $periode->tgl_selesai : old('tgl_selesai') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label">Status</div>
                            <div class="custom-switch custom-switch-label-onoff">
                                <input type="checkbox" id="check" name="is_active" value="1" class="custom-switch-input" {{ isset($periode) ? ($periode->is_active ? 'checked' : '') : '' }}>
                                <label class="custom-switch-btn" for="check"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="{{ url()->previous() }}" class="btn btn-danger me-3">Batal</a>
                        <button type="submit" class="btn btn-success ml-auto">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
<script>
    $(document).ready(function () {
        $('[data-toggle="datepicker"]').datepicker({
            format: 'yyyy-MM-dd'
        });
    });
</script>
@endpush