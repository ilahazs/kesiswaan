@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('guru.rekap') }}"
         class="text-decoration-none {{ Request::is('guru/rekap*') ? 'text-secondary' : '' }}">{{ $title }}</a>
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
      <div class="card">
         <div class="card-body">
            {{-- <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Create new student</a> --}}

            <a href="{{ route('exportkelas') }}" class="btn btn-success mx-2 mb-3"><i
                  class="fas fa-download me-4"></i><span class="ms-2">Export Data Siswa</span></a>

            {{-- <div class="search-bar">
         <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
         </form>
      </div><!-- End Search Bar --> --}}

            <table class="table table-bordered table-sm datatable" id="students-kelas">
               <thead>
                  <tr>
                     <th scope="col">#</th>
                     <th scope="col">Nama</th>
                     <th scope="col">NIS</th>
                     <th scope="col">Kelas</th>
                     <th scope="col">Pelanggaran</th>
                     <th scope="col">Penghargaan</th>
                     <th scope="col">Updated</th>
                     <th scope="col" class="text-center">Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($students as $student)
                     <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $student->nama }}</td>
                        <td>{{ $student->nis }}</td>
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
                           
                           $jenis = '';
                           $colorPelanggaran = '';
                           
                           if ($student->poin_pelanggaran <= 20) {
                               $colorPelanggaran = 'text-success';
                               $jenis = 'ringan';
                           } elseif ($student->poin_pelanggaran <= 30 && $student->poin_pelanggaran >= 21) {
                               $colorPelanggaran = 'text-warning';
                               $jenis = 'sedang';
                           } elseif ($student->poin_pelanggaran <= 50 && $student->poin_pelanggaran >= 31) {
                               $colorPelanggaran = 'text-danger';
                               $jenis = 'berat';
                           } else {
                               $colorPelanggaran = 'text-danger';
                               $jenis = 'error';
                           }
                           $colorPenghargaan = 'text-success';
                           
                           // if ($student->poin_penghargaan <= 20) {
                           //     $colorPenghargaan = 'text-success';
                           //     $jenis = 'ringan';
                           // } elseif ($student->poin_penghargaan <= 30 && $student->poin_penghargaan >= 21) {
                           //     $colorPenghargaan = 'text-warning';
                           //     $jenis = 'sedang';
                           // } elseif ($student->poin_penghargaan <= 50 && $student->poin_penghargaan >= 31) {
                           //     $colorPenghargaan = 'text-danger';
                           //     $jenis = 'berat';
                           // } else {
                           //     $colorPenghargaan = 'text-secondary';
                           //     $jenis = 'error';
                           // }
                           
                        @endphp
                        <td>

                           {{ $concatKelas }}
                        </td>
                        <td class="{{ $colorPelanggaran }}">
                           {{ $student->poin_pelanggaran }}</td>
                        <td class="{{ $colorPenghargaan }}">
                           {{ $student->poin_penghargaan }}
                           {{-- @foreach ($student->pelanggarans as $pelanggaran)
                        {{ $pelanggaran->nama }}
                     @endforeach --}}
                        </td>

                        <td>{{ $student->updated_at->diffForHumans() }}</td>
                        <td class="d-flex justify-content-center">
                           {{-- <a href="{{ route('students.show', $student->nis) }}"
                        class="badge bg-primary text-decoration-none text-white">
                        <span data-feather="eye"></span>
                     </a> --}}
                           <button type="button" class="badge bg-primary border-0 text-decoration-none text-white px-2"
                              data-toggle="modal" data-target="#showStudent{{ $student->id }}">
                              <i class="las la-eye"
                                 style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                           </button>
                           @include('dashboard.students.modal.show')
                           <a href="https://wa.me/{{ $student->notelp }}" target="_blank" class="mx-2"><img
                                 src="{{ asset('img/wa2.png') }}" class="img-fluid" alt="wa" width="30px"></a>
                           {{-- <a href="{{ route('students.edit', $student->nis) }}"
                        class="badge bg-success text-decoration-none text-white mx-2">
                        <span data-feather="edit"></span>
                     </a>
                     <form action="{{ route('students.destroy', $student->nis) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button class="badge btn-danger text-decoration-none text-white border-0"
                           onclick="return confirm('yes/no?')"><span data-feather="trash-2"></span></button>

                     </form> --}}
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
      const dataTable = new simpleDatatables.DataTable("#students-kelas", {
         searchable: true,
         fixedHeight: true,
      })
   </script>

@endsection
