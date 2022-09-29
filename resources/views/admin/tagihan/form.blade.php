@extends('layouts.master')

@section('site-name','Sistem Informasi SPP')
@section('page-name', (isset($tagihan) ? 'Ubah Tagihan' : 'Tagihan Baru'))

@push('css')
    <link rel="stylesheet" href="{{ asset('css/component-custom-switch.min.css') }}">
    <link href="{{ asset('template/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: black;
        }
        .select2{
            width: 100% !important;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-8">
            <form action="{{ (isset($tagihan) ? route('tagihan.update', $tagihan->id) : route('tagihan.create')) }}" method="post" class="card">
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
                                <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{ isset($tagihan) ? $tagihan->nama : old('nama') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" value="{{ isset($tagihan) ? $tagihan->jumlah : old('jumlah') }}" required>
                            </div>
                            <div class="form-group">
                                <div class="form-label">Peserta</div>
                                {{-- <div class="btn-group btn-group-toggle btn-group-pill" data-toggle="buttons">
                                    <label class="btn btn-outline-secondary btn-switch-on {{ isset($tagihan) ? ($tagihan->wajib_semua == 1 ? 'active' : '') : '' }}">
                                        <input type="radio" name="peserta" id="on"  value="1" autocomplete="off" class="custom-switch-input" {{ isset($tagihan) ? ($tagihan->wajib_semua == 1 ? 'checked' : '') : 'checked' }}> On
                                    </label>
                                </div>
                                <div class="btn-group btn-group-toggle btn-group-pill" data-toggle="buttons">
                                    <label class="btn btn-outline-secondary btn-switch-on {{ isset($tagihan) ? (($tagihan->kelas_id != null) ? 'active' : '') : '' }}">
                                        <input type="radio" name="peserta" id="on"  value="2" autocomplete="off" class="custom-switch-input" {{ isset($tagihan) ? (($tagihan->kelas_id != null) ? 'checked' : '') : '' }}> On
                                    </label>
                                </div>
                                <div class="btn-group btn-group-toggle btn-group-pill" data-toggle="buttons">
                                    <label class="btn btn-outline-secondary btn-switch-on {{ isset($tagihan) ? (($tagihan->kelas_id == null && $tagihan->wajib_semua == null) ? 'active' : '') : '' }}">
                                        <input type="radio" name="peserta" id="on"  value="3" autocomplete="off" class="custom-switch-input" {{ isset($tagihan) ? (($tagihan->kelas_id == null && $tagihan->wajib_semua == null) ? 'checked' : '') : '' }}> On
                                    </label>
                                </div> --}}
                                
                                <div class="custom-switch custom-switch-label-onoff d-flex align-items-center">
                                    <input type="checkbox" id="check" name="peserta" value="1" class="custom-switch-input" {{ isset($tagihan) ? ($tagihan->wajib_semua == 1 ? 'checked' : '') : 'checked' }} >
                                    <label class="custom-switch-btn" for="check"></label>
                                    <p class="mt-3 ms-2">Wajib Semua Siswa</p>
                                </div>
                                <div class="custom-switch custom-switch-label-onoff d-flex align-items-center">
                                    <input type="checkbox" id="check1" name="peserta" value="2" class="custom-switch-input" {{ isset($tagihan) ? (($tagihan->kelas_id != null) ? 'checked' : '') : '' }}>
                                    <label class="custom-switch-btn" for="check1"></label>
                                    <p class="mt-3 ms-2">Hanya Kelas</p>
                                </div>
                                <div class="custom-switch custom-switch-label-onoff d-flex align-items-center">
                                    <input type="checkbox" id="check2" name="peserta" value="3" class="custom-switch-input" {{ isset($tagihan) ? (($tagihan->kelas_id == null && $tagihan->wajib_semua == null) ? 'checked' : '') : '' }}>
                                    <label class="custom-switch-btn" for="check2"></label>
                                    <p class="mt-3 ms-2">Hanya Siswa</p>
                                </div>
                            </div>
                            <div class="form-group" style="display: {{ isset($tagihan) ? (($tagihan->kelas_id != null) ? 'block' : 'none') : 'none' }}" id="form-kelas">
                                <label class="form-label">Kelas</label>
                                <select class="form-control" name="kelas_id" id="hanya-kelas">
                                    @foreach($kelas as $item)
                                        <option value="{{ $item->id }}" {{ isset($tagihan) ? (($tagihan->kelas_id == $item->id) ? 'selected' : '') : '' }}>
                                            {{ $item->nama }} - {{ isset($item->periode) ? $item->periode->nama : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" style="display: {{ isset($tagihan) ? (($tagihan->kelas_id == null && $tagihan->wajib_semua == null) ? 'block' : 'none') : 'none' }}" id="form-siswa">
                                <label class="form-label">Siswa</label>
                                <select class="form-control" name="siswa_id[]" id="hanya-siswa" multiple>
                                    @foreach($siswa as $item)
                                        <option value="{{ $item->id }}" {{ isset($tagihan) ? (($tagihan->wajib_semua == null && $tagihan->kelas_id == null) ? (in_array($item->id, $tagihan->siswa->pluck('id')->toArray()) ? 'selected' : '') : '') : '' }}>
                                            {{ $item->nama }} - {{ $item->kelas->nama }} {{ isset($item->kelas->periode) ? "(". $item->kelas->periode->nama .")" : ''}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="{{ url()->previous() }}" class="btn btn-link">Batal</a>
                        <button type="submit" class="btn btn-primary ml-auto">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
<script src="{{ asset('template/assets/plugins/select2/select2.min.js') }}"></script>

<script>
        // $(document).ready(function () {
        //     $('#select-beast').selectize({});
        // });
        $('#hanya-kelas').select2({
            placeholder: "Pilih Kelas",
        });
        $('#hanya-siswa').select2({
            placeholder: "Pilih Siswa",
        });

        $('.custom-switch-input').change(function(){
            console.log(this)
            if(this.value == 2){
                $('#check').prop('checked', false);
                $('#check2').prop('checked', false);
                $('#form-kelas').show()
                $('#form-siswa').hide()
                
                $('#hanya-kelas').prop('required', true)
                $('#hanya-siswa').prop('required', false)
            }else if(this.value == 3){
                $('#check1').prop('checked', false);
                $('#check').prop('checked', false);
                $('#form-kelas').hide()
                $('#form-siswa').show()
                
                $('#hanya-kelas').prop('required', false)
                $('#hanya-siswa').prop('required', true)
            }else{
                $('#check1').prop('checked', false);
                $('#check2').prop('checked', false);
                $('#form-kelas').hide()
                $('#form-siswa').hide()

                $('#hanya-kelas').prop('required', false)
                $('#hanya-siswa').prop('required', false)
            }
        })
</script>
@endpush