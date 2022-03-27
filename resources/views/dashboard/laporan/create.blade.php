@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('flash-message')
   @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
         <button type="button" class="btn-close close" data-dismiss="alert" aria-label="Close"><span
               aria-hidden="true">×</span></button>
         {!! session('success') !!}
      </div>
   @endif
@endsection
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('laporan.index') }}" class="text-decoration-none">Semua Laporan</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      {{ $title }}
   </li>
@endsection
@section('container')

   <div class="row">
      <div class="col-lg-12">

         <div class="card">
            <div class="card-body">
               <div class="row mb-2">
                  <div class="col-lg-12">
                     <form method="POST" action="{{ route('laporan.store') }}">
                        @csrf
                        <div class="mb-3">
                           <label for="nama_pelaku" class="form-label">Nama Pelaku <span
                                 class="text-danger">*</span></label>
                           <div class="row">
                              <div class="col-lg-6">
                                 <input type="text"
                                    class="form-control @error('nama_pelaku')
                           is-invalid
                        @enderror"
                                    id="nama_pelaku" name="nama_pelaku" value="{{ old('nama_pelaku') }}">
                                 @error('nama_pelaku')
                                    <div class="invalid-feedback">
                                       {{ $message }}
                                    </div>
                                 @enderror
                              </div>
                           </div>
                        </div>

                        <div class="mb-3">
                           <label for="nis_pelaku" class="form-label">NIS <span class="text-danger">*</span></label>

                           <div class="row">
                              <div class="col-lg-6">
                                 <input type="number" class="form-control @error('nis_pelaku') is-invalid @enderror"
                                    id="nis_pelaku" name="nis_pelaku" value="{{ old('nis_pelaku') }}">
                                 @error('nis_pelaku')
                                    <div class="invalid-feedback">
                                       {{ $message }}
                                    </div>
                                 @enderror
                              </div>
                           </div>

                        </div>


                        <div class="mb-4">
                           <label for="kelas" class="form-label">Kelas <span class="text-danger">*</span></label>
                           <div class="row">
                              <div class="col-md-3">
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
                                       @if (old('tingkatan_kelas') == $t)
                                          <option value="{{ $t }}" selected>{{ $romawiTingkat }}</option>
                                       @else
                                          <option value="{{ $t }}">{{ $romawiTingkat }}</option>
                                       @endif
                                    @endforeach
                                 </select>
                              </div>
                              <div class="col-md-3">

                                 <select class="form-control" name="jurusan_kelas" id="kelas">
                                    <option disabled selected>Select Jurusan</option>
                                    @foreach ($jurusan as $j)
                                       @if (old('jurusan_kelas') == $j)
                                          <option value="{{ $j }}" selected>{{ $j }}</option>
                                       @else
                                          <option value="{{ $j }}">{{ $j }}</option>
                                       @endif
                                    @endforeach
                                 </select>
                              </div>
                              <div class="col-md-3">

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
                              <input type="hidden" name="kelas" value="A">

                           </div>
                        </div>



                        <div class="mb-3">
                           <label for="kelas" class="form-label">Jenis Kelamin <span
                                 class="text-danger">*</span></label>

                           <div class="row">
                              <div class="col-lg-6">
                                 <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                    <option disabled selected>Pilih jenis kelamin</option>

                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                                       Laki-laki
                                    </option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                                       Perempuan</option>
                                 </select>
                              </div>
                           </div>
                        </div>

                        <div class="mb-3">
                           <div class="row">
                              <div class="col-lg-12">
                                 <label for="keterangan" class="form-label">Keterangan <span
                                       class="text-danger">*</span></label>
                                 <textarea
                                    class="form-control @error('keterangan')
                                   is-invalid border-danger
                                @enderror"
                                    id="keterangan" name="keterangan" value="{{ old('keterangan') }}"
                                    rows="5">{{ old('keterangan') }}</textarea>
                                 @error('keterangan')
                                    <div class="invalid-feedback">
                                       {{ $message }}
                                    </div>
                                 @enderror
                              </div>
                           </div>
                        </div>


                        <input type="hidden" name="pelapor_id" value="0">
                        <input type="hidden" name="nama_pelapor" value="A">
                        <input type="hidden" name="role_pelapor" value="A">
                        <input type="hidden" name="email_pelapor" value="A">
                        <input type="hidden" name="username_pelapor" value="A">

                        <input type="hidden" name="email_pelaku" value="A">
                        <input type="hidden" name="username_pelaku" value="A">
                        <input type="hidden" name="user_id" value="0">


                        <div class="text-lg-end bi-text-right">
                        </div>

                        <div class="row d-flex justify-content-end">
                           <div class="col-md-2">
                              <button type="submit" class="btn btn-primary px-5">Simpan</button>

                           </div>
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
