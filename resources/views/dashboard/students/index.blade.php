@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('flash-message')
   @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
         <button type="button" class="btn-close close" data-dismiss="alert" aria-label="Close"><span
               aria-hidden="true">×</span></button>
         {!! session('success') !!}
      </div>
   @endif
@endsection
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      {{ $title }}
   </li>
@endsection
@section('container')
   <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">

   {{-- <link href="{{ asset('assets-niceadmin/css/style.css') }}" rel="stylesheet"> --}}

   <link href="{{ asset('assets-niceadmin/vendor/simple-datatables/style.css') }}" rel="stylesheet">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

   <div class="card">
      <div class="card-body">
         <div class="table-responsive my-3">
            {{-- <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Create new student</a> --}}
            <button type="button" class="btn btn-primary btn-new-data mb-3" data-toggle="modal"
               data-target="#createDataStudent">
               Tambah data
               siswa <i class="fas fa-plus"></i></button>
            @include('dashboard.students.modal.create')


            @if (!empty($errors))
               <script>
                  $(function() {
                     $('#createDataStudent').modal('show');
                  });
               </script>
            @endif

            <a href="{{ route('exportstudents') }}" class="btn btn-success btn-new-data mx-2 mb-3">Export Data Siswa</a>

            {{-- <div class="search-bar">
               <form class="search-form d-flex align-items-center" method="POST" action="#">
                  <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                  <button type="submit" title="Search"><i class="bi bi-search"></i></button>
               </form>
            </div><!-- End Search Bar --> --}}

            <table class="table table-bordered able-responsive-md datatable" id="master-students">
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
                        <td class="{{ $student->point >= 70 ? 'text-primary' : 'text-danger' }}">
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
                           <button type="button" class="badge bg-primary border-0 text-decoration-none text-white"
                              data-toggle="modal" data-target="#showStudent{{ $student->id }}">
                              <i class="las la-eye"
                                 style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                           </button>
                           @include('dashboard.students.modal.show')
                           <a href="{{ route('students.edit', $student->nis) }}"
                              class="badge bg-success text-decoration-none text-white mx-1 py-2">
                              <i class="las la-edit"
                                 style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                           </a>
                           <form action="{{ route('students.destroy', $student->nis) }}" method="POST">
                              @method('delete')
                              @csrf
                              <button class="badge btn-danger text-decoration-none text-white border-0 py-2"
                                 onclick="return confirm('yes/no?')">
                                 <i class="las la-trash-alt"
                                    style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>

                           </form>
                        </td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
         </div>


      </div>
   </div>


   @if (!empty($errors))
      <script>
         $(function() {
            $('#createDataStudent').modal('show');
         });
      </script>
   @endif

   <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
   <script>
      const dataTable = new simpleDatatables.DataTable("#master-students", {
         searchable: true,
         fixedHeight: true,
      })

      /**
       * Initiate Datatables
       */
      /* const dataTables = select('.datatable', true);

      dataTables.forEach(datatable => {
         new simpleDatatables.DataTable(datatable);
         searchable: true,
            fixedHeight: true,
      }) */
   </script>

@endsection
