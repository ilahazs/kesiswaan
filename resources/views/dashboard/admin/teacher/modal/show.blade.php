<!-- Modal -->

<div class="modal fade text-left" id="showTeacher{{ $teacher->id }}" data-backdrop="static" data-keyboard="false"
   tabindex="-1" aria-labelledby="showTeacher{{ $teacher->id }}Label" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="showTeacher{{ $teacher->id }}Label">{{ __('Detail Data') }}
            </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="card shadow-sm px-0 py-0">
               <div class="card-body" style="font-size: 16px">
                  {{-- <h3 class="card-title">{{ $teacher->nama }}</h4> --}}
                  <div class="mb-3 row">
                     <div class="col-md-5">
                        <label for="staticEmail" class="col-form-label">Nama</label>

                     </div>
                     <div class="col-md-1 mt-1">
                        <label>:</label>
                     </div>
                     <div class="col-md-6">
                        <input type="text" disabled readonly class="form-control bg-white" id="staticEmail"
                           value="{{ $teacher->nama }}">
                     </div>
                  </div>

                  <div class="mb-3 row">
                     <div class="col-md-5">
                        <label for="staticEmail" class="col-form-label">NIP</label>

                     </div>
                     <div class="col-md-1 mt-1">
                        <label>:</label>
                     </div>
                     <div class="col-md-6">
                        <input type="text" disabled readonly class="form-control bg-white" id="staticEmail"
                           value="{{ $teacher->nip }}">
                     </div>
                  </div>

                  <div class="mb-3 row">
                     <div class="col-md-5">
                        <label for="staticEmail" class="col-form-label">Kelas</label>
                     </div>
                     <div class="col-md-1 mt-1">
                        <label>:</label>
                     </div>
                     <div class="col-md-6">
                        <input type="text" disabled readonly class="form-control bg-white" id="staticEmail"
                           value="{{ $concatKelas }}">
                     </div>
                  </div>
                  {{-- <div class="mb-3 row">
                     <div class="col-md-5">
                        <label for="staticEmail" class="col-form-label">Email</label>
                     </div>
                     <div class="col-md-1 mt-1">
                        <label>:</label>
                     </div>
                     <div class="col-md-6">
                        <input type="text" disabled readonly class="form-control bg-white" id="staticEmail"
                           value="{{ $teacher->email }}">
                     </div>
                  </div> --}}
                  <div class="mb-3 row">
                     <div class="col-md-5">
                        <label for="staticEmail" class="col-form-label">Updated</label>
                     </div>
                     <div class="col-md-1 mt-1">
                        <label>:</label>
                     </div>
                     <div class="col-md-6">
                        <input type="text" disabled readonly class="form-control bg-white" id="staticEmail"
                           value="{{ $teacher->created_at->diffForHumans() }}">
                     </div>
                  </div>
               </div>

            </div>


         </div>

         <div class="modal-footer">
            <button type="button" class="btn btn-success" id="inside-show" data-dismiss="modal" data-toggle="modal"
               data-target="#editTeacher{{ $teacher->id }}">Edit This</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
