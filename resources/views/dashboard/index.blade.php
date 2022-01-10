@extends('dashboard.layouts.main')
@section('heading-title', 'Welcome back, ' . Auth::user()->name)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none text-secondary">Home</a>
   </li>
@endsection
@section('container')

   @if (session('success'))
      <div class="col-lg-11">
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {!! session('success') !!}
         </div>
      </div>
   @endif

   <div class="row mb-4">
      <div class="col-lg-7">
         <div class="card shadow-sm">
            <div class="card-body">
               <h4 class="card-title">{{ Auth::user()->name }}</h4>
               <p class="card-text">{{ Auth::user()->created_at->diffForHumans() }}</p>
               <div class="mb-3">
                  <div class="row d-flex justify-content-start">
                     <div class="col-md-8">
                        <label for="nama" class="form-label">Nama</label>
                     </div>
                     <div class="col-md-4">
                        <label for="nis" class="form-label">Email</label>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-8">

                        <input type="text" class="form-control bg-white" id="nama" name="nama"
                           value="{{ Auth::user()->name }}" disabled readonly>

                     </div>

                     <div class="col-md-4">

                        <input type="text" class="form-control bg-white" id="class_id" name="class_id"
                           value="{{ Auth::user()->email }}" disabled readonly>

                     </div>

                  </div>
               </div>

               <div class="mb-3">
                  <div class="row d-flex justify-content-start">
                     <div class="col-md-9">
                        <label for="nama" class="form-label">Username</label>
                     </div>
                     <div class="col-md-3">
                        <label for="nis" class="form-label">Role</label>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-9">
                        <input type="text" class="form-control bg-white" id="username" name="username"
                           value="{{ Auth::user()->username }}" disabled readonly>
                     </div>

                     <div class="col-md-3">
                        <input type="text" class="form-control bg-white" id="role" name="role"
                           value="{{ Auth::user()->role }}" disabled readonly>
                     </div>

                  </div>
               </div>
            </div>
         </div>
         {{-- {!! Form::hidden('poin', 20) !!} --}}
         {{-- <input type="hidden" name="poin" value="0"> --}}
      </div>
      <div class="col-lg-5">
         <div class="card shadow-sm">
            <div class="card-body">
               <h4 class="card-title">Aktivitas</h4>
               <p class="card-text">Terakhir login :
                  {{ date(Auth::user()->last_login_at) }} <br> {{ 'di ' . Auth::user()->last_login_ip }}
               </p>
            </div>
            {{-- <ul class="list-group list-group-flush">
            @forelse ($student->pelanggarans as $pelanggaran)
               @php
                  $jenis = '';
                  $color = '';
                  
                  if ($pelanggaran->poin <= 20) {
                      $color = 'success';
                      $jenis = 'ringan';
                  } elseif ($pelanggaran->poin <= 30 && $pelanggaran->poin >= 21) {
                      $color = 'warning';
                      $jenis = 'sedang';
                  } elseif ($pelanggaran->poin <= 50 && $pelanggaran->poin >= 31) {
                      $color = 'danger';
                      $jenis = 'berat';
                  } else {
                      $color = 'secondary';
                      $jenis = 'error';
                  }
               @endphp
               <li class="list-group-item d-flex justify-content-between align-items-center">{{ $pelanggaran->nama }}
                  <span class="badge bg-{{ $color }} badge-pill">{{ $pelanggaran->poin }}</span>
               </li>
            @empty
               <li class="list-group-item d-flex justify-content-between align-items-center">
                  {{ __('Data masih kosong!') }}
                  <span class="badge bg-success badge-pill">{{ __('kosong') }}</span>
               </li>
            @endforelse
         </ul> --}}
         </div>
      </div>
   </div>

@endsection
