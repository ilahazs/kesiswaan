@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('dashboard.students.index') }}" class="text-decoration-none">All Student</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('dashboard.students.edit', $student->nis) }}"
         class="text-decoration-none {{ Request::is('dashboard/students/edit') ? 'text-secondary' : '' }}">{{ $title }}</a>
   </li>
@endsection
@section('container')

   <div class="row mb-5">
      <div class="col-lg-8">
         <form method="POST" action="{{ route('dashboard.students.update', $student->nis) }}">
            @method('put')
            @csrf
            <div class="mb-3">
               <label for="nama" class="form-label">Nama</label>
               <input type="text" class="form-control @error('nama')
                  is-invalid
               @enderror"
                  id="nama" name="nama" value="{{ old('nama', $student->nama) }}">
               @error('nama')
                  <div class="invalid-feedback">
                     {{ $message }}
                  </div>
               @enderror
            </div>
            <div class="mb-3">
               <label for="nis" class="form-label">NIS</label>
               <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis" name="nis"
                  value="{{ old('nis', $student->nis) }}">
               @error('nis')
                  <div class="invalid-feedback">
                     {{ $message }}
                  </div>
               @enderror
            </div>
            <div class="mb-3">
               <label for="kelas" class="form-label">Kelas</label>
               <div class="row">
                  <div class="col-md-4">
                     <select class="form-control" name="tingkatan_kelas" id="kelas">
                        <option disabled selected>Select Tingkatan</option>
                        @foreach ($tingkatan as $t)
                           @php
                              $romawiTingkat = '';
                              switch ($t) {
                                  case '10':
                                      $romawiTingkat = 'X';
                                      break;
                                  case '11':
                                      $romawiTingkat = 'XI';
                                      break;
                                  case '12':
                                      $romawiTingkat = 'XII';
                                      break;
                                  default:
                                      $romawiTingkat = 'Undefined';
                                      break;
                              }
                           @endphp
                           @if (old('tingkatan_kelas', $student->kelas->tingkatan) == $t)
                              <option value="{{ $t }}" selected>{{ $romawiTingkat }}</option>
                           @else
                              <option value="{{ $t }}">{{ $romawiTingkat }}</option>
                           @endif
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-4">

                     <select class="form-control" name="jurusan_kelas" id="kelas">
                        <option disabled selected>Select Jurusan</option>
                        @foreach ($jurusan as $j)
                           @if (old('jurusan_kelas', $student->kelas->jurusan) === $j)
                              <option value="{{ $j }}" selected>{{ $j }}</option>
                           @else
                              <option value="{{ $j }}">{{ $j }}</option>
                           @endif
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-4">

                     <select class="form-control" name="urutan_kelas" id="kelas">
                        <option disabled selected>Select Urutan</option>
                        @foreach ($urutan as $u)
                           @if (old('urutan_kelas', $student->kelas->nama) == $u)
                              <option value="{{ $u }}" selected>{{ $u }}</option>
                           @else
                              <option value="{{ $u }}">{{ $u }}</option>
                           @endif

                        @endforeach
                     </select>
                  </div>

               </div>
            </div>

            <div class="mb-3">
               <label for="kelas" class="form-label">Jenis Kelamin</label>
               <div class="form-check">
                  <label class="form-check-label" for="L">
                     <input type="radio" class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                        name="jenis_kelamin" id="L" value="L" @if (old('jenis_kelamin', $student->jenis_kelamin) == 'L')
                     checked
                     @endif>
                     Laki-laki
                  </label>
                  <label class="form-check-label ms-5" for="P">
                     <input type="radio" class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                        name="jenis_kelamin" id="P" value="P" @if (old('jenis_kelamin', $student->jenis_kelamin) == 'P')
                     checked
                     @endif>
                     Perempuan
                  </label>
               </div>
            </div>
            {{-- <input type="hidden" name="point" value="100"> --}}
            <div class="d-flex justify-content-end">
               <button type="submit" class="btn btn-primary px-4">Save Changes</button>
            </div>
         </form>
      </div>
   </div>



@endsection
