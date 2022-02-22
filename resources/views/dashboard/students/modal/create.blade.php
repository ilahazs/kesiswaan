<!-- Modal -->

<div class="modal fade text-left" id="createDataStudent" data-backdrop="static" data-keyboard="false" tabindex="-1"
   aria-labelledby="createDataStudentLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="createDataStudentLabel">{{ __('Buat Siswa Baru') }}
            </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="card shadow-sm">
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
                                    <input type="number" class="form-control @error('nis') is-invalid @enderror"
                                       id="nis" name="nis" value="{{ old('nis') }}">
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
                                             <option value="{{ $t }}" selected>{{ $romawiTingkat }}
                                             </option>
                                          @else
                                             <option value="{{ $t }}">{{ $romawiTingkat }}</option>
                                          @endif
                                       @endforeach
                                    </select>

                                    @error('tingkatan_kelas')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
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
                                    @error('jurusan_kelas')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
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
                                    @error('urutan_kelas')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>

                                 <input type="hidden" name="class_id" value="0">
                                 <input type="hidden" name="user_id" value="0">

                              </div>
                           </div>


                           {{-- <div class="mb-3">
                              <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                              <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                 <option disabled selected>Pilih jenis kelamin</option>

                                 <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki
                                 </option>
                                 <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                              </select>


                              <div class="mb-3">
                                 <label for="" class="form-label"></label>

                              </div>
                           </div> --}}



                           <div class="mb-3">
                              <div class="row">
                                 <div class="col-lg-6">
                                    <label for="kelas" class="form-label">Jenis Kelamin</label>


                                 </div>
                                 <div class="col-lg-6">
                                    <label for="notelp" class="form-label">No. Telp</label>
                                 </div>
                              </div>
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
                                 <div class="col-lg-6">
                                    <input type="text" class="form-control @error('notelp') is-invalid @enderror"
                                       id="notelp" name="notelp" value="{{ old('notelp') }}">
                                    @error('notelp')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>

                              </div>

                           </div>


                           <input type="hidden" name="point" value="100">

                     </div>
                  </div>
               </div>
            </div>


         </div>

         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>

         </div>
         </form>
      </div>
   </div>
</div>


@if (!empty($errors))
   <script>
      $(function() {
         $('#createDataStudent').modal('show');
      });
   </script>
@endif
