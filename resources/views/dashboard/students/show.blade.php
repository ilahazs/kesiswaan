@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('students.index') }}" class="text-decoration-none">Semua Siswa</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      {{ $title }}
   </li>
@endsection
@section('container')

   <div class="row">
      <div class="col-md-6">
         <div class="card shadow-sm px-0 py-0">
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
                        value="{{ $student->nama }}">
                  </div>
               </div>
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
                     <label for="staticEmail" class="col-form-label">Poin</label>
                  </div>
                  <div class="col-md-1 mt-1">
                     <label>:</label>
                  </div>
                  <div class="col-md-6">
                     <input type="text" disabled readonly
                        class="form-control bg-white 
                     {{ $student->poin_total >= 3000 ? 'text-success' : 'text-warning' }}"
                        id="staticEmail" value="{{ $student->poin_total }}">
                  </div>
               </div>
               <div class="mb-3 row">
                  <div class="col-md-5">
                     <label for="staticEmail" class="col-form-label">Poin Pelanggaran</label>
                  </div>
                  <div class="col-md-1 mt-1">
                     <label>:</label>
                  </div>
                  <div class="col-md-6">
                     <input type="text" disabled readonly class="form-control bg-white {{ $colorPelanggaran }}"
                        id="staticEmail" value="{{ $student->poin_pelanggaran }}">
                  </div>
               </div>
               <div class="mb-3 row">
                  <div class="col-md-5">
                     <label for="staticEmail" class="col-form-label">Poin Penghargaan</label>
                  </div>
                  <div class="col-md-1 mt-1">
                     <label>:</label>
                  </div>
                  <div class="col-md-6">
                     <input type="text" disabled readonly class="form-control bg-white {{ $colorPenghargaan }}"
                        id="staticEmail" value="{{ $student->poin_penghargaan }}">
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
            <div class="card-header">
               <div class="row d-flex justify-content-start">
                  <div class="col-lg-4">
                     Pelanggaran
                  </div>
                  <div class="col-lg-8 d-flex justify-content-end">

                     <div>
                        <a href="{{ route('pelanggaran.students.edit', $student->nis) }}"
                           class="badge bg-success text-decoration-none text-white mx-1 py-2">
                           <i class="las la-plus"
                              style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                        </a>
                        <a href="{{ route('pelanggaran.students.dismiss', $student->nis) }}"
                           class="badge bg-danger text-decoration-none text-white me-1 py-2">
                           <i class="las la-minus"
                              style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card-body" style="font-size: 16px">
               <ul class="list-group">
                  @forelse ($student->pelanggarans as $pelanggaran)
                     @php
                        $jenis = '';
                        $colorPelanggaran = '';
                        
                        if ($pelanggaran->klasifikasi->poin <= 20) {
                            $colorPelanggaran = 'success';
                            $jenis = 'ringan';
                        } elseif ($pelanggaran->klasifikasi->poin <= 30 && $pelanggaran->klasifikasi->poin >= 21) {
                            $colorPelanggaran = 'warning';
                            $jenis = 'sedang';
                        } elseif ($pelanggaran->klasifikasi->poin <= 50 && $pelanggaran->klasifikasi->poin >= 31) {
                            $colorPelanggaran = 'danger';
                            $jenis = 'berat';
                        } else {
                            $colorPelanggaran = 'secondary';
                            $jenis = 'error';
                        }
                     @endphp
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $pelanggaran->nama }}
                        <div class="justify-content-end">
                           {{-- <span
                              class="badge bg-secondary badge-pill text-white">{{ $student->updated_at->diffForHumans() }}</span> --}}
                           <span
                              class="badge bg-{{ $colorPelanggaran }} badge-pill text-white">{{ $pelanggaran->klasifikasi->poin }}</span>
                        </div>
                     </li>
                  @empty
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        Anda Siswa teladan!
                        <span class="badge bg-success badge-pill text-white">kosong</span>
                     </li>
                  @endforelse
               </ul>
            </div>
         </div>
         <div class="card shadow-sm mb-3">
            <div class="card-header">
               <div class="row d-flex justify-content-start">
                  <div class="col-lg-4">
                     Penghargaan
                  </div>
                  <div class="col-lg-8 d-flex justify-content-end">

                     <div>
                        <a href="{{ route('penghargaan.students.edit', $student->nis) }}"
                           class="badge bg-success text-decoration-none text-white mx-1 py-2">
                           <i class="las la-plus"
                              style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                        </a>
                        <a href="{{ route('penghargaan.students.dismiss', $student->nis) }}"
                           class="badge bg-danger text-decoration-none text-white me-1 py-2">
                           <i class="las la-minus"
                              style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card-body" style="font-size: 16px">
               <ul class="list-group">
                  @forelse ($student->penghargaans as $penghargaan)
                     @php
                        $jenis = '';
                        $colorPenghargaan = '';
                        
                        if ($penghargaan->poin == 0) {
                            $colorPenghargaan = 'dark';
                            $jenis = 'kosong';
                        } elseif ($penghargaan->poin == 20) {
                            $colorPenghargaan = 'success';
                            $jenis = 'ringan';
                        } elseif ($penghargaan->poin == 30) {
                            $colorPenghargaan = 'success';
                            $jenis = 'sedang';
                        } elseif ($penghargaan->poin == 50) {
                            $colorPenghargaan = 'success';
                            $jenis = 'tinggi';
                        } else {
                            $colorPenghargaan = 'success';
                            $jenis = 'error';
                        }
                     @endphp
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $penghargaan->nama }}
                        <div class="justify-content-end">
                           <span
                              class="badge bg-secondary badge-pill text-white">{{ $student->updated_at->diffForHumans() }}</span>
                           <span
                              class="badge bg-{{ $colorPenghargaan }} badge-pill text-white">{{ $penghargaan->poin }}</span>
                        </div>
                     </li>
                  @empty
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        Anda belum memperoleh penghargaan!
                        <span class="badge bg-success badge-pill text-white">kosong</span>
                     </li>
                  @endforelse
               </ul>
            </div>
         </div>



      </div>
   </div>


   <script>
      // show or hide form bukti script
      // function showForm() {
      //    const select = document.getElementById('tipe_rule');
      //    const select = document.getElementById('select_rule_data');
      //    const bukti = document.getElementById('bukti');
      //    const ket = document.getElementById('ket');
      //    console.log(select.value);
      //    if (select.value != 1 && select.value != 0) {
      //       bukti.classList.remove('visually-hidden');
      //       if (select.value == 2) {
      //          ket.innerHTML = "Penghargaan atau Prestasi";
      //          $(bukti).attr("required", true);
      //       } else if (select.value == 3) {
      //          ket.innerHTML = "Surat Rekomendasi RMP"
      //          $(bukti).attr("required", true);
      //       }
      //    } else {
      //       bukti.classList.add('visually-hidden');
      //    }
      // }
   </script>

@endsection
