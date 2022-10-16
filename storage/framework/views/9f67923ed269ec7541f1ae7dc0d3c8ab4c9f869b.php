<nav class="sidebar offcanvas-md offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false">
      <div class="d-flex justify-content-end m-3 d-block d-md-none">
            <button aria-label="Close" data-bs-dismiss="offcanvas" data-bs-target=".sidebar"
                  class="btn p-0 border-0 fs-4">
                  <i class="fas fa-close"></i>
            </button>
      </div>
      <div class="d-flex justify-content-center mt-md-5 mb-5">
            <img src="<?php echo e(isset($pengaturan->logo) ? (($pengaturan->logo != 'logo.png') ? asset('storage/logo').'/'.str_replace('public/logo/','', $pengaturan->logo): 'https://universalgranite.co.nz/wp-content/uploads/2019/08/Slate-Grey.jpg') : 'https://cutewallpaper.org/21/white-aesthetic-wallpaper/igchrryxthreads-on-Twitter-white-aesthetic-wallpaper-...-.jpg'); ?>"
                  alt="Logo" width="70px" height="70px" />
      </div>
      <div class="pt-2 d-flex flex-column gap-5">
            <div class="menu p-0">
                  <p>Menu</p>
                  <a href="/" class="item-menu <?php echo e((request()->is('admin/dashboard')) ? 'active' : ''); ?>">
                        <i class="fa-solid fa-house icon icon-size"></i>
                        Dashboard
                  </a>
                  <?php if (app('laratrust')->isAbleTo('transaksi-spp-read')) : ?>
                  <a href="<?php echo e(route('spp.index')); ?>"
                        class="item-menu <?php echo e((request()->is('admin/transaksi*')) ? 'active' : ''); ?>">
                        <i class="fa-solid fa-money-bill-transfer icon icon-size"></i>
                        Transaksi SPP
                  </a>
                  <?php endif; // app('laratrust')->permission ?>
                  <?php if (app('laratrust')->isAbleTo('tabungan-read')) : ?>
                  <a href="<?php echo e(route('tabungan.index')); ?>"
                        class="item-menu <?php echo e((request()->is('admin/tabungan*')) ? 'active' : ''); ?>">
                        <i class="fa-solid fa-sack-dollar icon icon-size"></i>
                        Tabungan
                  </a>
                  <?php endif; // app('laratrust')->permission ?>
                  <?php if (app('laratrust')->isAbleTo('keuangan-read')) : ?>
                  <a href="<?php echo e(route('keuangan.index')); ?>"
                        class="item-menu <?php echo e((request()->is('admin/keuangan*')) ? 'active' : ''); ?>">
                        <i class="fa-solid fa-sack-dollar icon icon-size"></i>
                        Keuangan
                  </a>
                  <?php endif; // app('laratrust')->permission ?>
                  <?php if (app('laratrust')->isAbleTo('tagihan-read')) : ?>
                  <a href="<?php echo e(route('tagihan.index')); ?>"
                        class="item-menu <?php echo e((request()->is('admin/tagihan*')) ? 'active' : ''); ?>">
                        <i class="fa-solid fa-circle-dollar-to-slot icon icon-size"></i>
                        Tagihan
                  </a>
                  <?php endif; // app('laratrust')->permission ?>
                  <?php if (app('laratrust')->isAbleTo('siswa-read')) : ?>
                  <a href="<?php echo e(route('siswa.index')); ?>"
                        class="item-menu <?php echo e((request()->is('admin/siswa*')) ? 'active' : ''); ?>">
                        <i class="fa-solid fa-graduation-cap icon icon-size"></i>
                        Siswa
                  </a>
                  <?php endif; // app('laratrust')->permission ?>
                  <?php if (app('laratrust')->isAbleTo('kelas-read')) : ?>
                  <a href="<?php echo e(route('kelas.index')); ?>"
                        class="item-menu <?php echo e((request()->is('admin/kelas*')) ? 'active' : ''); ?>">
                        <i class="fa-solid fa-school-flag icon icon-size"></i>
                        Kelas
                  </a>
                  <?php endif; // app('laratrust')->permission ?>
                  <?php if (app('laratrust')->isAbleTo('periode-read')) : ?>
                  <a href="<?php echo e(route('periode.index')); ?>"
                        class="item-menu <?php echo e((request()->is('admin/periode*')) ? 'active' : ''); ?>">
                        <i class="fa-solid fa-id-card icon icon-size"></i>
                        Periode
                  </a>
                  <?php endif; // app('laratrust')->permission ?>
                  <?php if (app('laratrust')->isAbleTo('laporan-read')) : ?>
                  <a href="<?php echo e(route('laporan.index')); ?>"
                        class="item-menu <?php echo e((request()->is('admin/kuitansi*')) ? 'active' : ''); ?>">
                        <i class="fa-solid fa-file-pen icon icon-size"></i>
                        Laporan
                  </a>
                  <?php endif; // app('laratrust')->permission ?>
            </div>
            <div class="menu">
                  <p>Others</p>
                  <?php if (app('laratrust')->hasRole('superadmin|admin')) : ?>
                  <?php if (app('laratrust')->isAbleTo('pengguna-read')) : ?>
                  <a href="<?php echo e(route('user.index')); ?>"
                        class="item-menu <?php echo e((request()->is('admin/user*')) ? 'active' : ''); ?>">
                        <i class="fa-solid fa-user-gear icon icon-size"></i>
                        Pengguna
                  </a>
                  <?php endif; // app('laratrust')->permission ?>
                  <a href="<?php echo e(route('role.index')); ?>" class="item-menu">
                        <i class="fa-solid fa-gear icon icon-size"></i>
                        Role
                  </a>
                  <a href="<?php echo e(route('menu.index')); ?>" class="item-menu">
                        <i class="fa-solid fa-gear icon icon-size"></i>
                        Menu
                  </a>
                  <a href="<?php echo e(route('pengaturan.index')); ?>" class="item-menu">
                        <i class="fa-solid fa-gear icon icon-size"></i>
                        Settings
                  </a>
                  <?php endif; // app('laratrust')->hasRole ?>

                  <?php if (app('laratrust')->hasRole('kepsek')) : ?>
                  <a href="<?php echo e(route('pengaturan.index')); ?>" class="item-menu">
                        <i class="fa-solid fa-gear icon icon-size"></i>
                        Settings
                  </a>
                  <?php endif; // app('laratrust')->hasRole ?>
                  
                  <a href="#" class="item-menu" onclick="document.getElementById('form-logout').submit();">
                        <i class="fa-solid fa-right-from-bracket icon icon-size"></i>
                        Logout
                  </a>
                  <form action="<?php echo e(route('logout')); ?>" method="POST" id="form-logout">
                        <?php echo csrf_field(); ?>
                  </form>
            </div>
      </div>
</nav><?php /**PATH C:\laragon\www\spp-app\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>