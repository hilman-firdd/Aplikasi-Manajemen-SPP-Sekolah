@extends('layouts.master')

@section('site-name', 'Sistem Informasi SPP')
@section('page-name', 'Data Siswa')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            @yield('page-name')
        </h3>
        <div class="d-flex">
            <form action="" method="GET" id="submit-search">
                <div class="input-group mb-3">
                    <div id="klik-search" style="padding:2px; cursor: pointer;">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa fa-search"></i></span>
                    </div>
                    <input type="text" style="height:32px; border-radius-right:12px; margin-left:-8px; margin-top:1px;" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"  placeholder="Cari Siswa" name="q">
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                @permission('siswa-create')
                <div class="d-flex justify-content-between p-2">
                    <a href="{{ route('siswa.create') }}" class="btn btn-outline-primary btn-sm ml-5">Tambah Siswa</a>
                    <div class="card-options">
                        <a href="{{ route('siswa.showimport') }}" class="btn btn-primary btn-sm">Import</a>
                        <a href="{{ route('siswa.export') }}" class="btn btn-secondary btn-sm ml-2" download="true">Export</a>
                    </div>
                </div>
                @endpermission
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
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead class="table-light">
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Nik</th>
                            <th>Kelas</th>
                            <th>Nama</th>
                            <th>Wali</th>
                            <th>Telp. Wali</th>
                            <th>Yatim</th>
                            <th>Action</th> 
                        </tr>
                        </thead>
                        <tbody>
                        @role('superadmin|admin|bendahara')
                        @foreach ($siswa as $index => $item)
                            <tr>
                                <td><span class="text-muted">{{ (($index+1) + ($siswa->currentPage() * $siswa->perPage()) - $siswa->perPage()) }}</span></td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ (isset($item->kelas) ? $item->kelas->nama : '-')}}</td>
                                <td>
                                    <a href="{{ route('siswa.show', $item->id) }}" class="link-unmuted">
                                        {{ $item->nama }}
                                    </a>
                                </td>
                                <td>
                                    {{ $item->nama_wali }}
                                </td>
                                <td>
                                    {{ $item->telp_wali }}
                                </td>
                                <td>
                                    @if($item->is_yatim)
                                        <span class="tag tag-green">Yatim</span>
                                    @endif
                                </td>
                                <td class="text-center d-flex align-items-center">
                                    <a class="icon" href="{{ route('siswa.show', $item->id) }}" title="lihat detail">
                                        <i class="fa fa-eye"></i> 
                                    </a>
                                    @permission('siswa-edit')
                                    <a class="icon" href="{{ route('siswa.edit', $item->id) }}" title="edit item">
                                        <i class="fa fa-edit"></i> 
                                    </a> 
                                    @endpermission
                                    @permission('siswa-delete')
                                    <a class="icon btn-delete" href="#!" data-id="{{ $item->id }}" title="delete item">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <form action="{{ route('siswa.destroy', $item->id) }}" method="POST" id="form-{{ $item->id }}">
                                        @csrf 
                                        @method('delete')
                                    </form>
                                    @endpermission
                                </td>
                            </tr>
                        @endforeach
                        @endrole
                        @role('siswa')
                        @foreach ($mySiswa as $index => $item)
                            <tr>
                                <td><span class="text-muted">{{ $index+1 }}</span></td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ (isset($item->kelas) ? $item->kelas->nama : '-')}}</td>
                                <td>
                                    <a href="{{ route('siswa.show', $item->id) }}" class="link-unmuted">
                                        {{ $item->nama }}
                                    </a>
                                </td>
                                <td>
                                    {{ $item->nama_wali }}
                                </td>
                                <td>
                                    {{ $item->telp_wali }}
                                </td>
                                <td>
                                    @if($item->is_yatim)
                                        <span class="tag tag-green">Yatim</span>
                                    @endif
                                </td>
                                <td class="text-center d-flex align-items-center">
                                    <a class="icon" href="{{ route('siswa.show', $item->id) }}" title="lihat detail">
                                        <i class="fa fa-eye"></i> 
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        @endrole
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <div class="ml-auto mb-0">
                            {{ $siswa->links() }}
                        </div>
                    </div>
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
                text: 'periode yang dihapus tidak dapat dikembalikan',
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

        $('#klik-search').click(function() {
            $('#submit-search').submit();
        })

    });
</script>
@endpush