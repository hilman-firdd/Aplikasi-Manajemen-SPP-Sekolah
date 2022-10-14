<?php $__env->startSection('page-name','Pengaturan'); ?>

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
                    <div class="card-options d-flex justify-content-between">
                        <h5 class="card-title"><?php echo $__env->yieldContent('page-name'); ?></h5>
                        <a href="<?php echo e(route('pengaturan.edit')); ?>" class="btn btn-primary btn-sm">Ubah</a>
                    </div>
                </div>
                <?php if(session()->has('msg')): ?>
                <div class="card-alert alert alert-<?php echo e(session()->get('type')); ?>" id="message" style="border-radius: 0px !important">
                    <?php if(session()->get('type') == 'success'): ?>
                        <i class="fe fe-check mr-2" aria-hidden="true"></i>
                    <?php else: ?>
                        <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> 
                    <?php endif; ?>
                        <?php echo e(session()->get('msg')); ?>

                </div>
                <?php endif; ?>
                <div class="card-body">
                    <p>Nama Aplikasi : <b><?php echo e($pengaturan->nama); ?></b></p>
                    <p>Logo : </p>
                        <img src="<?php echo e(isset($pengaturan->logo) ? (($pengaturan->logo != 'logo.png') ? asset('storage/logo').'/'.str_replace('public/logo/','', $pengaturan->logo): 'https://universalgranite.co.nz/wp-content/uploads/2019/08/Slate-Grey.jpg') : 'https://cutewallpaper.org/21/white-aesthetic-wallpaper/igchrryxthreads-on-Twitter-white-aesthetic-wallpaper-...-.jpg'); ?>" alt="Logo Sistem" height="250px" width="250">
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function () {

        $(document).on('click','.btn-delete', function(){
            formid = $(this).attr('data-id');
            swal({
                title: 'Anda yakin ingin menghapus?',
                text: 'kelas yang dihapus tidak dapat dikembalikan',
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\spp-app\resources\views/admin/pengaturan/index.blade.php ENDPATH**/ ?>