<!-- Modal -->

<div class="modal fade text-left" id="createKlasifikasi" data-backdrop="static" data-keyboard="false" tabindex="-1"
   aria-labelledby="createKlasifikasiLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="createKlasifikasiLabel">{{ __('Buat Klasifikasi Baru') }}
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
                        <form method="POST" action="{{ route('klasifikasi-penghargaan.store') }}">
                           @csrf
                           <div class="mb-3">
                              <div class="row">
                                 <div class="col-lg-6">
                                    <label for="nama" class="form-label">Tingkatan</label>

                                 </div>
                                 <div class="col-lg-6">
                                    <label for="nis" class="form-label">Poin</label>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-6">
                                    <input type="text"
                                       class="form-control @error('tingkatan')
                                 is-invalid
                              @enderror"
                                       id="tingkatan" name="tingkatan" value="{{ old('tingkatan') }}">
                                    @error('tingkatan')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                                 <div class="col-lg-6">
                                    <input type="number" class="form-control @error('poin') is-invalid @enderror"
                                       id="poin" name="poin" value="{{ old('poin') }}">
                                    @error('poin')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>

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
