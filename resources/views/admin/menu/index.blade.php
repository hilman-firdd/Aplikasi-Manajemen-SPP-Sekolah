@extends('layouts.master')

@section('site-name','Sistem Informasi SPP')
@section('page-name','Menu')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        @yield('page-name')
    </h1>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title">@yield('page-name')</h5>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-default">
                    <i class="fas fa-plus"></i> Tambah Data
                </button>
            </div>
            @if(session()->has('msg'))
            <div class="card-alert alert alert-{{ session()->get('type') }}" id="message"
                style="border-radius: 0px !important">
                @if(session()->get('type') == 'success')
                <i class="fe fe-check mr-2" aria-hidden="true"></i>
                @else
                <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i>
                @endif
                {{ session()->get('msg') }}
            </div>
            @endif
            <div class="table-responsive">
                <table class="table card-table table-hover table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Menu</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($menus as $item)
                        <tr>
                            <td><span class="text-muted">{{ $loop->iteration }}</span></td>
                            <td>{{ $item->menu_nama }}</td>
                            <td>
                                @foreach($item->permissions as $p)
                                <span class="badge badge-success"> {{ $p->name }} </span>
                                @endforeach
                            </td>
                            <td>{{ $item->description }}</td>
                            <td class="text-center d-flex align-items-center">
                                <a class="icon" href="" title="edit item">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a class="icon btn-delete" href="#!" data-id="{{ $item->id }}" title="delete item">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <form action="" method="POST" id="form-{{ $item->id }}">
                                    @csrf
                                </form>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- <div class="card-footer">
                <div class="d-flex">
                    <div class="ml-auto mb-0">
                        {{ $menus->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title">Tambah Menu</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-bs-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('menu.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="menu">Nama Menu</label>@error('menu') <span class="text-danger">{{ $message
                            }}</span> @enderror
                        <input type="text" required name="menu" class="form-control @error('menu') is-invalid @enderror"
                            id="menu" placeholder="Masukan Nama Menu">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
                    text: 'user yang dihapus tidak dapat dikembalikan',
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