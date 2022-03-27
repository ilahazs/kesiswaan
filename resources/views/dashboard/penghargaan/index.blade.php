@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      {{ $title }}
   </li>
@endsection
@section('container')

   <div class="card mb-5">
      <div class="card-body">
         <button type="button" class="btn bg-primary btn-new-data border-0 text-decoration-none text-white"
            data-toggle="modal" data-target="#createPenghargaan">
            Tambah data penghargaan
         </button>
         <a href="{{ route('klasifikasi-penghargaan.index') }}" class="btn btn-outline-success btn-new-data">Ubah
            Klasifikasi</a>
         <div class="table-responsive mt-3 col-lg-12">

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
                     $colorPoint = 'text-success';
                  }
                  @endphp">
                           <strong>{{ $penghargaan->klasifikasi->tingkatan }}</strong>
                        </td>
                        <td>
                           <span class="{{ $colorPoint }}">{{ $penghargaan->klasifikasi->poin }}</span>
                        </td>
                        <td>{{ $penghargaan->keterangan }}</td>
                        <td>{{ $penghargaan->updated_at->diffForHumans() }}</td>

                        <td class="d-flex justify-content-center">


                           <button type="button" class="badge bg-primary border-0 text-decoration-none text-white"
                              data-toggle="modal" data-target="#showPenghargaan{{ $penghargaan->id }}">
                              <i class="las la-eye"
                                 style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                           </button>

                           <button type="button"
                              class="badge bg-success border-0 text-decoration-none text-white mx-1 py-2"
                              data-toggle="modal" data-target="#editPenghargaan{{ $penghargaan->id }}">
                              <i class="las la-edit"
                                 style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                           </button>

                           <form action="{{ route('penghargaan.destroy', $penghargaan->id) }}" method="POST">
                              @method('delete')
                              @csrf
                              <button class="badge btn-danger text-decoration-none text-white border-0 py-2"
                                 onclick="return confirm('yes/no?')">
                                 <i class="las la-trash-alt"
                                    style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                           </form>
                        </td>

                        @include('dashboard.penghargaan.modal.show')
                        @include('dashboard.penghargaan.modal.create')
                        @include('dashboard.penghargaan.modal.edit')


                     </tr>
                  @endforeach

               </tbody>
            </table>
         </div>
      </div>
   </div>



@endsection
