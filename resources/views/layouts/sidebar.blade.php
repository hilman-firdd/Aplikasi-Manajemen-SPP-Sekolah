<nav class="navbar navbar-expand-lg" id="navbar-sidebar">
    <div class="container-fluid">
      <div>
        <button
          class="sidebarCollapseDefault btn p-0 border-0 d-none d-md-block"
          aria-label="Hamburger Button"
        >
          <i class="fa-solid fa-bars"></i>
        </button>
        <button
          data-bs-toggle="offcanvas"
          data-bs-target=".sidebar"
          aria-controls="sidebar"
          aria-label="Hamburger Button"
          class="sidebarCollapseMobile btn p-0 border-0 d-block d-md-none"
        >
          <i class="fa-solid fa-bars"></i>
        </button>
      </div>
      <div class="d-flex align-items-center justify-content-end gap-4">
        <input
          type="text"
          placeholder="Search Report"
          class="search form-control"
        />
        <button
          class="btn btn-search d-flex justify-content-center align-items-center p-0"
          type="button"
        >
          <img
            src="{{ asset('template/assets/images/ic_search.svg') }}"
            width="20px"
            height="20px"
          />
        </button>
        <img
          src="{{ asset('template/assets/images/avatar.jpg') }}"
          alt="Photo Profile"
          class="avatar"
        />
      </div>
    </div>
  </nav>