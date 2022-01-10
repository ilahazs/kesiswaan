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

   <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
@endsection
