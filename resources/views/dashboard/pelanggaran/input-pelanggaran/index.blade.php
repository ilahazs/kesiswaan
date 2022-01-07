@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('dashboard.pelanggaran.students.index') }}"
         class="text-decoration-none {{ Request::is('pelanggaran/students*') ? 'text-secondary' : '' }}">{{ $title }}</a>
   </li>
@endsection
@section('container')

   @if (session('success'))
      <div class="col-lg-11">
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {!! session('success') !!}
         </div>
      </div>
   @endif

   <div class="table-responsive mt-3 col-lg-12">
      <a href="{{ route('dashboard.pelanggaran.create') }}" class="btn btn-primary mb-3">Tambah rekap pelanggaran
         siswa</a>

      <table class="table table-bordered table-sm">
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
                        
                        if ($student->poin <= 20) {
                            $colorPoint = 'text-success';
                            $jenis = 'ringan';
                        } elseif ($student->poin <= 30 && $student->poin >= 21) {
                            $colorPoint = 'text-warning';
                            $jenis = 'sedang';
                        } elseif ($student->poin <= 50 && $student->poin >= 31) {
                            $colorPoint = 'text-danger';
                            $jenis = 'berat';
                        } else {
                            $colorPoint = 'text-secondary';
                            $jenis = 'error';
                        }
                     @endphp
                     <span class="{{ $colorPoint }}">{{ $student->poin_pelanggaran }}</span>
                  </td>
                  <td>
                     <div class="my-1 mx-1">
                        <select class="form-control form-control-sm" name="rekap_pelanggaran" id="rekap_pelanggaran">
                           <option disabled selected>List Pelanggaran</option>
                           @foreach ($student->pelanggarans as $pelanggaran)
                              <option disabled>{{ $pelanggaran->nama . ' | ' . $pelanggaran->poin }}</option>
                           @endforeach
                        </select>
                     </div>

                  </td>
                  <td>{{ $student->updated_at->diffForHumans() }}</td>


                  <td class="">
                     <div class="d-flex align-items-center justify-content-center h-100">

                        <button type="button" class="badge bg-primary border-0 text-decoration-none text-white"
                           data-bs-toggle="modal" data-bs-target="#showDataStudent{{ $student->id }}">
                           <span data-feather="eye"></span>
                        </button>
                        @include('dashboard.pelanggaran.input-pelanggaran.modal.show')
                        <a href="{{ route('dashboard.pelanggaran.students.edit', $student->nis) }}"
                           class="badge bg-success text-decoration-none text-white mx-2">
                           <span data-feather="edit"></span>
                        </a>
                        <form action="{{ route('dashboard.pelanggaran.students.destroy', $student->nis) }}"
                           method="POST">
                           @method('delete')
                           @csrf
                           <button class="badge btn-danger text-decoration-none text-white border-0"
                              onclick="return confirm('yes/no?')"><span data-feather="trash-2"></span></button>
                        </form>
                     </div>
                  </td>
               </tr>
            @endforeach

         </tbody>
      </table>
   </div>



@endsection