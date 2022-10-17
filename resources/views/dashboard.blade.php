@extends('layouts.master')
@section('title', 'Dashboard')

@section('content')
<section class="p-5">
    <header>
      <div class="d-flex align-items-center">
        <h3>Selamat Datang, </h3>  @role('superadmin|admin|kepsek|bendahara|siswa') <h5> Hai.. {{ Auth::user()->name }}</h5> @endrole
      </div>
      <p>Dashboard</p>
    </header>
    <div class="information d-flex flex-column gap-5">
      <div class="row mb-2 gap-5">
        @role('superadmin|admin|bendahara|kepsek')
        <div class="col-xl-4 col-12 card debit justify-content-center align-items-center">
          <h6>Rp. {{ format_idr($total_uang) }}</h6>
          <p class="fs-6" style="font-size: 14px!important;">Total Uang</p>
        </div>
        <div class="col-xl-4 col-12 card debit justify-content-center align-items-center">
          <h6>Rp. {{ format_idr($total_uang_masuk) }}</h6>
          <p class="fs-6" style="font-size: 14px!important;">Total Uang Masuk</p>
        </div>
        <div class="col-xl-4 col-12 card debit justify-content-center align-items-center">
          <h6>Rp. {{ format_idr($total_uang_keluar) }}</h6>
          <p class="fs-6" style="font-size: 14px!important;">Total Uang Keluar</p>
        </div>
        <div class="col-xl-4 col-12 card debit justify-content-center align-items-center">
          <h6>Rp. {{ format_idr($total_uang_spp) }}</h6>
          <p class="fs-6" style="font-size: 14px!important;">Total Uang SPP</p>
        </div>
        <div class="col-xl-4 col-12 card debit justify-content-center align-items-center">
          <h6>Rp. {{ format_idr($total_uang_tabungan) }}</h6>
          <p class="fs-6" style="font-size: 12px!important;">Total Uang Tabungan</p>
        </div>
        <div class="col-xl-4 col-12 card debit justify-content-center align-items-center">
          <h6>{{ $siswa }}</h6>
          <p class="fs-6" style="font-size: 14px!important;">Total Siswa</p>
        </div>
        <div class="col-xl-4 col-12 card debit justify-content-center align-items-center">
          <h6>{{ $kelas }}</h6>
          <p class="fs-6" style="font-size: 14px!important;">Total Kelas</p>
        </div>
        <div class="col-xl-4 col-12 card debit justify-content-center align-items-center">
          <h6>{{ $item }}</h6>
          <p class="fs-6" style="font-size: 14px!important;">Item Tagihan</p>
        </div>
        @endrole
        @role('siswa')
        <div class="col-xl-4 col-12 card debit justify-content-center align-items-center">
          <h6>
            {{ $total_uang_tabungan_siswa ? format_idr($total_uang_tabungan_siswa[0]["jumlah"]) : '0' }}
          </h6>
          <p class="fs-6" style="font-size: 14px!important;">Tagihan</p>
        </div>
        <div class="col-xl-4 col-12 card debit justify-content-center align-items-center">
          <h6>{{ $item }}</h6>
          <p class="fs-6" style="font-size: 14px!important;">Tabungan</p>
        </div>
        @endrole
      </div>
    </div>
    @role('superadmin|admin|bendahara')
    <div class="row d-flex mt-4">
      <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title fs-6">Laporan Harian : {{ now()->format('d-m-Y') }}</h3>
                <div class="card-options d-flex gap-2">
                    <input class="form-control mr-2" type="text" name="dates" style="max-width: 200px" data-toggle="datepicker" value="" autocomplete="off" id="date">
                    <button id="btn-cetak-spp" class="btn btn-primary btn-sm mr-1" value="#">Cetak</button>
                    <button id="btn-export-spp" class="btn btn-primary btn-sm">Export</button>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table card-table table-hover table-center text-nowrap title" id="print">
                    <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Pembayaran</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($transaksi as $item)
                          <tr>
                              <td>{{ $item->created_at->format('d-m-Y') }}</td>
                              <td>{{ $item->siswa->nama }}</td>
                              <td>{{ $item->tagihan->nama }}</td>
                              <td>IDR. {{ format_idr($item->keuangan->jumlah) }}</td>
                              @php
                                  $jumlah += $item->keuangan->jumlah
                              @endphp
                          </tr>
                      @endforeach
                          <tr>
                              <td><b>Total</b></td>
                              <td></td>
                              <td></td>
                              <td>IDR. {{ format_idr($jumlah) }}</td>
                          </tr>
                      </tbody>
                </table>
                </div>
            </div>
      </div>
    </div>
    @endrole
    @role('siswa')
    <div class="row d-flex mt-4">
      <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title fs-6">Laporan Harian : {{ now()->format('d-m-Y') }}</h3>
                <div class="card-options d-flex gap-2">
                    <input class="form-control mr-2" type="text" name="dates" style="max-width: 200px" data-toggle="datepicker" value="" autocomplete="off" id="date">
                    <button id="btn-cetak-spp" class="btn btn-primary btn-sm mr-1" value="#">Cetak</button>
                    <button id="btn-export-spp" class="btn btn-primary btn-sm">Export</button>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table card-table table-hover table-center text-nowrap title" id="print">
                    <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Pembayaran</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($transaksi as $item)
                          <tr>
                              <td>{{ $item->created_at->format('d-m-Y') }}</td>
                              <td>{{ $item->siswa->nama }}</td>
                              <td>{{ $item->tagihan->nama }}</td>
                              <td>IDR. {{ format_idr($item->keuangan->jumlah) }}</td>
                              @php
                                  $jumlah += $item->keuangan->jumlah
                              @endphp
                          </tr>
                      @endforeach
                          <tr>
                              <td><b>Total</b></td>
                              <td></td>
                              <td></td>
                              <td>IDR. {{ format_idr($jumlah) }}</td>
                          </tr>
                      </tbody>
                </table>
                </div>
            </div>
      </div>
    </div>
    @endrole
  </section>
@endsection

@push('js')
<script>
  $(document).ready(function () {
      $('[data-toggle="datepicker"]').datepicker({
        format:'mm/dd/yyyy',
      }).datepicker("setDate",'now');

      $('#btn-cetak-spp').on('click', function(){
          var form = document.createElement("form");
          form.setAttribute("style", "display: none");
          form.setAttribute("method", "post");
          form.setAttribute("action", "{{route('laporan-harian.cetak')}}");
          form.setAttribute("target", "_blank");
          
          var token = document.createElement("input");
          token.setAttribute("name", "_token");
          token.setAttribute("value", "{{csrf_token()}}");
          
          var dateForm = document.createElement("input");
          dateForm.setAttribute("name", "date");
          dateForm.setAttribute("value", $('#date').val());

          form.appendChild(token);
          form.appendChild(dateForm);
          document.body.appendChild(form);
          form.submit();
      })
      $('#btn-export-spp').on('click', function(){
          var form = document.createElement("form");
          form.setAttribute("style", "display: none");
          form.setAttribute("method", "post");
          form.setAttribute("action", "{{route('laporan-harian.export')}}");
          form.setAttribute("target", "_blank");
          
          var token = document.createElement("input");
          token.setAttribute("name", "_token");
          token.setAttribute("value", "{{csrf_token()}}");
          
          var dateForm = document.createElement("input");
          dateForm.setAttribute("name", "date");
          dateForm.setAttribute("value", $('#date').val());

          form.appendChild(token);
          form.appendChild(dateForm);
          document.body.appendChild(form);
          form.submit();
      })
  });
</script>
@endpush