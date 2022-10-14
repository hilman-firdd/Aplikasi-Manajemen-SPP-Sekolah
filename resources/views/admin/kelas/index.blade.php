@extends('layouts.master')

@section('site-name', 'Sistem Informasi SPP')
@section('page-name', 'Data Kelas')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            @yield('page-name')
        </h3>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="d-flex justify-content-between p-2">
                    <h5 class="card-title">@yield('page-name')</h5>
                    <a href="{{ route('kelas.create') }}" class="btn btn-outline-primary btn-sm ml-5">Tambah Kelas</a>
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
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead class="table-light">
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Periode</th>
                            <th>Nama</th>
                            <th>Action</th> 
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($kelas as $index => $item)
                            <tr>
                                <td><span class="text-muted">{{ (($index+1) + ($kelas->currentPage() * $kelas->perPage()) - $kelas->perPage()) }}</span></td>
                                <td>{{ (isset($item->periode) ? $item->periode->nama : '-')}}</td>
                                <td>
                                    {{ $item->nama }}
                                </td>
                                <td class="text-center d-flex align-items-center">
                                    <a class="icon" href="{{ route('kelas.edit', $item->id) }}" title="kelas item">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a class="icon btn-delete" href="#!" data-id="{{ $item->id }}" title="delete item">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                    <form action="{{ route('kelas.destroy', $item->id) }}" method="POST" id="form-{{ $item->id }}">
                                        @method('DELETE')
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
                            {{ $kelas->links() }}
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

    });
</script>
@endpush