@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}">Home</a>
   </li>
   <li class="breadcrumb-item">
      <a href="{{ route('pelanggaran.students.index') }}">Data Pelanggaran
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
               <div class="row d-flex justify-content-start">
                  <div class="col-lg-9">
                     <h4 class="card-title">Pelanggaran</h4>
                     <p class="card-text">Terakhir perubahan : {{ $student->updated_at->diffForHumans() }}</p>
                  </div>
                  <div class="col-lg-3 d-flex justify-content-end">

                     <div>
                        <a href="{{ route('pelanggaran.students.edit', $student->nis) }}"
                           class="badge bg-success text-decoration-none text-white mx-1 py-2">
                           <i class="las la-plus"
                              style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                        </a>
                        <a href="{{ route('pelanggaran.students.dismiss', $student->nis) }}"
                           class="badge bg-danger text-decoration-none text-white me-1 py-2">
                           <i class="las la-minus"
                              style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                        </a>
                     </div>
                  </div>
               </div>





            </div>
            <ul class="list-group list-group-flush">
               @forelse ($student->pelanggarans as $pelanggaran)
                  @php
                     $jenis = '';
                     $color = '';
                     
                     if ($pelanggaran->klasifikasi->poin <= 20) {
                         $color = 'success';
                         $jenis = 'ringan';
                     } elseif ($pelanggaran->klasifikasi->poin <= 30 && $pelanggaran->klasifikasi->poin >= 21) {
                         $color = 'warning';
                         $jenis = 'sedang';
                     } elseif ($pelanggaran->klasifikasi->poin <= 50 && $pelanggaran->klasifikasi->poin >= 31) {
                         $color = 'danger';
                         $jenis = 'berat';
                     } else {
                         $color = 'dark';
                         $jenis = 'error';
                     }
                  @endphp
                  <li class="list-group-item d-flex justify-content-between align-items-center">{{ $pelanggaran->nama }}
                     <span
                        class="badge bg-{{ $color }} badge-pill text-white">{{ $pelanggaran->klasifikasi->poin }}</span>
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
            <form method="POST" action="{{ route('pelanggaran.students.update', $student->nis) }}">
               @csrf
               @method('put')

               <div class="card-header">
                  <span class="mb-0"> Tambah pelanggaran baru</span>
                  <div class="row d-flex justify-content-start">
                     <div class="row justify-content-end col-lg-12">
                        <button type="submit" class="btn btn-primary " style="padding: 5px 70px; margin-top: -25px">
                           <i class="fas fa-save"></i>
                           Simpan</button>


                     </div>
                  </div>

                  {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
                     <span class="mb-0 text-gray-800">Tambah pelanggaran baru</span>
                     <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <button type="submit" class="btn btn-primary px-5">Save</button>
                     </a>
                  </div> --}}
               </div>
               <ul class="list-group list-group-flush">
                  @forelse ($pelanggarans as $pelanggaran)
                     @php
                        $color = '';
                        if ($pelanggaran->klasifikasi->poin <= 20) {
                            $color = 'success';
                        } elseif ($pelanggaran->klasifikasi->poin <= 30 && $pelanggaran->klasifikasi->poin >= 21) {
                            $color = 'warning';
                        } elseif ($pelanggaran->klasifikasi->poin <= 50 && $pelanggaran->klasifikasi->poin >= 31) {
                            $color = 'danger';
                        } else {
                            $color = 'dark';
                        }
                     @endphp
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $pelanggaran->nama }}
                        <div class="justify-content-end px-2">
                           <span
                              class="badge bg-{{ $color }} badge-pill me-3 text-white px-2">{{ $pelanggaran->klasifikasi->poin }}</span>
                           <div class="form-check form-check-inline d-inline-flex ms-3 py-1 px-3">
                              <input class="form-check-input" type="checkbox" name="pelanggaran[]" id="x"
                                 value="{{ $pelanggaran->id }}">
                           </div>


                        </div>

                     </li>
                  @empty
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ __('Data Pelanggaran masih kosong!') }}
                        <span class="badge bg-success badge-pill text-white">{{ __('kosong') }}</span>
                     </li>
                  @endforelse

                  <div class="d-flex justify-content-center">
                     <div class="row col-lg-2 my-2">
                        <button type="submit" class="btn btn-primary" style="padding: 5px 50px">
                           <i class="fas fa-save"></i> Simpan</button>
                     </div>
                  </div>
               </ul>
            </form>

         </div>
      </div>
   </div>







@endsection
