<!-- Modal -->

<div class="modal fade text-left" id="showDataStudent{{ $student->id }}" data-backdrop="static" data-keyboard="false"
   tabindex="-1" aria-labelledby="showDataStudent{{ $student->id }}Label" aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="showDataStudent{{ $student->id }}Label">{{ __('Detail Rekap Siswa') }}
            </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <h4>
               {{ $student->nama }}</h4>
            <div class="row">
               <div class="col-md-6">
                  <div class="card shadow-sm mb-3 px-0 py-0">
                     <div class="card-body" style="font-size: 16px">
                        {{-- <h3 class="card-title">{{ $student->nama }}</h4> --}}
                        <div class="mb-3 row">
                           <div class="col-md-5">
                              <label for="staticEmail" class="col-form-label">NIS</label>

                           </div>
                           <div class="col-md-1 mt-1">
                              <label>:</label>
                           </div>
                           <div class="col-md-6">
                              <input type="text" disabled readonly class="form-control bg-white" id="staticEmail"
                                 value="{{ $student->nis }}">
                           </div>
                        </div>

                        <div class="mb-3 row">
                           <div class="col-md-5">
                              <label for="staticEmail" class="col-form-label">Jenis Kelamin</label>
                           </div>
                           <div class="col-md-1 mt-1">
                              <label>:</label>
                           </div>
                           <div class="col-md-6">
                              <input type="text" disabled readonly class="form-control bg-white" id="staticEmail"
                                 value="{{ $student->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}">
                           </div>
                        </div>
                        <div class="mb-3 row">
                           <div class="col-md-5">
                              <label for="staticEmail" class="col-form-label">Total Poin</label>
                           </div>
                           <div class="col-md-1 mt-1">
                              <label>:</label>
                           </div>
                           <div class="col-md-6">
                              <input type="text" disabled readonly class="form-control bg-white {{ $colorPoint }}"
                                 id="staticEmail" value="{{ $student->poin_pelanggaran }}">
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

                           <div class="col-md-5">
                              <label for="staticEmail" class="col-form-label">Kelas</label>
                           </div>
                           <div class="col-md-1 mt-1">
                              <label>:</label>
                           </div>
                           <div class="col-md-6">
                              <input type="text" disabled readonly class="form-control bg-white " id="staticEmail"
                                 value="{{ $concatKelas }}">
                           </div>
                        </div>

                        <div class="mb-3 row">
                           <div class="col-md-5">
                              <label for="staticEmail" class="col-form-label">Updated</label>
                           </div>
                           <div class="col-md-1 mt-1">
                              <label>:</label>
                           </div>
                           <div class="col-md-6">
                              <input type="text" disabled readonly class="form-control bg-white" id="staticEmail"
                                 value="{{ $student->created_at->diffForHumans() }}">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="card shadow-sm mb-3">
                     <div class="card-body" style="font-size: 16px">
                        <ul class="list-group">
                           @forelse ($student->pelanggarans as $pelanggaran)
                              @php
                                 $jenis = '';
                                 $color = '';
                                 
                                 if ($pelanggaran->klasifikasi->poin <= 20) {
                                     $color = 'success';
                                     $jenis = 'ringan';
                                 } elseif ($pelanggaran->klasifikasi->poin <= 30 && $pelanggaran->klasifikasi->poin >= 21) {
                                     $color = 'warning';
                                     $jenis = 'sedang';
                                 } elseif ($pelanggaran->klasifikasi->poin <= 50 && $pelanggaran->klasifikasi->poin >= 31) {
                                     $color = 'danger';
                                     $jenis = 'berat';
                                 } else {
                                     $color = 'secondary';
                                     $jenis = 'error';
                                 }
                              @endphp
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 {{ $pelanggaran->nama }}
                                 <div class="justify-content-end">
                                    <span
                                       class="badge bg-secondary badge-pill my-1 text-white">{{ $student->updated_at->diffForHumans() }}</span>
                                    <span
                                       class="badge bg-{{ $color }} badge-pill my-1 text-white">{{ $pelanggaran->klasifikasi->poin }}</span>
                                 </div>
                              </li>
                           @empty
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Anda Siswa teladan!
                                 <span class="badge bg-success badge-pill my-1 text-white">kosong</span>
                              </li>
                           @endforelse
                        </ul>
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
