@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('penghargaan.students.index') }}"
         class="text-decoration-none {{ Request::is('penghargaan/students*') ? 'text-secondary' : '' }}">{{ $title }}</a>
   </li>
@endsection
@section('container')

   <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">

   @if (session('success'))
      <div class="col-lg-12">
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close close" data-dismiss="alert" aria-label="Close"><span
                  aria-hidden="true">×</span></button>
            {!! session('success') !!}
         </div>
      </div>
   @endif

   <div class="card">
      <div class="card-body">
         <div class="table-responsive mt-3 col-lg-12">
            <a href="{{ route('penghargaan.students.create') }}" class="btn btn-primary mb-3">Tambah rekap penghargaan
               siswa</a>

            <table class="table table-bordered table-sm" id="datasiswa-penghargaan">
               <thead>
                  <tr>
                     <th scope="col">#</th>
                     <th scope="col">Nama</th>
                     <th scope="col">NIS</th>
                     <th scope="col">Kelas</th>
                     <th scope="col">Poin</th>
                     <th scope="col">Rekap</th>
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
                           
                        @endphp
                        <td>{{ $concatKelas }}</td>
                        <td class="text-center">
                           @php
                              $jenis = '';
                              $colorPoint = '';
                              if ($student->poin_penghargaan == 0) {
                                  $colorPoint = 'text-dark';
                              } elseif ($student->poin_penghargaan <= 20 && $student->poin_penghargaan > 0) {
                                  $colorPoint = 'text-success';
                                  $jenis = 'ringan';
                              } elseif ($student->poin_penghargaan <= 30 && $student->poin_penghargaan >= 21) {
                                  $colorPoint = 'text-success';
                                  $jenis = 'sedang';
                              } elseif ($student->poin_penghargaan <= 50 && $student->poin_penghargaan >= 31) {
                                  $colorPoint = 'text-success';
                                  $jenis = 'tinggi';
                              } else {
                                  $colorPoint = 'text-success';
                              }
                              $colorPoint = 'text-success';
                           @endphp
                           <span class="{{ $colorPoint }}">{{ $student->poin_penghargaan }}</span>
                        </td>
                        <td>
                           <div class="my-1 mx-1">
                              <select class="form-control form-control-sm" name="rekap_penghargaan" id="rekap_penghargaan">
                                 <option disabled selected>List penghargaan</option>
                                 @foreach ($student->penghargaans as $penghargaan)
                                    <option disabled>{{ $penghargaan->nama . ' | ' . $penghargaan->poin }}</option>
                                 @endforeach
                              </select>
                           </div>

                        </td>
                        <td>{{ $student->updated_at->diffForHumans() }}</td>


                        <td class="">
                           <div class="d-flex align-items-center justify-content-center h-100">

                              <button type="button" class="badge bg-primary border-0 text-decoration-none text-white py-2"
                                 data-toggle="modal" data-target="#showDataStudent{{ $student->id }}">
                                 <i class="las la-eye"
                                    style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                              </button>
                              @include('dashboard.penghargaan.input-penghargaan.modal.show')
                              <a href="{{ route('penghargaan.students.edit', $student->nis) }}"
                                 class="badge bg-success text-decoration-none text-white mx-1 py-2">
                                 <i class="las la-edit"
                                    style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                              </a>
                              <a href="{{ route('penghargaan.students.dismiss', $student->nis) }}"
                                 class="badge bg-danger text-decoration-none text-white me-1 py-2">
                                 <i class="las la-trash-alt"
                                    style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                              </a>
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
      const dataTable = new simpleDatatables.DataTable("#datasiswa-penghargaan", {
         searchable: true,
         fixedHeight: true,
      })
   </script>

@endsection
