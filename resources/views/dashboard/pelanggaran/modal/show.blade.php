<!-- Modal -->

<div class="modal fade text-left" id="showPelanggaran{{ $pelanggaran->id }}" data-backdrop="static"
   data-keyboard="false" tabindex="-1" aria-labelledby="showPelanggaran{{ $pelanggaran->id }}Label"
   aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="showPelanggaran{{ $pelanggaran->id }}Label">{{ __('Detail Pelanggaran') }}
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
                        {{-- <h3 class="card-title">{{ $student->nama }}</h4> --}}

                        <div class="mb-3 row">
                           <div class="col-md-5">
                              <label for="staticEmail" class="col-form-label">Nama</label>
                           </div>
                           <div class="col-md-1 mt-1">
                              <label>:</label>
                           </div>
                           <div class="col-md-6">
                              <input type="text" disabled readonly class="form-control bg-white" id="staticEmail"
                                 value="{{ $pelanggaran->nama }}">
                           </div>
                        </div>
                        <div class="mb-3 row">
                           <div class="col-md-5">
                              <label for="jenis" class="col-form-label">Jenis</label>
                           </div>
                           <div class="col-md-1 mt-1">
                              <label>:</label>
                           </div>
                           <div class="col-md-6">
                              <input type="text" disabled readonly class="form-control bg-white" id="jenis"
                                 value="{{ $pelanggaran->klasifikasi->jenis }}">
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
                              <input type="text" disabled readonly class="form-control bg-white text-success" id="poin"
                                 value="{{ $pelanggaran->klasifikasi->poin }}">
                           </div>
                        </div>

                        <div class="mb-3 row">
                           <div class="col-md-5">
                              <label for="staticEmail" class="col-form-label">Keterangan</label>
                           </div>
                           <div class="col-md-1 mt-1">
                              <label>:</label>
                           </div>
                           <div class="col-md-6">
                              {{-- <input type="text" disabled readonly class="form-control bg-white " id="staticEmail" value="{{ $pelanggaran->keterangan }}"> --}}

                              <textarea disabled readonly class="form-control bg-white" id="keterangan"
                                 value="{{ $pelanggaran->keterangan }}"
                                 rows="4">{{ $pelanggaran->keterangan }}</textarea>

                           </div>
                        </div>

                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="modal-footer">
            <button type="button" class="btn btn-success" id="inside-show" data-dismiss="modal" data-toggle="modal"
               data-target="#editPelanggaran{{ $pelanggaran->id }}">Edit This</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
