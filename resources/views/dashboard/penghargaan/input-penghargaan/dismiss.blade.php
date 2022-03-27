@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('penghargaan.students.index') }}" class="text-decoration-none">Rekap Penghargaan
         Siswa</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      {{ $title }}
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
                        <input type="number" class="form-control bg-white @error('poin_penghargaan') is-invalid @enderror"
                           id="poin_penghargaan" name="poin_penghargaan"
                           value="{{ old('poin_penghargaan', $student->poin_penghargaan) }}" disabled readonly>
                        @error('poin_penghargaan')
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
               <div class="row d-flex justify-content-start">
                  <div class="col-lg-9">
                     <h4 class="card-title">Penghargaan</h4>
                     <p class="card-text">Terakhir perubahan : {{ $student->updated_at->diffForHumans() }}</p>
                  </div>
                  <div class="col-lg-3 d-flex justify-content-end">

                     <div>
                        <a href="{{ route('penghargaan.students.edit', $student->nis) }}"
                           class="badge bg-success text-decoration-none text-white mx-1 py-2">
                           <i class="las la-plus"
                              style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                        </a>
                        <a href="{{ route('penghargaan.students.dismiss', $student->nis) }}"
                           class="badge bg-danger text-decoration-none text-white me-1 py-2">
                           <i class="las la-minus"
                              style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
            <ul class="list-group list-group-flush">
               @forelse ($student->penghargaans as $penghargaan)
                  @php
                     $jenis = '';
                     $color = '';
                     
                     if ($penghargaan->poin <= 20) {
                         $color = 'success';
                         $jenis = 'ringan';
                     } elseif ($penghargaan->poin <= 30 && $penghargaan->poin >= 21) {
                         $color = 'warning';
                         $jenis = 'sedang';
                     } elseif ($penghargaan->poin <= 50 && $penghargaan->poin >= 31) {
                         $color = 'danger';
                         $jenis = 'berat';
                     } else {
                         $color = 'secondary';
                         $jenis = 'error';
                     }
                  @endphp
                  <li class="list-group-item d-flex justify-content-between align-items-center">{{ $penghargaan->nama }}
                     <span class="badge bg-{{ $color }} badge-pill text-white">{{ $penghargaan->poin }}</span>
                  </li>
               @empty
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                     {{ __('Data masih kosong!') }}
                     <span class="badge bg-success badge-pill text-white">{{ __('kosong') }}</span>
                  </li>
               @endforelse
            </ul>
         </div>
      </div>
   </div>



   <div class="row mb-4">
      <div class="col-lg-12">
         <div class="card">
            <form method="POST" action="{{ route('penghargaan.students.dismissdata', $student->nis) }}">
               @csrf
               @method('put')

               <div class="card-header">
                  <span class="mb-0">Penghargaan yang telah didapatkan</span>
                  <div class="row d-flex justify-content-start">
                     <div class="row justify-content-end col-lg-12">
                        <button type="submit" class="btn btn-primary " style="padding: 5px 70px; margin-top: -25px">
                           <i class="fas fa-save"></i>
                           Simpan</button>


                     </div>
                  </div>
               </div>


               <ul class="list-group list-group-flush">
                  @forelse ($student->penghargaans as $penghargaan)
                     @php
                        $color = '';
                        if ($penghargaan->klasifikasi->poin <= 20) {
                            $color = 'success';
                        } elseif ($penghargaan->klasifikasi->poin <= 30 && $penghargaan->klasifikasi->poin >= 21) {
                            $color = 'warning';
                        } elseif ($penghargaan->klasifikasi->poin <= 50 && $penghargaan->klasifikasi->poin >= 31) {
                            $color = 'danger';
                        } else {
                            $color = 'danger';
                        }
                     @endphp
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $penghargaan->nama }}
                        <div class="justify-content-end px-2">
                           <span
                              class="badge bg-{{ $color }} badge-pill me-3 text-white px-2">{{ $penghargaan->klasifikasi->poin }}</span>
                           <div class="form-check form-check-inline d-inline-flex py-1 px-3">
                              <input class="form-check-input" type="checkbox" name="penghargaan[]" id="x"
                                 value="{{ $penghargaan->id }}" checked>
                              {{-- <input type="hidden" name="penghargaan[]" value="0"> --}}
                           </div>
                        </div>
                     </li>
                  @empty
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ __('Data penghargaan masih kosong!') }}
                        <span class="badge bg-success badge-pill text-white">{{ __('kosong') }}</span>
                     </li>
                  @endforelse
                  <div class="d-flex justify-content-center my-1 mx-3">
                     <div class="row col-lg-2">
                        <button type="submit" class="btn btn-primary px-5              ">
                           <i class="fas fa-save"></i> Simpan</button>
                     </div>
                  </div>
               </ul>
            </form>
         </div>
      </div>
   </div>







@endsection
