<!-- Modal -->

<div class="modal fade text-left" id="editLaporan{{ $laporan->id }}" data-backdrop="static" data-keyboard="false"
   tabindex="-1" aria-labelledby="editLaporan{{ $laporan->id }}Label" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="editLaporan{{ $laporan->id }}Label">{{ __('Edit Pelanggaran') }}
            </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12">
                  <div class="card shadow-sm px-0 py-0">
                     <form action="{{ route('laporan.update', $laporan->id) }}" method="POST">
                        @csrf
                        @method('put')

                        <div class="card-body" style="font-size: 16px">
                           {{-- <h3 class="card-title">{{ $student->nama }}</h4> --}}

                           <div class="mb-3 row">
                              <div class="col-md-5">
                                 <label for="staticEmail" class="col-form-label">Nama Pelaku</label>
                              </div>
                              <div class="col-md-1 mt-1">
                                 <label>:</label>
                              </div>
                              <div class="col-md-6">
                                 <input type="text" class="form-control bg-white" id="staticEmail"
                                    value="{{ old('nama_pelaku', $laporan->nama_pelaku) }}" name="nama_pelaku">
                              </div>
                           </div>
                           <div class="mb-3 row">
                              <div class="col-md-5">
                                 <label for="jenis" class="col-form-label">NIS</label>
                              </div>
                              <div class="col-md-1 mt-1">
                                 <label>:</label>
                              </div>
                              <div class="col-md-6">
                                 <input type="text" class="form-control bg-white" id="jenis"
                                    value="{{ old('nis_pelaku', $laporan->nis_pelaku) }}" name="nis_pelaku">
                              </div>
                           </div>

                           <div class="mb-3 row">
                              <div class="col-md-5">
                                 <label for="poin" class="col-form-label">Email</label>
                              </div>
                              <div class="col-md-1 mt-1">
                                 <label>:</label>
                              </div>
                              <div class="col-md-6">
                                 <input type="text" class="form-control bg-white" id="poin"
                                    value="{{ old('email_pelaku', $laporan->email_pelaku) }}" name="email_pelaku">
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
                                 {{-- <input type="text" disabled readonly class="form-control bg-white " id="staticEmail" value="{{ $laporan->keterangan }}"> --}}

                                 <textarea class="form-control bg-white" id="keterangan"
                                    value="{{ old('keterangan', $laporan->keterangan) }}" name="keterangan"
                                    rows="4">{{ old('keterangan', $laporan->keterangan) }}</textarea>

                              </div>
                           </div>

                           <div class="mb-3 row">
                              <div class="col-md-5">
                                 <label for="poin" class="col-form-label">Nama Pelapor</label>
                              </div>
                              <div class="col-md-1 mt-1">
                                 <label>:</label>
                              </div>
                              <div class="col-md-6">
                                 <input type="text" disabled readonly class="form-control bg-white" id="poin"
                                    value="{{ $laporan->nama_pelapor }}">
                              </div>
                           </div>

                           <div class="mb-3 row">
                              <div class="col-md-5">
                                 <label for="poin" class="col-form-label">Role Pelapor</label>
                              </div>
                              <div class="col-md-1 mt-1">
                                 <label>:</label>
                              </div>
                              <div class="col-md-6">
                                 <input type="text" disabled readonly class="form-control bg-white" id="poin"
                                    value="{{ $laporan->role_pelapor }}">
                              </div>
                           </div>
                           <div class="mb-3 row">
                              <div class="col-md-5">
                                 <label for="poin" class="col-form-label">Email Pelapor</label>
                              </div>
                              <div class="col-md-1 mt-1">
                                 <label>:</label>
                              </div>
                              <div class="col-md-6">
                                 <input type="text" disabled readonly class="form-control bg-white" id="poin"
                                    value="{{ $laporan->email_pelapor }}">
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
