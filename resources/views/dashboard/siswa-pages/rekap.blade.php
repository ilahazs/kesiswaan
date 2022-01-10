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

   <div class="table-responsive mt-3 col-lg-12">
      <a href="{{ route('siswa.rekap') }}" class="btn btn-primary mb-3">Kunjungi shop poin</a>

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
            @foreach ($student->pelanggarans as $pelanggaran)
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
                  <td>{{ $pelanggaran->updated_at->diffForHumans() }}</td>


                  <td class="">
                     <div class="d-flex align-items-center justify-content-center h-100">

                        <button type="button" class="badge bg-primary border-0 text-decoration-none text-white"
                           data-bs-toggle="modal" data-bs-target="#DetailPelanggaran{{ $pelanggaran->id }}">
                           <span data-feather="eye"></span>
                        </button>
                        @include('dashboard.siswa-pages.modal.show')
                        {{-- <a href="{{ route('pelanggaran.students.edit', $student->nis) }}"
                           class="badge bg-success text-decoration-none text-white mx-1">
                           <span data-feather="edit"></span>
                        </a>
                        <a href="{{ route('pelanggaran.students.dismiss', $student->nis) }}"
                           class="badge bg-danger text-decoration-none text-white me-1">
                           <span data-feather="edit"></span>
                        </a> --}}
                     </div>
                  </td>
               </tr>
            @endforeach

         </tbody>
      </table>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
   <script>
      const dataTable = new simpleDatatables.DataTable("#table-siswa-pelanggaran", {
         searchable: true,
         fixedHeight: true,
      })
   </script>

@endsection
