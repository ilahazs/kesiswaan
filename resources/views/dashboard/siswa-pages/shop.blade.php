@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('siswa.shop') }}"
         class="text-decoration-none {{ Request::is('siswa/shop*') ? 'text-secondary' : '' }}">{{ $title }}</a>
   </li>
@endsection
@section('container')
   <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">

   @if (session('success'))
      <div class="col-lg-11">
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {!! session('success') !!}
         </div>
      </div>
   @endif

   <div class="header-poin-info border-bottom">
      <h4 class="mb-3">Poin Penghargaanku : <span
            class="text-success"><strong>{{ $mypoin }}</strong></span></h4>

   </div>


   <div class="row mb-3">

      @foreach ([1, 2] as $a)
         <div class="col-lg-6">
            <div class="card mb-3" style="max-width: 600px;">
               <div class="row g-0">
                  <div class="col-md-4">
                     <img src="{{ asset('img/buku-mtk.jpg') }}" class="img-fluid rounded-start p-3 border-dark" alt="..."
                        width="200">
                  </div>
                  <div class="col-md-8">
                     <div class="card-body">
                        <h5 class="card-title">Buku Matematika VII - Price : <span
                              class="text-success"><strong>{{ mt_rand(30, 40) }}</strong></span>
                        </h5>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur,
                           voluptate laudantium. Iste deleniti vero rerum veniam ipsam natus beatae animi incidunt, laborum
                           vel, error non ea vitae nemo sed assumenda.</p>
                        <p class="card-text"><small class="text-muted">Kurikulum 2013 - Kelas 12</small></p>
                        <div class="d-flex justify-content-end">
                           <a href="#" class="badge bg-primary text-decoration-none text-uppercase px-2 py-2 text-white"
                              style="font-size: 15px; border-radius: 15px">Order</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      @endforeach

   </div>
   <div class="row mb-3">

      @foreach ([1, 2] as $a)
         <div class="col-lg-6">
            <div class="card mb-3" style="max-width: 600;">
               <div class="row g-0">
                  <div class="col-md-4">
                     <img src="{{ asset('img/buku-indo.jpg') }}" class="img-fluid rounded-start p-3 border-dark"
                        alt="..." width="200">
                  </div>
                  <div class="col-md-8">
                     <div class="card-body">
                        <h5 class="card-title">Bahasa Indonesia IX - Price : <span
                              class="text-success"><strong>{{ mt_rand(30, 40) }}</strong></span>
                        </h5>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur,
                           voluptate laudantium. Iste deleniti vero rerum veniam ipsam natus beatae animi incidunt, laborum
                           vel, error non ea vitae nemo sed assumenda.</p>
                        <p class="card-text"><small class="text-muted">Kurikulum 2013 - Kelas 12</small></p>
                        <div class="d-flex justify-content-end">
                           <a href="#" class="badge bg-primary text-decoration-none text-uppercase px-2 py-2 text-white"
                              style="font-size: 15px; border-radius: 15px">Order</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      @endforeach

   </div>
   <div class="row mb-3">

      @foreach ([1, 2] as $a)
         <div class="col-lg-6">
            <div class="card mb-3" style="max-width: 600px;">
               <div class="row g-0">
                  <div class="col-md-4">
                     <img src="{{ asset('img/buku-inggris.jpg') }}" class="img-fluid rounded-start p-3 border-dark"
                        alt="..." width="200">
                  </div>
                  <div class="col-md-8">
                     <div class="card-body">
                        <h5 class="card-title">Bahasa Inggris VII - Price : <span
                              class="text-success"><strong>{{ mt_rand(30, 40) }}</strong></span>
                        </h5>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur,
                           voluptate laudantium. Iste deleniti vero rerum veniam ipsam natus beatae animi incidunt, laborum
                           vel, error non ea vitae nemo sed assumenda.</p>
                        <p class="card-text"><small class="text-muted">Kurikulum 2013 - Kelas 12</small></p>
                        <div class="d-flex justify-content-end">
                           <a href="#" class="badge bg-primary text-decoration-none text-uppercase px-2 py-2 text-white"
                              style="font-size: 15px; border-radius: 15px">Order</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      @endforeach

   </div>

   {{-- <div class="col-lg-4">
         <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
               <div class="col-md-4">
                  <img src="{{ asset('img/logo-smkn4bdg.png') }}" class="img-fluid rounded-start p-3 border-dark"
                     alt="..." width="200">
               </div>
               <div class="col-md-8">
                  <div class="card-body">
                     <h5 class="card-title">Price : </h5>
                     <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                        additional
                        content. This content is a little bit longer.</p>
                     <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                     <div class="d-flex justify-content-end">
                        <a href="#" class="badge bg-primary text-decoration-none text-uppercase px-2 py-2 text-white"
                           style="font-size: 15px; border-radius: 15px">Detail</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
               <div class="col-md-4">
                  <img src="{{ asset('img/logo-smkn4bdg.png') }}" class="img-fluid rounded-start p-3 border-dark"
                     alt="..." width="200">
               </div>
               <div class="col-md-8">
                  <div class="card-body">
                     <h5 class="card-title">Card title</h5>
                     <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                        additional
                        content. This content is a little bit longer.</p>
                     <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                     <div class="d-flex justify-content-end">
                        <a href="#" class="badge bg-primary text-decoration-none text-uppercase px-2 py-2 text-white"
                           style="font-size: 15px; border-radius: 15px">Detail</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row mb-3">
      <div class="col-lg-4">
         <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
               <div class="col-md-4">
                  <img src="{{ asset('img/logo-smkn4bdg.png') }}" class="img-fluid rounded-start p-3 border-dark"
                     alt="..." width="200">
               </div>
               <div class="col-md-8">
                  <div class="card-body">
                     <h5 class="card-title">Card title</h5>
                     <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                        additional
                        content. This content is a little bit longer.</p>
                     <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                     <div class="d-flex justify-content-end">
                        <a href="#" class="badge bg-primary text-decoration-none text-uppercase px-2 py-2 text-white"
                           style="font-size: 15px; border-radius: 15px">Detail</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
               <div class="col-md-4">
                  <img src="{{ asset('img/logo-smkn4bdg.png') }}" class="img-fluid rounded-start p-3 border-dark"
                     alt="..." width="200">
               </div>
               <div class="col-md-8">
                  <div class="card-body">
                     <h5 class="card-title">Card title</h5>
                     <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                        additional
                        content. This content is a little bit longer.</p>
                     <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                     <div class="d-flex justify-content-end">
                        <a href="#" class="badge bg-primary text-decoration-none text-uppercase px-2 py-2 text-white"
                           style="font-size: 15px; border-radius: 15px">Detail</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
               <div class="col-md-4">
                  <img src="{{ asset('img/logo-smkn4bdg.png') }}" class="img-fluid rounded-start p-3 border-dark"
                     alt="..." width="200">
               </div>
               <div class="col-md-8">
                  <div class="card-body">
                     <h5 class="card-title">Card title</h5>
                     <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                        additional
                        content. This content is a little bit longer.</p>
                     <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                     <div class="d-flex justify-content-end">
                        <a href="#" class="badge bg-primary text-decoration-none text-uppercase px-2 py-2 text-white"
                           style="font-size: 15px; border-radius: 15px">Detail</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row mb-3">
      <div class="col-lg-4">
         <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
               <div class="col-md-4">
                  <img src="{{ asset('img/logo-smkn4bdg.png') }}" class="img-fluid rounded-start p-3 border-dark"
                     alt="..." width="200">
               </div>
               <div class="col-md-8">
                  <div class="card-body">
                     <h5 class="card-title">Card title</h5>
                     <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                        additional
                        content. This content is a little bit longer.</p>
                     <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                     <div class="d-flex justify-content-end">
                        <a href="#" class="badge bg-primary text-decoration-none text-uppercase px-2 py-2 text-white"
                           style="font-size: 15px; border-radius: 15px">Detail</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
               <div class="col-md-4">
                  <img src="{{ asset('img/logo-smkn4bdg.png') }}" class="img-fluid rounded-start p-3 border-dark"
                     alt="..." width="200">
               </div>
               <div class="col-md-8">
                  <div class="card-body">
                     <h5 class="card-title">Card title</h5>
                     <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                        additional
                        content. This content is a little bit longer.</p>
                     <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                     <div class="d-flex justify-content-end">
                        <a href="#" class="badge bg-primary text-decoration-none text-uppercase px-2 py-2 text-white"
                           style="font-size: 15px; border-radius: 15px">Detail</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
               <div class="col-md-4">
                  <img src="{{ asset('img/logo-smkn4bdg.png') }}" class="img-fluid rounded-start p-3 border-dark"
                     alt="..." width="200">
               </div>
               <div class="col-md-8">
                  <div class="card-body">
                     <h5 class="card-title">Card title</h5>
                     <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                        additional
                        content. This content is a little bit longer.</p>
                     <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                     <div class="d-flex justify-content-end">
                        <a href="#" class="badge bg-primary text-decoration-none text-uppercase px-2 py-2 text-white"
                           style="font-size: 15px; border-radius: 15px">Detail</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div> --}}
   </div>

   <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
@endsection
