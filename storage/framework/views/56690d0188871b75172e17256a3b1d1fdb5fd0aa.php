

<?php $__env->startSection('site-name','Sistem Informasi SPP'); ?>
<?php $__env->startSection('page-name', (isset($kelas) ? 'Ubah Kelas' : 'Kelas Baru')); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-8">
            <form action="<?php echo e((isset($kelas) ? route('kelas.update', $kelas->id) : route('kelas.create'))); ?>" method="post" class="card">
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
                        <div class="form-group mb-3">
                            <label class="form-label">Periode</label>
                            <select class="form-control" name="periode_id">
                                <?php $__currentLoopData = $periode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value=""></option>
                                    <option value="<?php echo e($item->id); ?>" <?php echo e(isset($kelas) ? ($item->id == $kelas->id ? 'selected' : '') : ''); ?>><?php echo e($item->nama); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?php echo e(isset($kelas) ? $kelas->nama : old('nama')); ?>">
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
        $('#select-beast').selectize({});
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\spp-app\resources\views/admin/kelas/form.blade.php ENDPATH**/ ?>