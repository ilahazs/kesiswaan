@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('dashboard.pelanggaran.students.index') }}" class="text-decoration-none">Data Pelanggaran
         Siswa</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('dashboard.pelanggaran.students.edit', $student->id) }}"
         class="text-decoration-none {{ Request::is('pelanggaran/students/edit') ? 'text-secondary' : '' }}">{{ $title }}</a>
   </li>
@endsection
@section('container')

   <div class="row mb-4">
      <div class="col-lg-7">
         <div class="card shadow-sm">
            <div class="card-body">
               <h4 class="card-title">{{ $student->nama }}</h4>
               <p class="card-text">{{ $student->created_at->diffForHumans() }}</p>
               <div class="mb-3">
                  <div class="row d-flex justify-content-start">
                     <div class="col-md-8">
                        <label for="nama" class="form-label">Nama</label>
                     </div>
                     <div class="col-md-4">
                        <label for="nis" class="form-label">Kelas</label>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-8">

                        <input type="text" class="form-control bg-white @error('nama') is-invalid @enderror" id="nama"
                           name="nama" value="{{ old('nama', $student->nama) }}" disabled readonly>
                        @error('nama')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror

                     </div>

                     <div class="col-md-4">

                        @php
                           $romawiTingkatan = '';
                           switch ($student->kelas->tingkatan) {
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
                           $concatKelas = $romawiTingkatan . ' ' . $student->kelas->jurusan . ' ' . $student->kelas->nama;
                        @endphp
                        <input type="text" class="form-control bg-white @error('class_id') is-invalid @enderror"
                           id="class_id" name="class_id" value="{{ $concatKelas }}" disabled readonly>
                        @error('class_id')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror

                     </div>

                  </div>
               </div>

               <div class="mb-3">
                  <div class="row d-flex justify-content-start">
                     <div class="col-md-9">
                        <label for="nama" class="form-label">NIS</label>
                     </div>
                     <div class="col-md-3">
                        <label for="nis" class="form-label">Besar Poin</label>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-9">
                        <input type="text" class="form-control bg-white @error('nis') is-invalid @enderror" id="nis"
                           name="nis" value="{{ old('nis', $student->nis) }}" disabled readonly>
                        @error('nis')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>

                     <div class="col-md-3">
                        <input type="number" class="form-control bg-white @error('poin_pelanggaran') is-invalid @enderror"
                           id="poin_pelanggaran" name="poin_pelanggaran"
                           value="{{ old('poin_pelanggaran', $student->poin_pelanggaran) }}" disabled readonly>
                        @error('poin_pelanggaran')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
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
               <h4 class="card-title">Pelanggaran</h4>
               <p class="card-text">Terakhir perubahan : {{ $student->updated_at->diffForHumans() }}</p>
            </div>
            <ul class="list-group list-group-flush">
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
            </ul>
         </div>
      </div>
   </div>

   <form method="POST" action="{{ route('dashboard.pelanggaran.students.update', $student->nis) }}">
      @csrf
      @method('put')

      <div class="row mb-4">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-header">
                  Tambah pelanggaran baru
               </div>
               <ul class="list-group list-group-flush">
                  @forelse ($pelanggarans as $pelanggaran)
                     @php
                        $color = '';
                        if ($pelanggaran->poin <= 20) {
                            $color = 'success';
                        } elseif ($pelanggaran->poin <= 30 && $pelanggaran->poin >= 21) {
                            $color = 'warning';
                        } elseif ($pelanggaran->poin <= 50 && $pelanggaran->poin >= 31) {
                            $color = 'danger';
                        } else {
                            $color = 'secondary';
                        }
                     @endphp
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $pelanggaran->nama }}
                        <div class="justify-content-end">
                           <span class="badge bg-{{ $color }} badge-pill me-3">{{ $pelanggaran->poin }}</span>
                           <div class="form-check form-check-inline d-inline-flex">
                              <input class="form-check-input" type="checkbox" name="pelanggaran[]" id="x"
                                 value="{{ $pelanggaran->id }}">
                           </div>


                        </div>

                     </li>
                  @empty
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ __('Data Pelanggaran masih kosong!') }}
                        <span class="badge bg-success badge-pill">{{ __('kosong') }}</span>
                     </li>
                  @endforelse

               </ul>
               <div class="card-header">
                  Pelanggaran yang telah didapatkan

               </div>
               <ul class="list-group list-group-flush">
                  @forelse ($student->pelanggarans as $pelanggaran)
                     @php
                        $color = '';
                        if ($pelanggaran->poin <= 20) {
                            $color = 'success';
                        } elseif ($pelanggaran->poin <= 30 && $pelanggaran->poin >= 21) {
                            $color = 'warning';
                        } elseif ($pelanggaran->poin <= 50 && $pelanggaran->poin >= 31) {
                            $color = 'danger';
                        } else {
                            $color = 'secondary';
                        }
                     @endphp
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $pelanggaran->nama }}
                        <div class="justify-content-end">
                           <span class="badge bg-{{ $color }} badge-pill me-3">{{ $pelanggaran->poin }}</span>
                           <div class="form-check form-check-inline d-inline-flex">
                              <input class="form-check-input" type="checkbox" name="pelanggaran[]" id="x"
                                 value="{{ $pelanggaran->id }}" checked>
                           </div>
                        </div>
                     </li>
                  @empty
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ __('Data Pelanggaran masih kosong!') }}
                        <span class="badge bg-success badge-pill">{{ __('kosong') }}</span>
                     </li>
                  @endforelse
               </ul>
            </div>
         </div>
      </div>

      <div class="d-flex justify-content-center mt-5 mb-5">
         <div class="row col-lg-2">
            <button type="submit" class="btn btn-primary">Save</button>
         </div>
      </div>
   </form>





@endsection
