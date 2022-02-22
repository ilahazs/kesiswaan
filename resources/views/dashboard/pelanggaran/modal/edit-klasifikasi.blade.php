<!-- Modal -->

<div class="modal fade text-left" id="editKlasifikasi{{ $k->id }}" data-backdrop="static" data-keyboard="false"
   tabindex="-1" aria-labelledby="editKlasifikasi{{ $k->id }}Label" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="editKlasifikasi{{ $k->id }}Label">{{ __('Edit Klasifikasi') }}
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
                        <form method="POST" action="{{ route('klasifikasi-pelanggaran.update', $k->id) }}">
                           @csrf
                           @method('put')
                           <div class="mb-3">
                              <div class="row">
                                 <div class="col-lg-6">
                                    <label for="jenis" class="form-label">Jenis</label>

                                 </div>
                                 <div class="col-lg-6">
                                    <label for="poin" class="form-label">Poin</label>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-6">
                                    <input type="text"
                                       class="form-control @error('jenis')
                                 is-invalid
                              @enderror"
                                       id="jenis" name="jenis" value="{{ old('jenis', $k->jenis) }}">
                                    @error('jenis')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                                 <div class="col-lg-6">
                                    <input type="number" class="form-control @error('poin') is-invalid @enderror"
                                       id="poin" name="poin" value="{{ old('poin', $k->poin) }}">
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
