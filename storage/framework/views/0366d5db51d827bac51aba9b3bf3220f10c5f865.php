

<?php $__env->startSection('site-name','Sistem Informasi SPP'); ?>
<?php $__env->startSection('page-name', (isset($periode) ? 'Ubah Periode' : 'Periode Baru')); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/component-custom-switch.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-8">
            <form action="<?php echo e((isset($periode) ? route('periode.update', $periode->id) : route('periode.create'))); ?>" method="post" class="card">
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($error); ?><br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <div class="row p-3">
                    <div class="col-12">
                        <?php echo csrf_field(); ?>
                        <div class="form-group my-3">
                            <label for="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?php echo e(isset($periode) ? $periode->nama : old('nama')); ?>" required>
                        </div>
                        <div class="form-group my-3">
                            <label for="form-label">Tanggal mulai s/d selesai</label>
                            <div class="row gutters-xs">
                                <div class="col-6">
                                    <input type="text" class="form-control" name="tgl_mulai" data-toggle="datepicker" placeholder="Tanggal Mulai" required autocomplete="off" value="<?php echo e(isset($periode) ? $periode->tgl_mulai : old('tgl_mulai')); ?>">
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" name="tgl_selesai" data-toggle="datepicker" placeholder="Tanggal Selesai" required autocomplete="off" value="<?php echo e(isset($periode) ? $periode->tgl_selesai : old('tgl_selesai')); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label">Status</div>
                            <div class="custom-switch custom-switch-label-onoff">
                                <input type="checkbox" id="check" name="is_active" value="1" class="custom-switch-input" <?php echo e(isset($periode) ? ($periode->is_active ? 'checked' : '') : ''); ?>>
                                <label class="custom-switch-btn" for="check"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-danger me-3">Batal</a>
                        <button type="submit" class="btn btn-success ml-auto">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<script>
    $(document).ready(function () {
        $('[data-toggle="datepicker"]').datepicker({
            format: 'yyyy-MM-dd'
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\spp-app\resources\views/admin/periode/form.blade.php ENDPATH**/ ?>