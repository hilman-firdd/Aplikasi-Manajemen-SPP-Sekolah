@extends('layouts.master')

@section('site-name','Sistem Informasi SPP')
@section('page-name','Role')

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
                <a href="{{ route('role.create') }}" class="btn btn-outline-primary btn-sm ml-5">Tambah Role</a>
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
                            <th>Role</th>
                            <th>Display Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $index => $item)
                        <tr>
                            <td><span class="text-muted">{{ $index+1 }}</span></td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->display_name }}</td>
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
            <div class="card-footer">
                <div class="d-flex">
                    <div class="ml-auto mb-0">
                        {{ $roles->links() }}
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