<!-- Modal -->

<div class="modal fade text-left" id="editPenghargaan{{ $penghargaan->id }}" data-backdrop="static"
   data-keyboard="false" tabindex="-1" aria-labelledby="editPenghargaan{{ $penghargaan->id }}Label"
   aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="editPenghargaan{{ $penghargaan->id }}Label">{{ __('Edit Pelanggaran') }}
            </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12">
                  <div class="card shadow-sm px-0 py-0">
                     <div class="card-body" style="font-size: 16px">
                        <div class="row mb-2">
                           <div class="col-lg-12">
                              <form action="{{ route('penghargaan.update', $penghargaan->id) }}" method="POST">
                                 @csrf
                                 @method('put')

                                 <div class="mb-3 row">
                                    <div class="col-md-5">
                                       <label for="staticEmail" class="col-form-label">Nama</label>
                                    </div>
                                    <div class="col-md-1 mt-1">
                                       <label>:</label>
                                    </div>
                                    <div class="col-md-6">
                                       <input type="text"
                                          class="form-control bg-white  @error('nama')
                              is-invalid
                           @enderror"
                                          name="nama" id="staticEmail" value="{{ old('nama', $penghargaan->nama) }}">
                                       @error('nama')
                                          <div class="invalid-feedback">
                                             {{ $message }}
                                          </div>
                                       @enderror
                                    </div>
                                 </div>
                                 <div class="mb-3 row">
                                    <div class="col-md-5">
                                       <label for="jenis" class="col-form-label">Tingkatan</label>
                                    </div>
                                    <div class="col-md-1 mt-1">
                                       <label>:</label>
                                    </div>
                                    <div class="col-md-6">
                                       <select class="form-control" name="tingkatan" id="jenis">
                                          <option disabled selected>Select Jenis</option>
                                          @foreach ($jenisKlasifikasi as $j)
                                             @if (old('jenis', $penghargaan->klasifikasi->tingkatan) === $j->tingkatan)
                                                <option value="{{ $j->tingkatan }}" selected>{{ $j->tingkatan }}
                                                </option>
                                             @else
                                                <option value="{{ $j->tingkatan }}">{{ $j->tingkatan }}</option>
                                             @endif
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>


                                 <div class="mb-3 row">
                                    <div class="col-md-5">
                                       <label for="poin" class="col-form-label">Poin</label>
                                    </div>
                                    <div class="col-md-1 mt-1">
                                       <label>:</label>
                                    </div>
                                    <div class="col-md-6">
                                       <select class="form-control" name="poin" id="poin">
                                          <option disabled selected>Keterangan Poin</option>
                                          @foreach ($jenisKlasifikasi as $j)
                                             @if (old('poin', $penghargaan->poin) === $j->poin)
                                                <option value="{{ $j->poin }}" selected>
                                                   {{ $j->tingkatan . ' ⟶ : ' . $j->poin }}
                                                </option>
                                             @else
                                                <option value="{{ $j->poin }}">
                                                   {{ $j->tingkatan . ' ⟶ : ' . $j->poin }}</option>
                                             @endif
                                          @endforeach
                                       </select>
                                    </div>
                                    <input type="hidden" name="poin" value="{{ $j->poin }}">
                                 </div>

                                 <div class="mb-3 row">
                                    <div class="col-md-5">
                                       <label for="staticEmail" class="col-form-label">Keterangan</label>
                                    </div>
                                    <div class="col-md-1 mt-1">
                                       <label>:</label>
                                    </div>
                                    <div class="col-md-6">
                                       {{-- <input type="text" class="form-control bg-white " id="staticEmail" value="{{ $penghargaan->keterangan }}"> --}}

                                       <textarea class="form-control bg-white" id="keterangan" name="keterangan"
                                          value="{{ $penghargaan->keterangan }}"
                                          rows="4">{{ old('keterangan', $penghargaan->keterangan) }}</textarea>

                                    </div>
                                 </div>

                                 <input type="hidden" name="klasifikasi_id" value="0">

                           </div>
                        </div>

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
