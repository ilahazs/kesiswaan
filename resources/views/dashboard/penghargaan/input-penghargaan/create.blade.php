@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('dashboard.penghargaan.index') }}" class="text-decoration-none">Data Penghargaan</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('dashboard.penghargaan.create') }}"
         class="text-decoration-none {{ Request::is('dashboard/penghargaan/create') ? 'text-secondary' : '' }}">{{ $title }}</a>
   </li>
@endsection
@section('container')

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

   <div class="row mb-5">
      <div class="col-lg-8">
         <form method="POST" action="{{ route('dashboard.penghargaan.store') }}">
            @csrf

            <div class="mb-3">
               <div class="row d-flex justify-content-start">
                  <div class="col-md-6">
                     <label for="nama" class="form-label">Nama</label>
                  </div>
                  <div class="col-md-4">
                     <label for="poin" class="form-label">Besar Poin</label>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-6">

                     <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                        value="{{ old('nama') }}">
                     @error('nama')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                  </div>

                  <div class="col-md-4">
                     {{-- <input type="number" class="form-control @error('poin') is-invalid @enderror" id="poin" name="poin"
                        value="{{ old('poin') }}" placeholder="ringan: 20 | sedang: 30 | berat: 50">
                     @error('poin')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror --}}
                     <select class="form-control" name="jenis" id="jenis">
                        <option disabled selected>Select Jenis Data</option>
                        @foreach ($jenis as $j)
                           @php
                              $besarPoin = 0;
                              if ($j == 'ringan') {
                                  $besarPoin = 20;
                              } elseif ($j == 'sedang') {
                                  $besarPoin = 30;
                              } elseif ($j == 'tinggi') {
                                  $besarPoin = 50;
                              } else {
                                  $besarPoin = 0;
                              }
                           @endphp
                           @if (old('jenis') == $j)
                              <option value="{{ $j }}" selected id="jenis_data">{{ $j . '->: ' . $besarPoin }}
                              </option>
                           @else
                              <option value="{{ $j }}" id="jenis_data">{{ $j . '->: ' . $besarPoin }}
                              </option>
                           @endif
                        @endforeach
                     </select>
                  </div>

               </div>
            </div>

            <div class="mb-3">
               <div class="row">
                  <div class="col-lg-10">
                     <label for="keterangan" class="form-label">Keterangan</label>
                     <input type="text" placeholder="Deskripsi Data ..."
                        class="form-control @error('keterangan')
                        is-invalid
                     @enderror"
                        id="keterangan" name="keterangan" value="{{ old('keterangan') }}">
                     @error('keterangan')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
            </div>
            {{-- {!! Form::hidden('poin', 20) !!} --}}
            <input type="hidden" name="poin" value="0">

            <div class="mb-3">
               <div class="row justify-content-start">
                  <div class="col-md-6">
                     <button type="submit" class="btn btn-primary px-4">Save</button>
                  </div>
               </div>
            </div>

         </form>
      </div>
   </div>



@endsection
