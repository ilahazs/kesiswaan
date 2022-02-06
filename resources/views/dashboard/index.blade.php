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
                     <div class="col-md-6">
                        <label for="nama" class="form-label">Nama</label>
                     </div>
                     <div class="col-md-6">
                        <label for="nis" class="form-label">Email</label>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-6">

                        <input type="text" class="form-control bg-white" id="nama" name="nama"
                           value="{{ Auth::user()->name }}" disabled readonly>

                     </div>

                     <div class="col-md-6">

                        <input type="text" class="form-control bg-white" id="class_id" name="class_id"
                           value="{{ Auth::user()->email }}" disabled readonly>

                     </div>

                  </div>
               </div>

               <div class="mb-3">
                  <div class="row d-flex justify-content-start">
                     @if (Auth::user()->role == 'guru')
                        <div class="col-md-5">
                           <label for="nama" class="form-label">Username</label>
                        </div>
                        <div class="col-md-4">
                           <label for="nama" class="form-label">Walikelas</label>
                        </div>
                        <div class="col-md-3">
                           <label for="nis" class="form-label">Role</label>
                        </div>
                     @else
                        <div class="col-md-9">
                           <label for="nama" class="form-label">Username</label>
                        </div>
                        <div class="col-md-3">
                           <label for="nis" class="form-label">Role</label>
                        </div>
                     @endif
                  </div>

                  <div class="row">
                     @if (Auth::user()->role == 'guru')
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
                        <div class="col-md-5">
                           <input type="text" class="form-control bg-white" id="username" name="username"
                              value="{{ Auth::user()->username }}" disabled readonly>
                        </div>

                        <div class="col-md-4">
                           <input type="text" class="form-control bg-white" id="kelas" name="kelas"
                              value="{{ $concatKelas }}" disabled readonly>
                        </div>

                        <div class="col-md-3">
                           <input type="text" class="form-control bg-white" id="role" name="role"
                              value="{{ Auth::user()->role }}" disabled readonly>
                        </div>
                     @else
                        <div class="col-md-9">
                           <input type="text" class="form-control bg-white" id="username" name="username"
                              value="{{ Auth::user()->username }}" disabled readonly>
                        </div>

                        <div class="col-md-3">
                           <input type="text" class="form-control bg-white" id="role" name="role"
                              value="{{ Auth::user()->role }}" disabled readonly>
                        </div>
                     @endif
                  </div>

               </div>

               @if (Auth::user()->role == 'guru')
                  <div class="row d-flex justify-content-start">
                     <div class="col-md-6">
                        <label for="nama" class="form-label">NIP</label>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <input type="text" class="form-control bg-white" id="nip" name="nip"
                              value="{{ $nip }}" disabled readonly>
                        </div>
                     </div>
                  </div>
               @endif
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
         </div>
      </div>
   </div>

@endsection
