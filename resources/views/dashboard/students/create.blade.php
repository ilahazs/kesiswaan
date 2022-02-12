@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('students.index') }}" class="text-decoration-none">All Student</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('students.create') }}"
         class="text-decoration-none {{ Request::is('students/create') ? 'text-secondary' : '' }}">{{ $title }}</a>
   </li>
@endsection
@section('container')

   <div class="row">
      <div class="col-lg-8">

         <div class="card">
            <div class="card-body">
               <div class="row mb-2">
                  <div class="col-lg-12">
                     <form method="POST" action="{{ route('students.store') }}">
                        @csrf
                        <div class="mb-3">
                           <div class="row">
                              <div class="col-lg-6">
                                 <label for="nama" class="form-label">Nama</label>

                              </div>
                              <div class="col-lg-6">
                                 <label for="nis" class="form-label">NIS</label>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-lg-6">
                                 <input type="text"
                                    class="form-control @error('nama')
                           is-invalid
                        @enderror"
                                    id="nama" name="nama" value="{{ old('nama') }}">
                                 @error('nama')
                                    <div class="invalid-feedback">
                                       {{ $message }}
                                    </div>
                                 @enderror
                              </div>
                              <div class="col-lg-6">
                                 <input type="number" class="form-control @error('nis') is-invalid @enderror" id="nis"
                                    name="nis" value="{{ old('nis') }}">
                                 @error('nis')
                                    <div class="invalid-feedback">
                                       {{ $message }}
                                    </div>
                                 @enderror
                              </div>

                           </div>

                        </div>


                        <div class="mb-4">
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
                                       @if (old('tingkatan_kelas') === $t)
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
                                       @if (old('jurusan_kelas') === $j)
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
                                       @if (old('jurusan_kelas') === $u)
                                          <option value="{{ $u }}" selected>{{ $u }}</option>
                                       @else
                                          <option value="{{ $u }}">{{ $u }}</option>
                                       @endif

                                    @endforeach
                                 </select>
                              </div>

                              <input type="hidden" name="class_id" value="0">

                           </div>
                        </div>



                        <div class="mb-3">
                           <label for="kelas" class="form-label">Jenis Kelamin</label>
                           <div class="form-check row d-flex justify-content-start">
                              <div class="col-md-3">
                                 <label class="form-check-label" for="L">
                                    <input type="radio"
                                       class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                       name="jenis_kelamin" id="L" value="L" @if (old('jenis_kelamin') == 'L')
                                    checked
                                    @endif>
                                    Laki-laki
                                 </label>
                              </div>
                              <div class="col-md-3">
                                 <label class="form-check-label " for="P">
                                    <input type="radio"
                                       class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                       name="jenis_kelamin" id="P" value="P" @if (old('jenis_kelamin') == 'P')
                                    checked
                                    @endif>
                                    Perempuan
                                 </label>
                              </div>
                           </div>
                        </div>
                        <input type="hidden" name="point" value="100">
                        <div class="d-flex justify-content-end">
                           <button type="submit" class="btn btn-primary px-5">Save</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>


   <script>
      // show or hide form bukti script
      // function showForm() {
      //    const select = document.getElementById('tipe_rule');
      //    const select = document.getElementById('select_rule_data');
      //    const bukti = document.getElementById('bukti');
      //    const ket = document.getElementById('ket');
      //    console.log(select.value);
      //    if (select.value != 1 && select.value != 0) {
      //       bukti.classList.remove('visually-hidden');
      //       if (select.value == 2) {
      //          ket.innerHTML = "Penghargaan atau Prestasi";
      //          $(bukti).attr("required", true);
      //       } else if (select.value == 3) {
      //          ket.innerHTML = "Surat Rekomendasi RMP"
      //          $(bukti).attr("required", true);
      //       }
      //    } else {
      //       bukti.classList.add('visually-hidden');
      //    }
      // }
   </script>

@endsection
