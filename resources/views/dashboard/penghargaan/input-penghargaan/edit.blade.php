@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('penghargaan.index') }}" class="text-decoration-none">Data Penghargaan</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('penghargaan.edit', $penghargaan->id) }}"
         class="text-decoration-none {{ Request::is('dashboard/penghargaan/edit') ? 'text-secondary' : '' }}">{{ $title }}</a>
   </li>
@endsection
@section('container')

   <div class="row mb-5">
      <div class="col-lg-8">
         <form method="POST" action="{{ route('penghargaan.update', $penghargaan->id) }}">
            @csrf
            @method('put')

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
                        value="{{ old('nama', $penghargaan->nama) }}">
                     @error('nama')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                  </div>

                  <div class="col-md-4">
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
                              // Menentukan jenis data sebelumnya
                              if ($penghargaan->poin == 20) {
                                  $jenisSebelumnya = 'ringan';
                              } elseif ($penghargaan->poin == 30) {
                                  $jenisSebelumnya = 'sedang';
                              } elseif ($penghargaan->poin == 50) {
                                  $jenisSebelumnya = 'berat';
                              }
                           @endphp
                           @if (old('jenis', $jenisSebelumnya) == $j)
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
                        id="keterangan" name="keterangan" value="{{ old('keterangan', $penghargaan->keterangan) }}">
                     @error('keterangan')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
            </div>
            {{-- {!! Form::hidden('poin', 20) !!} --}}
            {{-- <input type="hidden" name="poin" value="0"> --}}


            <div class="d-flex justify-content-end">
               <button type="submit" class="btn btn-primary px-4">Save</button>
            </div>
         </form>
      </div>
   </div>



@endsection
