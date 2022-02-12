@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('siswa.rekap') }}"
         class="text-decoration-none {{ Request::is('siswa/rekap*') ? 'text-secondary' : '' }}">{{ $title }}</a>
   </li>
@endsection
@section('container')
   <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">

   @if (session('success'))
      <div class="col-lg-11">
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {!! session('success') !!}
         </div>
      </div>
   @endif

   <div class="table-responsive mt-3 col-lg-12  mb-4">

      <div class="card shadow-sm mb-2">
         <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
               <h5>Data Pelanggaran</h5>
               <div class="justify-content-end">
                  <a href="{{ route('siswa.rekap') }}" class="btn btn-success">
                     <i class="fas fa-shopping-cart me-2"></i>
                     Kunjungi shop poin</a>
               </div>
            </div>

            <hr>

            <table class="table table-bordered table-hover table-sm" id="table-siswa-pelanggaran">
               <thead>
                  <tr>
                     <th scope="col">#</th>
                     <th scope="col">Pelanggaran</th>
                     <th scope="col">Poin</th>
                     <th scope="col">Keterangan</th>
                     <th scope="col">Updated</th>
                     <th scope="col" class="text-center">Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($pelanggarans as $pelanggaran)
                     <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pelanggaran->nama }}</td>
                        <td class="text-center">
                           @php
                              $jenis = '';
                              $colorPoint = '';
                              
                              if ($pelanggaran->poin <= 20) {
                                  $colorPoint = 'text-success';
                                  $jenis = 'ringan';
                              } elseif ($pelanggaran->poin <= 30 && $pelanggaran->poin >= 21) {
                                  $colorPoint = 'text-warning';
                                  $jenis = 'sedang';
                              } elseif ($pelanggaran->poin <= 50 && $pelanggaran->poin >= 31) {
                                  $colorPoint = 'text-danger';
                                  $jenis = 'berat';
                              } else {
                                  $colorPoint = 'text-secondary';
                                  $jenis = 'error';
                              }
                           @endphp
                           <span class="{{ $colorPoint }}">{{ $pelanggaran->poin }}</span>
                        </td>
                        <td>{{ $pelanggaran->keterangan }}</td>
                        <td>{{ $student->updated_at->diffForHumans() }}</td>


                        <td class="">
                           <div class="d-flex align-items-center justify-content-center h-100">

                              <button type="button" class="badge bg-primary border-0 text-decoration-none text-white me-3"
                                 data-bs-toggle="modal" data-bs-target="#DetailPelanggaran{{ $pelanggaran->id }}">
                                 <i class="las la-eye"
                                    style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                              </button>
                              @include('dashboard.siswa-pages.modal.show')
                           </div>
                        </td>
                     </tr>
                  @endforeach

               </tbody>
            </table>
         </div>
      </div>

      <div class="card shadow-sm mb-2">
         <div class="card-body">
            <h5 class="mt-2">Data Penghargaan</h5>

            <hr>


            <table class="table table-bordered table-hover table-sm" id="table-siswa-penghargaan">
               <thead>
                  <tr>
                     <th scope="col">#</th>
                     <th scope="col">Penghargaan</th>
                     <th scope="col">Poin</th>
                     <th scope="col">Keterangan</th>
                     <th scope="col">Updated</th>
                     <th scope="col" class="text-center">Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($student->penghargaans as $penghargaan)
                     <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $penghargaan->nama }}</td>
                        <td class="text-center">
                           @php
                              $jenis = '';
                              $colorPoint = '';
                              
                              if ($penghargaan->poin <= 20) {
                                  $colorPoint = 'text-success';
                                  $jenis = 'ringan';
                              } elseif ($penghargaan->poin <= 30 && $penghargaan->poin >= 21) {
                                  $colorPoint = 'text-warning';
                                  $jenis = 'sedang';
                              } elseif ($penghargaan->poin <= 50 && $penghargaan->poin >= 31) {
                                  $colorPoint = 'text-danger';
                                  $jenis = 'berat';
                              } else {
                                  $colorPoint = 'text-secondary';
                                  $jenis = 'error';
                              }
                           @endphp
                           <span class="{{ $colorPoint }}">{{ $penghargaan->poin }}</span>
                        </td>
                        <td>{{ $penghargaan->keterangan }}</td>
                        <td>{{ $student->updated_at->diffForHumans() }}</td>


                        <td class="">
                           <div class="d-flex align-items-center justify-content-center h-100">

                              <button type="button" class="badge bg-primary border-0 text-decoration-none text-white"
                                 data-bs-toggle="modal" data-bs-target="#DetailPenghargaan{{ $penghargaan->id }}">
                                 <span data-feather="eye"></span>
                              </button>
                              @include('dashboard.siswa-pages.modal.show2')
                           </div>
                        </td>
                     </tr>
                  @endforeach

               </tbody>
            </table>
         </div>
      </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
   <script>
      const dataTable = new simpleDatatables.DataTable("#table-siswa-pelanggaran", {
         searchable: true,
         fixedHeight: true,
      })

      const dataTable2 = new simpleDatatables.DataTable("#table-siswa-penghargaan", {
         searchable: true,
         fixedHeight: true,
      })
   </script>

@endsection
