@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('guru.index') }}"
         class="text-decoration-none {{ Request::is('guru*') ? 'text-secondary' : '' }}">{{ $title }}</a>
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
               <h4 class="card-title">{{ $guru->nama }}</h4>
               <p class="card-text">{{ $guru->created_at->diffForHumans() }}</p>
               <div class="mb-3">
                  <div class="row d-flex justify-content-start">
                     <div class="col-md-8">
                        <label for="nama" class="form-label">Nama</label>
                     </div>
                     <div class="col-md-4">
                        <label for="nis" class="form-label">Walikelas</label>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-8">

                        <input type="text" class="form-control bg-white" id="nama" name="nama" value="{{ $guru->nama }}"
                           disabled readonly>

                     </div>

                     <div class="col-md-4">
                        @php
                           $romawiTingkatan = '';
                           switch ($kelas->tingkatan) {
                               case '10':
                                   $romawiTingkatan = 'X';
                                   break;
                               case '11':
                                   $romawiTingkatan = 'XI';
                                   break;
                               case '12':
                                   $romawiTingkatan = 'XII';
                                   break;
                               default:
                                   $romawiTingkatan = 'None';
                                   break;
                           }
                           $concatKelas = $romawiTingkatan . ' ' . $kelas->jurusan . ' ' . $kelas->nama;
                        @endphp
                        <input type="text" class="form-control bg-white" value="{{ $concatKelas }}" disabled readonly>
                     </div>

                  </div>
               </div>
            </div>
         </div>
      </div>
      {{-- <div class="col-lg-5">
         <div class="card shadow-sm">
            <div class="card-body">
               <h4 class="card-title">Aktivitas</h4>
               <p class="card-text">Terakhir login :
                  {{ date(Auth::user()->last_login_at) }} <br> {{ 'di ' . Auth::user()->last_login_ip }}
               </p>
            </div>
         </div>
      </div> --}}
   </div>

@endsection
