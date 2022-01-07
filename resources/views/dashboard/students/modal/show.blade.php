<!-- Modal -->

<div class="modal fade text-left" id="showStudent{{ $student->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
   tabindex="-1" aria-labelledby="showStudent{{ $student->id }}Label" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="showStudent{{ $student->id }}Label">{{ __('Student Detail') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <h4>{{ $student->nama }}</h4>
            <div class="card mb-3">
               <div class="card-body" style="font-size: 16px">
                  {{-- <h3 class="card-title">{{ $student->nama }}</h4> --}}
                  <div class="mb-3 row">
                     <div class="col-md-3">
                        <label for="staticEmail" class="col-form-label">NIS</label>

                     </div>
                     <div class="col-md-1 mt-1">
                        <label>:</label>
                     </div>
                     <div class="col-md-8">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                           value="{{ $student->nis }}">
                     </div>
                  </div>

                  <div class="mb-3 row">
                     <div class="col-md-3">
                        <label for="staticEmail" class="col-form-label">Jenis Kelamin</label>
                     </div>
                     <div class="col-md-1 mt-1">
                        <label>:</label>
                     </div>
                     <div class="col-md-8">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                           value="{{ $student->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}">
                     </div>
                  </div>
                  <div class="mb-3 row">
                     <div class="col-md-3">
                        <label for="staticEmail" class="col-form-label">MyPoint</label>
                     </div>
                     <div class="col-md-1 mt-1">
                        <label>:</label>
                     </div>
                     <div class="col-md-8">
                        <input type="text" readonly
                           class="form-control-plaintext @if ($student->point >= 70)
                        text-success
                     @else
                        text-danger
                     @endif"
                           id="staticEmail" value="{{ $student->point }}">
                     </div>
                  </div>
                  <div class="mb-3 row">
                     @php
                        $romawiTingkatan = '';
                        switch ($student->kelas->tingkatan) {
                            case '10':
                                $romawiTingkatan = 'X';
                                break;
                            case '11':
                                $romawiTingkatan = 'XI';
                                break;
                            case '12':
                                $romawiTingkatan = 'XII';
                                break;
                            default:
                                $romawiTingkatan = 'None';
                                break;
                        }
                        $concatKelas = $romawiTingkatan . ' ' . $student->kelas->jurusan . ' ' . $student->kelas->nama;
                        
                     @endphp

                     <div class="col-md-3">
                        <label for="staticEmail" class="col-form-label">Kelas</label>
                     </div>
                     <div class="col-md-1 mt-1">
                        <label>:</label>
                     </div>
                     <div class="col-md-8">
                        <input type="text" readonly class="form-control-plaintext " id="staticEmail"
                           value="{{ $concatKelas }}">
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
                           value="{{ $student->created_at->diffForHumans() }}">
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
