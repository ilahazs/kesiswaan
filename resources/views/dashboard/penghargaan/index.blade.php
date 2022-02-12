@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('penghargaan.index') }}"
         class="text-decoration-none {{ Request::is('penghargaan*') ? 'text-secondary' : '' }}">{{ $title }}</a>
   </li>
@endsection
@section('container')

   <div class="card mb-5">
      <div class="card-body">
   <div class="table-responsive mt-3 col-lg-12">
      <a href="{{ route('penghargaan.create') }}" class="btn btn-primary mb-3">Tambah data list
         penghargaan</a>

      <table class="table table-bordered table-md">
         <thead>
            <tr>
               <th scope="col">NO</th>
               <th scope="col">Nama</th>
               <th scope="col">Tingkatan</th>
               <th scope="col">Poin</th>
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
                     class="text-uppercase 
                  @php

                  if ($penghargaan->poin > 0 ) {
                     $colorPoint = 'text-success';
                  } else {
                     $colorPoint = 'text-secondary';
                  }
                  @endphp">
                     <strong>{{ $penghargaan->tingkatan }}</strong>
                  </td>
                  <td>
                     <span class="{{ $colorPoint }}">{{ $penghargaan->poin }}</span>
                  </td>
                  <td>{{ $penghargaan->keterangan }}</td>
                  <td>{{ $penghargaan->updated_at->diffForHumans() }}</td>
                  <td class="d-flex justify-content-center">
                     <button type="button" class="badge bg-primary border-0 text-decoration-none text-white" data-toggle="modal" data-target="#showPenghargaan{{ $penghargaan->id }}">
                        show
                     </button>
                     @include('dashboard.penghargaan.modal.show')

                     <span class="badge btn-success mx-1 border-0" style="padding-top: 5px"><a href="{{ route('penghargaan.edit', $penghargaan->id) }}" class=" text-decoration-none text-white">edit</a></span>

                     <form action="{{ route('penghargaan.destroy', $penghargaan->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button class="badge btn-danger text-decoration-none py-1 text-white border-0" onclick="return confirm('yes/no?')">delete
                        </button>
                     </form>


                     {{-- <button type="button" class="badge bg-primary border-0 text-decoration-none text-white"
                        data-bs-toggle="modal" data-bs-target="#showPenghargaan{{ $penghargaan->id }}">
                        <span data-feather="eye"></span>
                     </button>
                     @include('dashboard.penghargaan.modal.show')
                     <a href="{{ route('penghargaan.edit', $penghargaan->id) }}"
                        class="badge bg-success text-decoration-none text-white mx-2">
                        <span data-feather="edit"></span>
                     </a>
                     <form action="{{ route('penghargaan.destroy', $penghargaan->id) }}" method="POST">
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



@endsection
