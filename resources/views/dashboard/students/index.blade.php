@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('dashboard.students.index') }}"
         class="text-decoration-none {{ Request::is('dashboard/students') ? 'text-secondary' : '' }}">{{ $title }}</a>
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
      <a href="{{ route('dashboard.students.create') }}" class="btn btn-primary mb-3">Create new student</a>

      <table class="table table-bordered table-sm">
         <thead>
            <tr>
               <th scope="col">#</th>
               <th scope="col">Nama</th>
               <th scope="col">NIS</th>
               <th scope="col">Kelas</th>
               <th scope="col">Point</th>
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
                  <td>

                     {{ $concatKelas }}
                  </td>
                  <td class="{{ $student->point >= 70 ? 'text-primary' : 'text-danger' }}">
                     {{ $student->point }}</td>
                  <td>
                     {{ $student->point }}
                     {{-- @foreach ($student->pelanggarans as $pelanggaran)
                        {{ $pelanggaran->nama }}
                     @endforeach --}}
                  </td>

                  <td>{{ $student->updated_at->diffForHumans() }}</td>
                  <td class="d-flex justify-content-center">
                     {{-- <a href="{{ route('dashboard.students.show', $student->nis) }}"
                        class="badge bg-primary text-decoration-none text-white">
                        <span data-feather="eye"></span>
                     </a> --}}
                     <button type="button" class="badge bg-primary border-0 text-decoration-none text-white"
                        data-bs-toggle="modal" data-bs-target="#showStudent{{ $student->id }}">
                        <span data-feather="eye"></span>
                     </button>
                     @include('dashboard.students.modal.show')
                     <a href="{{ route('dashboard.students.edit', $student->nis) }}"
                        class="badge bg-success text-decoration-none text-white mx-2">
                        <span data-feather="edit"></span>
                     </a>
                     <form action="{{ route('dashboard.students.destroy', $student->nis) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button class="badge btn-danger text-decoration-none text-white border-0"
                           onclick="return confirm('yes/no?')"><span data-feather="trash-2"></span></button>

                     </form>
                  </td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </div>


@endsection
