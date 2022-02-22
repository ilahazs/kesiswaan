<!-- Modal -->

<div class="modal fade text-left" id="showKlasifikasi{{ $k->id }}" data-backdrop="static" data-keyboard="false"
   tabindex="-1" aria-labelledby="showKlasifikasi{{ $k->id }}Label" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="showKlasifikasi{{ $k->id }}Label">{{ __('Detail Klasifikasi') }}
            </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12">
                  <div class="card shadow-sm mb-3 px-0 py-0">
                     <div class="card-body" style="font-size: 16px">
                        {{-- <h3 class="card-title">{{ $student->nama }}</h4> --}}

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
                                 <input type="text" disabled readonly class="form-control bg-white" id="jenis"
                                    name="jenis" value="{{ $k->jenis }}">
                              </div>
                              <div class="col-lg-6">
                                 <input type="number" disabled readonly class="form-control bg-white" id="poin"
                                    name="poin" value="{{ $k->poin }}">
                              </div>

                           </div>

                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="modal-footer">
               <button type="button" class="btn btn-success" id="inside-show" data-dismiss="modal" data-toggle="modal"
                  data-target="#editKlasifikasi{{ $k->id }}">Edit This</button>
               <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   {{-- <script>
      $('#inside-show').click(function() {
         $("#showKlasifikasi" +
            @php
            $k->id;
            @endphp).modal('hide');
         $("#editKlasifikasi" +
            @php
            $k->id;
            @endphp).modal('show');
      });
   </script> --}}
