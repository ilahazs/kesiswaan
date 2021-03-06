<!-- Modal -->

<div class="modal fade text-left" id="tambahGuru" data-backdrop="static" data-keyboard="false" tabindex="-1"
   aria-labelledby="tambahGuruLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="tambahGuruLabel">{{ __('Tambah Data Waka') }}
            </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="card shadow-sm">
               <div class="card-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <form method="POST" action="{{ route('teachers.store') }}">
                           @csrf
                           <div class="mb-3 row">
                              <div class="col-md-5">
                                 <label for="nama" class="col-form-label">Nama</label>

                              </div>
                              <div class="col-md-1 mt-1">
                                 <label>:</label>
                              </div>
                              <div class="col-md-6">
                                 <input type="text"
                                    class="form-control  @error('nama')
                                 is-invalid
                              @enderror"
                                    id="nama" value="{{ old('nama') }}" name="nama">
                                 @error('nama')
                                    <div class="invalid-feedback">
                                       {{ $message }}
                                    </div>
                                 @enderror
                              </div>
                           </div>

                           <div class="mb-3 row">
                              <div class="col-md-5">
                                 <label for="nip" class="col-form-label">NIP</label>

                              </div>
                              <div class="col-md-1 mt-1">
                                 <label>:</label>
                              </div>
                              <div class="col-md-6">
                                 <input type="text"
                                    class="form-control  @error('nip')
                                 is-invalid
                              @enderror"
                                    name="nip" id="nip" value="{{ old('nip') }}">
                                 @error('nip')
                                    <div class="invalid-feedback">
                                       {{ $message }}
                                    </div>
                                 @enderror
                              </div>
                           </div>

                           <div class="mb-3">
                              <div class="row">
                                 <div class="col-md-3"><label for="kelas" class="form-label">Kelas</label>
                                 </div>
                                 <div class="col-md-3">
                                    <select class="form-control" name="tingkatan_kelas" id="kelas">
                                       <option disabled selected>Pilih Tingkatan</option>
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
                                             <option value="{{ $t }}" selected>{{ $romawiTingkat }}
                                             </option>
                                          @else
                                             <option value="{{ $t }}">{{ $romawiTingkat }}</option>
                                          @endif
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="col-md-3">

                                    <select class="form-control" name="jurusan_kelas" id="kelas">
                                       <option disabled selected>Pilih Jurusan</option>
                                       @foreach ($jurusan as $j)
                                          @if (old('jurusan_kelas') === $j)
                                             <option value="{{ $j }}" selected>{{ $j }}</option>
                                          @else
                                             <option value="{{ $j }}">{{ $j }}</option>
                                          @endif
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="col-md-3">

                                    <select class="form-control" name="urutan_kelas" id="kelas">
                                       <option disabled selected>Pilih Urutan</option>
                                       @foreach ($urutan as $u)
                                          @if (old('urutan_kelas') == $u)
                                             <option value="{{ $u }}" selected>{{ $u }}</option>
                                          @else
                                             <option value="{{ $u }}">{{ $u }}</option>
                                          @endif

                                       @endforeach
                                    </select>
                                 </div>

                              </div>
                           </div>
                           <input type="hidden" name="class_id" value="0">


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
