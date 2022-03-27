@php
$status = '';
@endphp
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

   <!-- Sidebar - Brand -->
   <a class="sidebar-brand d-flex align-items-center justify-content-center mb-3" href="{{ route('index') }}">
      <div class="sidebar-brand-icon">
         {{-- <i class="fas fa-school"></i> --}}
         <img src="{{ asset('img/logo-smkn4bdg.png') }}" alt="" width="90%">
      </div>
      <div class="sidebar-brand-text mx-3 mt-2" style="font-weight: 500">Kesiswaan MY POIN</div>
   </a>
   {{-- <a class="sidebar-brand d-flex align-items-center justify-content-center">
      <div class="sidebar-brand-text mx-3" style="font-weight: 400">Kesiswaan MY POIN</div>
   </a> --}}


   <!-- Divider
      .sidebar > .nav-item > .nav-link > span {
         display: none;
      }
   -->
   <hr class="sidebar-divider my-0 {{ Request::is('dashboard') ? 'sidebar-divider-active' : '' }}">
   <!-- Nav Item - Dashboard -->
   <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }} nav-first-item">
      <a class="nav-link" href="{{ route('dashboard.index') }}">
         <i class="fas fa-fw fa-user-circle"></i>
         <span class="">Dashboard</span></a>
   </li>

   <li class="nav-item {{ Request::is('laporan') ? 'active' : '' }} last-nav-first-sect">
      <a class="nav-link" href="{{ route('laporan.index') }}">
         <i class="fas fa-fw fa-inbox"></i>
         <span>Laporan</span></a>
   </li>

   <!-- Divider -->
   <hr class="sidebar-divider {{ Request::is('laporan') ? 'sidebar-divider-active' : '' }}">

   <!-- Heading -->
   <div class="sidebar-heading">
      Kelola Data
   </div>

   @can('admin')
      <!-- Nav Item - Pages Collapse Menu -->
      @php
         $linkActive = '';
         if (Request::is('pelanggaran') || (Request::is('klasifikasi-pelanggaran') && !Request::is('pelanggaran/students*'))) {
             $linkActive = 'active';
         }
      @endphp
      <li class="nav-item nav-ordinary-item {{ $linkActive }}">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-1x fa-clipboard"></i>
            <span>Data Pelanggaran</span>
         </a>
         <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
               <h6 class="collapse-header">Menu :</h6>
               <a class="collapse-item" href="{{ route('pelanggaran.index') }}">Lihat semua data</a>
               <a class="collapse-item" href="{{ route('klasifikasi-pelanggaran.index') }}">Klasifikasi Data</a>
               <a class="collapse-item" href="{{ route('pelanggaran.create') }}">Tambahkan data baru</a>
            </div>
         </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item nav-ordinary-item {{ Request::is('students*') ? 'active' : '' }}">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-fw fa-user-friends"></i>
            <span>Data Siswa</span>
         </a>
         <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
               <h6 class="collapse-header">Master siswa :</h6>
               <a class="collapse-item" href="{{ route('students.index') }}">Lihat semua data</a>
               <a class="collapse-item" href="{{ route('students.create') }}">Tambahkan data baru</a>
            </div>
         </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item nav-ordinary-item @if (Request::is('penghargaan') || (Request::is('klasifikasi-penghargaan') && !Request::is('penghargaan/students*'))) active @endif">
         <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-1x fa-clipboard-check"></i>

            <span>Data Penghargaan</span>
         </a>
         <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
               <h6 class="collapse-header">Menu :</h6>
               <a class="collapse-item" href="{{ route('penghargaan.index') }}">Lihat semua data</a>
               <a class="collapse-item" href="{{ route('klasifikasi-penghargaan.index') }}">Klasifikasi Data</a>

               <a class="collapse-item" href="{{ route('penghargaan.create') }}">Tambahkan data baru</a>
            </div>
         </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
         Tambah rekap
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item nav-ordinary-item 
      @if (Request::is('pelanggaran/students*') || Request::is('hapus-pelanggaran/students*')) active @endif">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
            {{-- <i class="fas fa-fw fa-folder" ></i> --}}
            {{-- <i class="fa-solid fa-layer-minus" ></i> --}}
            {{-- <i class="fas fa-fw fa-tags">
               <i class="fas fa-fw fa-minus" style="margin-right: -30px;"></i> --}}
            <i class="fas fa-fw fa-list-alt"></i>
            <span class="ms-2">Rekap Pelanggaran</span>
         </a>
         <div id="collapseFour" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
               <h6 class="collapse-header">Menu :</h6>
               <a class="collapse-item" href="{{ route('pelanggaran.students.index') }}">Lihat semua data</a>
               <a class="collapse-item" href="{{ route('pelanggaran.students.create') }}">Tambahkan data baru </a>
            </div>
         </div>
      </li>

      <li class="nav-item nav-ordinary-item 
      @if (Request::is('penghargaan/students*') || Request::is('hapus-penghargaan/students*')) active @endif">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
            {{-- <i class="fas fa-trophy" ></i> --}}
            {{-- <i class="fas fa-fw fa-award"></i> --}}
            <i class="fas fa-fw fa-list-ol"></i>

            <span>Rekap Penghargaan</span>
         </a>
         <div id="collapseFive" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
               <h6 class="collapse-header">Menu :</h6>
               <a class="collapse-item" href="{{ route('penghargaan.students.index') }}">Lihat semua data</a>
               <a class="collapse-item" href="{{ route('penghargaan.students.create') }}">Tambahkan data baru</a>
            </div>
         </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">


      <!-- Heading -->
      <div class="sidebar-heading">
         Kelola Data
      </div>

      <li class="nav-item nav-ordinary-item {{ Request::is('users*') ? 'active' : '' }}">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
            <i class="fas fa-fw fa-user-check"></i>
            <span>Manajemen User</span>
         </a>
         <div id="collapseSix" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
               <h6 class="collapse-header">Role User</h6>
               <a class="collapse-item" href="{{ route('users.index') }}">All</a>
               <a class="collapse-item" href="utilities-animation.html">Admin</a>
               <a class="collapse-item" href="utilities-color.html">Guru</a>
               <a class="collapse-item" href="utilities-border.html">Siswa</a>
            </div>
         </div>
      </li>
      <li class="nav-item nav-ordinary-item {{ Request::is('waka*') ? 'active' : '' }}">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
            <i class="fas fa-fw fa-chalkboard-teacher"></i>
            <span>Manajemen Walikelas</span>
         </a>
         <div id="collapseSeven" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
               <h6 class="collapse-header">Option</h6>
               <a class="collapse-item" href="{{ route('teachers.index') }}">All</a>
               <a class="collapse-item" href="utilities-animation.html">Kelola Kelas</a>
            </div>
         </div>
         @php
            if (Request::is('waka*')) {
                $status = 'sidebar-divider-active';
            }
         @endphp
      </li>
   @endcan

   @can('siswa')
      <li class="nav-item nav-ordinary-item {{ Request::is('siswa/rekap') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('siswa.rekap') }}">
            <i class="fas fa-fw fa-book-open"></i>
            <span>Lihat rekapan saya</span></a>
      </li>
      <li class="nav-item nav-ordinary-item {{ Request::is('siswa/shop') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('siswa.shop') }}">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Shop poin</span></a>
      </li>
      @php
         if (Request::is('siswa/shop')) {
             $status = 'sidebar-divider-active';
         }
      @endphp
   @endcan


   @can('guru')
      <li class="nav-item nav-ordinary-item my-0 {{ Request::is('guru/rekap') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('guru.rekap') }}">
            <i class="fas fa-fw fa-book-reader"></i>
            <span>Lihat rekapan kelasku</span></a>
      </li>
      <li class="nav-item nav-ordinary-item {{ Request::is('siswa/shop') ? 'active' : '' }}" style="margin-top: -15px">
         @php
            if (Request::is('siswa/shop')) {
                $status = 'sidebar-divider-active';
            }
         @endphp

         <a class="nav-link" href="{{ route('siswa.shop') }}">
            <i class="fas fa-fw fa-info-circle"></i>
            <span>Permintaan siswa</span></a>
      </li>
   @endcan




   <!-- Divider -->
   <hr class="sidebar-divider d-none d-md-block mt-2 {{ $status }}">

   <!-- Sidebar Toggler (Sidebar) -->
   <div class="text-center d-none d-md-inline sidebar-toggle-btn">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
      {{-- <i class="fa-solid fa-align-right"></i> --}}
   </div>

   <!-- Sidebar Message -->
   {{-- <div class="sidebar-card d-none d-lg-flex">
      <img class="sidebar-card-illustration mb-2" src="{{ asset('assets/img/undraw_rocket.svg') }}" alt="...">
      <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and
         more!</p>
      <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
   </div> --}}

</ul>
