

<?php $__env->startSection('site-name','Sistem Informasi SPP'); ?>
<?php $__env->startSection('page-name','Import Siswa'); ?>)

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-8">
            <form action="<?php echo e(route('siswa.import')); ?>" method="post" class="card" enctype="multipart/form-data">
                <div class="card-header">
                    <h3 class="card-title"><?php echo $__env->yieldContent('page-name'); ?></h3>
                </div>
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
                                <div class="form-label">File (Excel, xls, xlsx)</div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, *.csv">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                                <small class="mt-4">unduh contoh file <a href="<?php echo e(asset('template/siswa.xlsx')); ?>" download>disini</a> </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-danger me-2">Batal</a>
                        <button type="submit" class="btn btn-primary ml-auto">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\spp-app\resources\views/admin/siswa/import.blade.php ENDPATH**/ ?>