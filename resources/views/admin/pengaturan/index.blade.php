@extends('layouts.master')

@section('page-name','Pengaturan')

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            @yield('page-name')
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-options d-flex justify-content-between">
                        <h5 class="card-title">@yield('page-name')</h5>
                        <a href="{{ route('pengaturan.edit') }}" class="btn btn-primary btn-sm">Ubah</a>
                    </div>
                </div>
                @if(session()->has('msg'))
                <div class="card-alert alert alert-{{ session()->get('type') }}" id="message" style="border-radius: 0px !important">
                    @if(session()->get('type') == 'success')
                        <i class="fe fe-check mr-2" aria-hidden="true"></i>
                    @else
                        <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> 
                    @endif
                        {{ session()->get('msg') }}
                </div>
                @endif
                <div class="card-body">
                    <p>Nama Aplikasi : <b>{{ $pengaturan->nama }}</b></p>
                    <p>Logo : </p>
                        <img src="{{ isset($pengaturan->logo) ? (($pengaturan->logo != 'logo.png') ? asset('storage/logo').'/'.str_replace('public/logo/','', $pengaturan->logo): 'https://universalgranite.co.nz/wp-content/uploads/2019/08/Slate-Grey.jpg') : 'https://cutewallpaper.org/21/white-aesthetic-wallpaper/igchrryxthreads-on-Twitter-white-aesthetic-wallpaper-...-.jpg'  }}" alt="Logo Sistem" height="250px" width="250">
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function () {

        $(document).on('click','.btn-delete', function(){
            formid = $(this).attr('data-id');
            swal({
                title: 'Anda yakin ingin menghapus?',
                text: 'kelas yang dihapus tidak dapat dikembalikan',
                dangerMode: true,
                buttons: {
                    cancel: true,
                    confirm: true,
                },
            }).then((result) => {
                if (result) {
                    $('#form-' + formid).submit();
                }
            })
        })

    });
</script>
@endpush