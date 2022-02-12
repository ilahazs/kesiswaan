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
         class="text-decoration-none {{ Request::is('penghargaan/' . $penghargaan->id . 'edit') ? 'text-secondary' : '' }}">{{ $title }}</a>
   </li>
@endsection
@section('container')

   <div class="row mb-2">
      <div class="col-lg-8">
         <div class="card">
            <div class="card-body">
               <form method="POST" action="{{ route('penghargaan.update', $penghargaan->id) }}">
                  @csrf
                  @method('put')

                  <div class="mb-3">
                     <div class="row d-flex justify-content-start">
                        <div class="col-md-7">
                           <label for="nama" class="form-label">Nama</label>
                        </div>
                        <div class="col-md-3">
                           <label for="tingkatan" class="form-label">Tingkatan</label>
                        </div>
                        <div class="col-md-2">
                           <label for="poin" class="form-label">Besar Poin</label>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-7">

                           <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                              name="nama" value="{{ old('nama', $penghargaan->nama) }}">
                           @error('nama')
                              <div class="invalid-feedback">
                                 {{ $message }}
                              </div>
                           @enderror

                        </div>

                        <div class="col-md-3">

                           <input type="text" class="form-control @error('tingkatan') is-invalid @enderror" id="tingkatan"
                              name="tingkatan" value="{{ old('tingkatan', $penghargaan->tingkatan) }}">
                           @error('tingkatan')
                              <div class="invalid-feedback">
                                 {{ $message }}
                              </div>
                           @enderror

                        </div>


                        <div class="col-md-2">
                           <input type="number" class="form-control @error('poin') is-invalid @enderror" id="poin"
                              name="poin" value="{{ old('poin', $penghargaan->poin) }}">
                           @error('poin')
                              <div class="invalid-feedback">
                                 {{ $message }}
                              </div>
                           @enderror
                        </div>

                     </div>
                  </div>

                  <div class="mb-3">
                     <div class="row">
                        <div class="col-lg-12">
                           <label for="keterangan" class="form-label">Keterangan</label>
                           <textarea
                              class="form-control @error('keterangan')
                    is-invalid border-danger
                 @enderror"
                              id="keterangan" name="keterangan"
                              value="{{ old('keterangan', $penghargaan->keterangan) }}"
                              rows="2">{{ old('keterangan', $penghargaan->keterangan) }}</textarea>
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


                  <div class="mb-3 mt-4">
                     <div class="row d-flex justify-content-end">
                        <div class="col-lg-2 px-3">
                           <button type="submit" class="btn btn-primary px-4">Save</button>
                        </div>
                     </div>
                  </div>
               </form>


            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="card">
            <div class="card-header">
               Note
            </div>
            <div class="card-body">
               <table class="table">
                  <thead>
                     <tr>
                        <th scope="col">Klasifikasi</th>
                        <th scope="col">Besar</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($jenis as $j)
                        <tr>
                           @php
                              $startPoin = 0;
                              $endPoin = 0;
                              if ($j == 'ringan') {
                                  $startPoin = 0;
                                  $endPoin = 20;
                              } elseif ($j == 'sedang') {
                                  $startPoin = 21;
                                  $endPoin = 30;
                              } elseif ($j == 'tinggi') {
                                  $startPoin = 31;
                                  $endPoin = ' ... ';
                              } else {
                                  $startPoin = 0;
                                  $endPoin = 0;
                              }
                           @endphp
                           <td>{{ $j }}</td>
                           <td>{{ $startPoin }} ⟶ {{ $endPoin }}</td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>



@endsection
