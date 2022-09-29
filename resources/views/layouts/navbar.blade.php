<nav
      class="sidebar offcanvas-md offcanvas-start"
      data-bs-scroll="true"
      data-bs-backdrop="false"
>
      <div class="d-flex justify-content-end m-3 d-block d-md-none">
            <button
            aria-label="Close"
            data-bs-dismiss="offcanvas"
            data-bs-target=".sidebar"
            class="btn p-0 border-0 fs-4"
            >
            <i class="fas fa-close"></i>
            </button>
      </div>
      <div class="d-flex justify-content-center mt-md-5 mb-5">
            <img
            src="{{ isset($pengaturan->logo) ? (($pengaturan->logo != 'logo.png') ? asset('storage/logo').'/'.str_replace('public/logo/','', $pengaturan->logo): 'https://universalgranite.co.nz/wp-content/uploads/2019/08/Slate-Grey.jpg') : 'https://cutewallpaper.org/21/white-aesthetic-wallpaper/igchrryxthreads-on-Twitter-white-aesthetic-wallpaper-...-.jpg'  }}"
            alt="Logo"
            width="70px"
            height="70px"
            />
      </div>
      <div class="pt-2 d-flex flex-column gap-5">
            <div class="menu p-0">
            <p>Menu</p>
            <a href="/" class="item-menu {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                  <i class="fa-solid fa-house icon icon-size"></i>
                  Dashboard
            </a>
            <a href="{{ route('spp.index') }}" class="item-menu {{ (request()->is('admin/transaksi*')) ? 'active' : '' }}">
                  <i class="fa-solid fa-money-bill-transfer icon icon-size"></i>
                  Transaksi SPP
            </a>
            <a href="{{ route('tabungan.index') }}" class="item-menu {{ (request()->is('admin/tabungan*')) ? 'active' : '' }}">
                  <i class="fa-solid fa-sack-dollar icon icon-size"></i>
                  Tabungan
            </a>
            <a href="{{ route('keuangan.index') }}" class="item-menu {{ (request()->is('admin/keuangan*')) ? 'active' : '' }}">
                  <i class="fa-solid fa-sack-dollar icon icon-size"></i>
                  Keuangan
            </a>
            <a href="{{ route('tagihan.index') }}" class="item-menu {{ (request()->is('admin/tagihan*')) ? 'active' : '' }}">
                  <i class="fa-solid fa-circle-dollar-to-slot icon icon-size"></i>
                  Tagihan
            </a>
            <a href="{{ route('siswa.index') }}" class="item-menu {{ (request()->is('admin/siswa*')) ? 'active' : '' }}">
                  <i class="fa-solid fa-graduation-cap icon icon-size"></i>
                  Siswa
            </a>
            <a href="{{ route('kelas.index') }}" class="item-menu {{ (request()->is('admin/kelas*')) ? 'active' : '' }}">
                  <i class="fa-solid fa-school-flag icon icon-size"></i>
                  Kelas
            </a>
            <a href="{{ route('periode.index') }}" class="item-menu {{ (request()->is('admin/periode*')) ? 'active' : '' }}">
                  <i class="fa-solid fa-id-card icon icon-size"></i>
                  Periode
            </a>
            <a href="{{ route('kuitansi.index') }}" class="item-menu {{ (request()->is('admin/kuitansi*')) ? 'active' : '' }}">
                  <i class="fa-solid fa-file-pen icon icon-size"></i>
                  Kuitansi
            </a>
            @permission('pengguna-read')
            <a href="{{ route('user.index') }}" class="item-menu {{ (request()->is('admin/user*')) ? 'active' : '' }}">
                  <i class="fa-solid fa-user-gear icon icon-size"></i>
                  Pengguna
            </a>
            @endpermission
            </div>
            <div class="menu">
            <p>Others</p>
            <a href="{{ route('pengaturan.index') }}" class="item-menu">
                  <i class="fa-solid fa-gear icon icon-size"></i>
                  Settings
            </a>
            <a href="#" class="item-menu" onclick="document.getElementById('form-logout').submit();">
                  <i class="fa-solid fa-right-from-bracket icon icon-size"></i>
                  Logout
            </a>
            <form action="{{ route('logout') }}" method="POST" id="form-logout">
                  @csrf
            </form>
            </div>
      </div>
</nav>