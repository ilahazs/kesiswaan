<!-- Modal -->

<div class="modal fade text-left" id="DetailPelanggaran{{ $pelanggaran->id }}" data-bs-backdrop="static"
   data-bs-keyboard="false" tabindex="-1" aria-labelledby="DetailPelanggaran{{ $pelanggaran->id }}Label"
   aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="DetailPelanggaran{{ $pelanggaran->id }}Label">
               {{ __('Detail Rekap Siswa') }}
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                              <label for="staticEmail" class="col-form-label">Poin</label>
                           </div>
                           <div class="col-md-1 mt-1">
                              <label>:</label>
                           </div>
                           <div class="col-md-6">
                              <input type="text" disabled readonly class="form-control bg-white {{ $colorPoint }}"
                                 id="staticEmail" value="{{ $pelanggaran->klasifikasi->poin }}">
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
                              <input type="text" disabled readonly class="form-control bg-white " id="staticEmail"
                                 value="{{ $pelanggaran->keterangan }}">
                           </div>
                        </div>
                        <div class="mb-3 row">
                           <div class="col-md-5">
                              <label for="staticEmail" class="col-form-label">Terjadi</label>
                           </div>
                           <div class="col-md-1 mt-1">
                              <label>:</label>
                           </div>
                           <div class="col-md-6">
                              <input type="text" disabled readonly class="form-control bg-white " id="staticEmail"
                                 value="{{ $pelanggaran->created_at->diffForHumans() }}">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>


         </div>

         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
