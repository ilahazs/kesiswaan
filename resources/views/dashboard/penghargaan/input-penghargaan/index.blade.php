@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('penghargaan.students.index') }}"
         class="text-decoration-none {{ Request::is('penghargaan*') ? 'text-secondary' : '' }}">{{ $title }}</a>
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
      <a href="{{ route('penghargaan.create') }}" class="btn btn-primary mb-3">Tambah data list
         penghargaan</a>

      <table class="table table-bordered table-sm">
         <thead>
            <tr>
               <th scope="col">#</th>
               <th scope="col">Nama</th>
               <th scope="col">Jenis</th>
               <th scope="col">Point</th>
               <th scope="col">Keterangan</th>
               <th scope="col">Updated</th>
               <th scope="col" class="text-center">Aksi</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($penghargaans as $penghargaan)
               <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $penghargaan->nama }}</td>
                  <td
                     class="text-uppercase @php
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
                     $jenis = 'tinggi';
                  } else {
                     $colorPoint = 'text-secondary';
                     $jenis = 'error';
                  }
               @endphp">
                     <strong>{{ $jenis }}</strong>
                  </td>
                  <td>
                     <span class="{{ $colorPoint }}">{{ $penghargaan->poin }}</span>
                  </td>
                  <td>{{ $penghargaan->keterangan }}</td>
                  <td>{{ $penghargaan->updated_at->diffForHumans() }}</td>


                  <td class="d-flex justify-content-center text-">
                     <button type="button" class="badge bg-primary border-0 text-decoration-none text-white"
                        data-bs-toggle="modal" data-bs-target="#showPenghargaan{{ $penghargaan->id }}">
                        <span data-feather="eye"></span>
                     </button>
                     @include('dashboard.penghargaan.modal.show')
                     <a href="{{ route('penghargaan.students.edit', $penghargaan->id) }}"
                        class="badge bg-success text-decoration-none text-white mx-2">
                        <span data-feather="edit"></span>
                     </a>
                     <form action="{{ route('penghargaan.students.destroy', $penghargaan->id) }}" method="POST">
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
