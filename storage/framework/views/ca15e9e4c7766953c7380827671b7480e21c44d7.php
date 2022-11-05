

<?php $__env->startSection('page-name','Pembayaran SPP'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1 class="page-title">
        <?php echo $__env->yieldContent('page-name'); ?>
    </h1>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Data Pembayaran SPP</h5>
            </div>
            <?php if(session()->has('msg')): ?>
            <div class="card-alert alert alert-<?php echo e(session()->get('type')); ?>" id="message"
                style="border-radius: 0px !important">
                <?php if(session()->get('type') == 'success'): ?>
                <i class="fe fe-check mr-2" aria-hidden="true"></i>
                <?php else: ?>
                <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i>
                <?php endif; ?>
                <?php echo e(session()->get('msg')); ?>

            </div>
            <?php endif; ?>
            <div class="card-body">
                
                    <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($error); ?><br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-12">
                            <?php echo csrf_field(); ?>
                            <div class="form-group mb-2">
                                <label class="form-label">Siswa</label>
                                <select id="siswa" class="form-control" name="siswa_id">
                                    <option value="#">[-- Pilih Siswa --]</option>
                                    <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"> <?php echo e($item->nik.' - '.$item->nama.' -
                                        '.$item->kelas->nama); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select><br>
                                Saldo: IDR. <span id="saldo">0</span>
                            </div>
                            <div class="form-group mb-2" style="display: none" id="form-tagihan">
                                <label class="form-label">Tagihan</label>
                                <select id="tagihan" class="form-control" name="tagihan_id">

                                </select>
                            </div>
                            <div class="form-group mb-2" style="display: none" id="form-tagihan-2">
                                <label class="form-label">Total Tagihan</label>
                                IDR. <span id="harga">0</span>
                                <label class="custom-switch">
                                    <input type="checkbox" class="custom-switch-input" id="ada-diskon">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Ada diskon? </span>
                                </label>
                            </div>
                            <div class="form-group mb-2" style="display: none" id="form-diskon">
                                <label class="form-label">Diskon (IDR)</label>
                                <input type="text" name="diskon" id="diskon" class="form-control"
                                    placeholder="masukan angka dalam satuan mata uang, tanpa titik atau koma">
                            </div>
                            <div class="form-group mb-2" style="display: none" id="form-total">
                                <label class="form-label">Total Pembayaran</label>
                                <input type="text" name="pembayaran" class="form-control" id="total" readonly>
                            </div>
                            <div class="form-group mb-2" style="display: none" id="form-pembayaran">
                                <label class="form-label">Pembayaran</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="via" value="tunai" class="selectgroup-input"
                                            checked="">
                                        <span class="selectgroup-button">Tunai</span>
                                    </label>
                                    <label class="selectgroup-item" style="display: none" id="opsi-tabungan">
                                        <input type="radio" name="via" value="tabungan" class="selectgroup-input">
                                        <span class="selectgroup-button">Potong Tabungan</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group mb-2" style="display: none" id="form-keterangan">
                                <label class="form-label">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <button class="btn btn-primary ml-auto" style="display: none" id="btn-simpan">Simpan</button>
                    </div>
                    
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-options d-flex justify-content-between">
                    <h5 class="card-title">Histori Transaksi</h5>
                    <div>
                        <a href="<?php echo e(route('transaksi.export')); ?>" class="btn btn-primary btn-sm ml-2"
                            download="true">Export</a>
                        <a href="#!cetak" class="btn btn-outline-primary btn-sm ml-2" id="mass-cetak">Cetak</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-hover table-vcenter text-wrap">
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Tanggal</th>
                            <th>Siswa</th>
                            <th>Tagihan</th>
                            <th>Diskon</th>
                            <th>Dibayarkan</th>
                            <th>Keterangan</th>
                            <th>Cetak</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><span class="text-muted"><?php echo e((($index+1) + ($transaksi->currentPage() * $transaksi->perPage()) - $transaksi->perPage())); ?></span></td>
                            <td><?php echo e($item->created_at->format('d-m-Y')); ?></td>
                            <td>
                                <a href="<?php echo e(route('siswa.show', $item->siswa->id)); ?>" target="_blank">
                                    <?php echo e($item->siswa->nama.'('.$item->siswa->kelas->nama.')'); ?>

                                </a>
                            </td>
                            <td><?php echo e($item->tagihan->nama); ?></td>
                            <td>IDR. <?php echo e(format_idr($item->diskon)); ?></td>
                            <td>IDR. <?php echo e(format_idr($item->keuangan->jumlah)); ?></td>
                            <td style="max-width:150px;"><?php echo e($item->keterangan); ?></td>
                            <td>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input tandai" name="example-checkbox2"
                                        value="<?php echo e($item->id); ?>">
                                    <span class="custom-control-label">Tandai</span>
                                </label>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="d-flex">
                    <div class="ml-auto mb-0">
                        <?php echo e($transaksi->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
<link href="<?php echo e(asset('template/assets/plugins/select2/select2.min.css')); ?>" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: black;
    }

    .select2 {
        width: 100% !important;
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('template/assets/plugins/select2/select2.min.js')); ?>"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function () {
            //format IDR
            function formatNumber(num) {
                return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
            }
            $('#siswa').select2({
                placeholder: "Pilih Siswa",
            });
            $('#tagihan').select2({});
            
            var siswa_id;   //siswa_id
            var tagihan_id; //tagihan_id
            var saldo;      //saldo dari siswa
            var harga;      //harga dari tagihan
            var diskon = 0; //diskon
            var via = 'tunai';  //pembayaran via 
            // memilih siswa
            $('#siswa').on('change',function(){
                if(this.value == '#'){
                    $('#saldo').text('0') 
                    $('#form-tagihan').hide()
                    $('#form-tagihan-2').hide()
                    $('#form-total').hide()
                    $('#form-pembayaran').hide()
                    $('#opsi-tabungan').hide()
                    $('#form-keterangan').hide()
                    $('#btn-simpan').hide()
                    return;
                }else{
                    siswa_id = this.value
                }
                //get saldo
                $.ajax({url: "<?php echo e(route('api.getsaldo')); ?>/" + this.value, success: function(result){
                        $('#saldo').text(result.sal)
                        saldo = result.saldo
                        $('#form-tagihan').show()
                        $('#form-tagihan-2').show()
                        $('#form-total').show()
                        $('#form-pembayaran').show()
                        if(saldo > 0){
                            $('#opsi-tabungan').show()
                        }
                        $('#form-keterangan').show()
                        $('#btn-simpan').show()
                    }, beforeSend: function(){ 
                        $('#saldo').text('tunggu, sedang mengambil saldo.....') 
                        $('#form-tagihan').hide()
                        $('#form-tagihan-2').hide()
                        $('#form-total').hide()
                        $('#form-pembayaran').hide()
                        $('#opsi-tabungan').hide()
                        $('#form-keterangan').hide()
                        $('#btn-simpan').hide()
                }});
                //get tagihan
                $.ajax({url: "<?php echo e(route('api.gettagihan')); ?>/" + this.value, success: function(result){
                    if(result.length == 0){
                        alert('tidak ada item tagihan yang tersedia')
                    }
                    $("#tagihan").empty()
                    for(i=0;i < result.length ;i++){
                        $("#tagihan").append('<option value="'+ result[i].id +'" data-harga="'+ result[i].jumlah +'">'+ result[i].nama +'</option>');
                    }
                    //set harga dari data pertama
                    tagihan_id = result[0].id
                    harga = result[0].jumlah
                    if(harga <= saldo){
                        $('#opsi-tabungan').show()
                    }else{
                        $('#opsi-tabungan').hide()
                    }

                    //menampilkan harga
                    $('#harga').text(formatNumber(harga));
                    $('#total').val(formatNumber(harga - diskon));
                },});
            })

            $('#tagihan').on('change', function(){
                tagihan_id = this.value
                //set harga dari opsi yang dipilih
                harga = $('option:selected', this).attr('data-harga');

                if(harga <= saldo){
                    $('#opsi-tabungan').show()
                }else{
                    $('#opsi-tabungan').hide()
                }

                //jika diganti diskon kembali ke nol
                diskon = 0
                $('#diskon').val('');
                //menampilkan harga
                $('#harga').text(formatNumber(harga));
                $('#total').val(formatNumber(harga - diskon));
            })

            $('#ada-diskon').on('change', function(){
                $('#form-diskon').toggle();
            })

            $('#diskon').keyup(function(){
                if(this.value <= 0){
                    this.value = ''
                    diskon = 0
                }else{
                    diskon = this.value
                }
                if((harga - diskon) < 0){
                    diskon = 0
                    alert('diskon invalid, silahkan tulis ulang')
                    $('#diskon').val('')
                }
                $('#total').val(formatNumber(harga - diskon));
                if((harga - diskon) <= saldo){
                    $('#opsi-tabungan').show()
                }else{
                    $('#opsi-tabungan').hide()
                }
            })

            //pembayaran via
            $('.selectgroup-input').change(function(){
                via = this.value
            })

            $('#btn-simpan').on('click', function(){
                console.log(harga)
                if((harga - diskon) == NaN){
                    alert('diskon invalid')
                }else{
                    $('#btn-simpan').addClass("btn-loading")
                    $.ajax({
                        type: "POST",
                        url: "<?php echo e(route('api.tagihan')); ?>/"+siswa_id,
                        data: {
                            tagihan_id : tagihan_id,
                            siswa_id : siswa_id,
                            jumlah : harga,
                            diskon : diskon,
                            keterangan : keterangan.value,
                            via : via
                        },
                        success: function(data){
                            console.log(data);
                            swal({title: data.msg})
                            setTimeout(function(){
                                window.location.reload()
                            }, 2000)
                        },
                        error: function(data){
                            swal({title: "Terjadi kesalahan pada transaksi, Transaksi dibatalkan"})
                            setTimeout(function(){
                                window.location.reload()
                            }, 2000)
                        }
                    });
                }
                
            })

            $('#mass-cetak').on('click', function(){
                var ids = []
                $('.tandai').each(function(){
                    if(this.checked){
                        ids.push(this.value)
                    }
                })

                var form = document.createElement("form");
                form.setAttribute("style", "display: none");
                form.setAttribute("method", "post");
                form.setAttribute("action", "<?php echo e(route('transaksi.tf')); ?>");
                form.setAttribute("target", "_blank");
                
                var token = document.createElement("input");
                token.setAttribute("name", "_token");
                token.setAttribute("value", "<?php echo e(csrf_token()); ?>");
                
                var idsForm = document.createElement("input");
                idsForm.setAttribute("name", "ids");
                idsForm.setAttribute("value", ids);

                form.appendChild(token);
                form.appendChild(idsForm);
                document.body.appendChild(form);
                form.submit();

            })
        });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\spp-app\resources\views/admin/transaksi/index.blade.php ENDPATH**/ ?>