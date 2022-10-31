

<?php $__env->startSection('page-name','Tabungan'); ?>

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
                <h5 class="card-title">Data Tabungan</h5>
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
                            <div class="form-group">
                                <label class="form-label">Keperluan</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="keperluan" value="in" class="selectgroup-input">
                                        <span class="selectgroup-button">Menabung</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="keperluan" value="out" class="selectgroup-input">
                                        <span class="selectgroup-button">Penarikan</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group" style="display:none" id="form-siswa">
                                <label class="form-label">Siswa</label>
                                <select id="siswa" class="form-control" name="siswa_id">
                                    <option value="#">[-- Pilih Siswa --]</option>
                                    <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"> <?php echo e($item->nik.' - '.$item->nama.' -
                                        '.$item->kelas->nama); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select><br>
                                Saldo: IDR. <span id="saldo">0</span>
                            </div>
                            <div class="form-group mb-2" style="display:none" id="form-jumlah">
                                <label class="form-label">Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control" min='100'
                                    placeholder="masukan jumlah tanpa tanda titik atau koma">
                            </div>
                            <div class="form-group mb-2" style="display:none" id="form-keterangan">
                                <label class="form-label">Keterangan</label>
                                <textarea name="keperluan" id="keterangan" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex" style="display:none !important" id="form-submit">
                        <button id="submit" class="btn btn-primary ml-auto">Simpan</button>
                    </div>
                    
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-options d-flex justify-content-between">
                    <h5 class="card-title">Mutasi tabungan</h5>
                    <a href="<?php echo e(route('tabungan.export')); ?>" class="btn btn-primary btn-sm ml-2"
                        download="true">Export</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-hover table-vcenter text-wrap">
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>KD</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                            <th>Cetak</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $tabungan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><span class="text-muted"><?php echo e((($index+1) + ($tabungan->currentPage() * $tabungan->perPage()) - $tabungan->perPage())); ?></span></td>
                            <td><?php echo e($item->created_at->format('d-m-Y')); ?></td>
                            <td>
                                <a href="<?php echo e(route('siswa.show', $item->siswa->id)); ?>" target="_blank">
                                    <?php echo e($item->siswa->nama); ?> -
                                    <?php echo e($item->siswa->kelas->nama); ?> -
                                    <?php echo e(isset($item->siswa->kelas->periode) ? $item->siswa->kelas->periode->nama : ''); ?>

                                </a>
                            </td>
                            <td>
                                <?php if($item->tipe == 'in'): ?>
                                Menabung
                                <?php elseif($item->tipe == 'out'): ?>
                                Penarikan
                                <?php endif; ?>
                            </td>
                            <td style="max-width:150px;"><?php echo e($item->keperluan); ?></td>
                            <td>IDR. <?php echo e(format_idr($item->jumlah)); ?></td>
                            <td>
                                <a class="btn btn-outline-primary btn-sm" target="_blank"
                                    href="<?php echo e(route('tabungan.transaksicetak', $item->id)); ?>">
                                    Cetak
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="d-flex">
                    <div class="ml-auto mb-0">
                        <?php echo e($tabungan->links()); ?>

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
        $('#siswa').select2({
            placeholder: "Pilih Siswa",
        });
        
        var saldo = 0;
        var keperluan = 'in';
        var siswa_id = 0;
        var jumlah = 0;
        //keperluan
        $('.selectgroup-input').change(function(){
            keperluan = this.value
            console.log(this.value)
            $('#form-siswa').show()
        })
        // memilih siswa
        $('#siswa').on('change',function(){
            if(this.value == '#'){
                $('#saldo').text('0')
                $('#form-jumlah').hide()
                $('#form-keterangan').hide()
                $('#submit').hide()
                return;
            }else{
                siswa_id = this.value
            }
            $.ajax({url: "<?php echo e(route('api.getsaldo')); ?>/" + this.value, success: function(result){
                $('#saldo').text(result.sal)
                saldo = result.saldo
                $('#form-jumlah').show()
                $('#form-keterangan').show()
                $('#submit').show()
            }, beforeSend: function(){ 
                $('#form-jumlah').hide()
                $('#form-keterangan').hide()
                $('#submit').hide()
                $('#saldo').text('tunggu, sedang mengambil saldo.....') 
            }
            });
        })
        
        $('#jumlah').keyup(function(){
            if(this.value <= 0){
                this.value = ''
            }else{
                jumlah = this.value
            }
            $('#form-submit').show()
        })
        $('#submit').on('click',function(){
            if((saldo <= 0 && keperluan == 'out')|| (saldo < jumlah && keperluan == 'out')){
                swal({
                    title: 'tidak dapat melakukan penarikan, saldo ' + saldo + ', dengan jumlah ' + jumlah,
                    dangerMode: true,
                })
            }else if(jumlah <= 99 && keperluan == 'in' || jumlah == undefined || $('#jumlah').val() <= 99){
                swal({
                    title: 'jumlah belum diisi',
                    dangerMode: true,
                })
            }else{
                $('#submit').addClass("btn-loading")
                $.ajax({
                type: "POST",
                url: "<?php echo e(route('api.menabung')); ?>/"+siswa_id,
                data: {
                    tipe : keperluan,
                    siswa_id : siswa_id,
                    jumlah : jumlah,
                    keperluan : $('#keterangan').val()
                },
                success: function(data){
                    swal({title: data.msg})
                    setTimeout(function(){
                        window.location.reload()
                    }, 2000)
                },
                error: function(data){
                    console.log('Error......')
                    console.log(data)
                }
                });
            }

        })
        
        $(document).on('click','.btn-delete', function(){
            formid = $(this).attr('data-id');
            swal({
                title: 'Anda yakin ingin menghapus?',
                text: 'mutasi yang dihapus tidak dapat dikembalikan',
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\spp-app\resources\views/admin/tabungan/index.blade.php ENDPATH**/ ?>