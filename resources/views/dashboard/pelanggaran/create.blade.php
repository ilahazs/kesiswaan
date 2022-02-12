@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
<li class="breadcrumb-item">
   <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
</li>
<li class="breadcrumb-item" aria-current="page">
   <a href="{{ route('pelanggaran.index') }}" class="text-decoration-none">Data Pelanggaran</a>
</li>
<li class="breadcrumb-item" aria-current="page">
   <a href="{{ route('pelanggaran.create') }}" class="text-decoration-none {{ Request::is('pelanggaran/create') ? 'text-secondary' : '' }}">{{ $title }}</a>
</li>
@endsection
@section('container')


<div class="row mb-2">
   <div class="col-lg-8">
      <div class="card">
         <div class="card-body">

            <form method="POST" action="{{ route('pelanggaran.store') }}">
               @csrf

               <div class="mb-3">
                  <div class="row d-flex justify-content-start">
                     <div class="col-md-8">
                        <label for="nama" class="form-label">Nama</label>
                     </div>
                     <div class="col-md-4">
                        <label for="poin" class="form-label">Besar Poin</label>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-8">

                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">
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
                           } elseif ($j == 'berat') {
                           $besarPoin = 50;
                           } else {
                           $besarPoin = 0;
                           }
                           @endphp
                           @if (old('jenis') == $j)
                           <option value="{{ $j }}" selected id="jenis_data">
                              {{ $j . ' ⟶ : ' . $besarPoin }}
                           </option>
                           @else
                           <option value="{{ $j }}" id="jenis_data">{{ $j . ' ⟶ : ' . $besarPoin }}
                           </option>
                           @endif
                           @endforeach
                        </select>
                     </div>

                  </div>
               </div>

               <div class="mb-3">
                  <div class="row">
                     <div class="col-lg-12">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control @error('keterangan')
                          is-invalid border-danger
                       @enderror" id="keterangan" name="keterangan" value="{{ old('keterangan') }}" rows="3"></textarea>
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
                     $besarPoin = 0;
                     if ($j == 'ringan') {
                     $besarPoin = 20;
                     } elseif ($j == 'sedang') {
                     $besarPoin = 30;
                     } elseif ($j == 'berat') {
                     $besarPoin = 50;
                     } else {
                     $besarPoin = 0;
                     }
                     @endphp
                     <td>{{ $j }}</td>
                     <td>{{ $besarPoin }}</td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>



@endsection
