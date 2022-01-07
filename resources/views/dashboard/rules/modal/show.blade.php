<!-- Modal -->

<div class="modal fade text-left" id="showRule{{ $rule->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
   tabindex="-1" aria-labelledby="showRule{{ $rule->id }}Label" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="showRule{{ $rule->id }}Label">{{ __('Rule Detail') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <h4 class="{{ $rule->data_type == 1 ? 'text-primary' : 'text-danger' }}">
               {{ $rule->data_type == 1 ? 'Penghargaan' : 'Pelanggaran' }}</h4>
            <div class="card mb-3">
               <div class="card-body" style="font-size: 16px">
                  {{-- <h3 class="card-title">{{ $student->nama }}</h4> --}}
                  <div class="mb-3 row">
                     <div class="col-md-3">
                        <label for="staticEmail" class="col-form-label">Keterangan</label>

                     </div>
                     <div class="col-md-1 mt-1">
                        <label>:</label>
                     </div>
                     <div class="col-md-8">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                           value="{{ $rule->keterangan }}">
                     </div>
                  </div>

                  <div class="mb-3 row">
                     <div class="col-md-3">
                        <label for="staticEmail" class="col-form-label">Jenis</label>
                     </div>
                     <div class="col-md-1 mt-1">
                        <label>:</label>
                     </div>
                     <div class="col-md-8">
                        <input type="text" readonly
                           class="form-control-plaintext {{ $rule->jenis == 'ringan' ? 'text-success' : 'text-danger' }}"
                           id="staticEmail" value="{{ $rule->jenis }}">
                     </div>
                  </div>
                  <div class="mb-3 row">
                     <div class="col-md-3">
                        <label for="staticEmail" class="col-form-label">Besar Point</label>
                     </div>
                     <div class="col-md-1 mt-1">
                        <label>:</label>
                     </div>
                     <div class="col-md-8">
                        <input type="text" readonly
                           class="form-control-plaintext @if ($rule->point >= 70)
                        text-danger
                     @else
                        text-success
                     @endif"
                           id="staticEmail" value="{{ $rule->point }}">
                     </div>
                  </div>

                  <div class="mb-3 row">
                     <div class="col-md-3">
                        <label for="staticEmail" class="col-form-label">Updated</label>
                     </div>
                     <div class="col-md-1 mt-1">
                        <label>:</label>
                     </div>
                     <div class="col-md-8">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                           value="{{ $rule->created_at->diffForHumans() }}">
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
