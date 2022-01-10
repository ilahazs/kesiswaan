<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
   <div class="position-sticky pt-3">
      <ul class="nav flex-column">
         <li class="nav-item mb-2">
            <div class="img-sidebar mb-2 d-flex justify-content-start ms-3">
               <img src="{{ Avatar::create('Y')->toBase64() }}" alt="" width="50px" height="50px">

               <a href="#" class="nav-link align-items-center" style="font-size: 20px; ">{{ Auth::user()->name }}</a>
            </div>
         </li>
         <li class="nav-item">
            <a class="nav-link {{ (Request::is('dashboard') or Request::is('dashboard/index')) ? 'active' : '' }}"
               aria-current="page" href="{{ route('dashboard.index') }}">
               <span data-feather="home"></span>
               Dashboard
            </a>
         </li>
         <li class="nav-item">
            <a class="nav-link {{ Request::is('profile*') ? 'active' : '' }}" href="{{ route('profile') }}">
               <span data-feather="user"></span>
               My Profile
            </a>
         </li>
         @can('admin')
            <li class="nav-item">
               <a class="nav-link {{ Request::is('students*') ? 'active' : '' }}" href="{{ route('students.index') }}">
                  <span data-feather="database"></span>
                  Students
               </a>
            </li>
         @endcan
         @can('siswa')

            <li class="nav-item">
               <a class="nav-link {{ Request::is('siswa/rekap-data*') ? 'active' : '' }}"
                  href="{{ route('siswa.rekap') }}">
                  <span data-feather="database"></span>
                  Data Rekap
               </a>
            </li>
         @endcan



      </ul>

      {{-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
         <span>Saved reports</span>
         <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
         </a>
      </h6> --}}
      @can('admin')
         <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Administrator</span>
         </h6>

         <ul class="nav flex-column">
            <li class="nav-item">
               <a class="nav-link {{ Request::is('dashboard/user*') ? 'active' : '' }}" href="#">
                  <span data-feather="users"></span>
                  User Management
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link {{ Request::is('penghargaan*') ? 'active' : '' }}"
                  href="{{ route('penghargaan.index') }}">
                  <span data-feather="grid"></span>
                  Data Penghargaan
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link 
                  @if (Request::is('pelanggaran*') && !Request::is('pelanggaran/students*')) 
                     active
                  @endif"
                  href="{{ route('pelanggaran.index') }}">
                  <span data-feather="grid"></span>
                  Data Pelanggaran
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link {{ Request::is('pelanggaran/students*') ? 'active' : '' }}"
                  href="{{ route('pelanggaran.students.index') }}">
                  <span data-feather="thumbs-down"></span>
                  Input Pelanggaran
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link {{ Request::is('penghargaan/students*') ? 'active' : '' }}"
                  href="{{ route('penghargaan.students.index') }}">
                  <span data-feather="thumbs-up"></span>
                  Input Penghargaan
               </a>
            </li>
         </ul>
      @endcan

      @auth
         @if (Auth::user()->role == 'siswa')
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
               <span>Menu</span>
            </h6>
            <ul class="nav flex-column">

               <li class="nav-item">
                  <a class="nav-link {{ Request::is('siswa/rekap*') ? 'active' : '' }}"
                     href="{{ route('siswa.rekap') }}">
                     <span data-feather="list"></span>
                     Data Rekap
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link {{ Request::is('siswa/shop') ? 'active' : '' }}"
                     href="{{ route('siswa.shop') }}">
                     <span data-feather="shopping-cart"></span>
                     Shop Poin
                  </a>
               </li>
            </ul>
         @endif
      @endauth

      {{-- @auth
         @if (Auth::user()->role == 'admin')

         @endif
      @endauth --}}


   </div>
</nav>
