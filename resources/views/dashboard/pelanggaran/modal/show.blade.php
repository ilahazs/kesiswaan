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
            <h4>
               {{ $pelanggaran->nama }}</h4>
            <div class="row">
               <div class="col-md-12">
                  <div class="card mb-3 px-0 py-0">
                     <div class="card-body" style="font-size: 16px">
                        {{-- <h3 class="card-title">{{ $student->nama }}</h4> --}}

                        <div class="mb-3 row">
                           <div class="col-md-2">
                              <label for="staticEmail" class="col-form-label">Nama</label>
                           </div>
                           <div class="col-md-1 mt-1">
                              <label>:</label>
                           </div>
                           <div class="col-md-9">
                              <input type="text" disabled readonly class="form-control bg-white" id="staticEmail"
                                 value="{{ $pelanggaran->nama }}">
                           </div>
                        </div>
                        <div class="mb-3 row d-flex justify-content-between">
                           <div class="col-lg-5">
                              <div class="row">
                                 <div class="col-md-5">
                                    <label for="staticEmail" class="col-form-label">Jenis</label>
                                 </div>
                                 <div class="col-md-1 mt-1">
                                    <label>:</label>
                                 </div>
                                 <div class="col-md-6">
                                    <input type="text" disabled readonly class="form-control bg-white" id="staticEmail"
                                       value="{{ $jenis }}">
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-5">
                              <div class="row">
                                 <div class="col-md-5">
                                    <label for="staticEmail" class="col-form-label">Poin</label>
                                 </div>
                                 <div class="col-md-1 mt-1">
                                    <label>:</label>
                                 </div>
                                 <div class="col-md-6">
                                    <input type="text" disabled readonly
                                       class="form-control bg-white {{ $colorPoint }}" id="staticEmail"
                                       value="{{ $pelanggaran->poin }}">
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="mb-3 row">
                           <div class="col-md-2">
                              <label for="staticEmail" class="col-form-label">Keterangan</label>
                           </div>
                           <div class="col-md-1 mt-1">
                              <label>:</label>
                           </div>
                           <div class="col-md-9">
                              {{-- <input type="text" disabled readonly class="form-control bg-white " id="staticEmail" value="{{ $pelanggaran->keterangan }}"> --}}

                              <textarea disabled readonly class="form-control bg-white" id="keterangan"
                                 value="{{ $pelanggaran->keterangan }}"
                                 rows="3">{{ $pelanggaran->keterangan }}</textarea>

                           </div>
                        </div>

                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
