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

   {{-- @if (session('success'))
      <div class="col-lg-11">
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">close</button>
            {!! session('success') !!}
         </div>
      </div>
   @endif --}}

   <div class="card mb-5">
      <div class="card-body">
         {{-- <a href="{{ route('pelanggaran.create') }}" class="btn btn-primary btn-new-data">Tambah
            data
            pelanggaran</a> --}}
         <button type="button" class="btn bg-primary btn-new-data border-0 text-decoration-none text-white"
            data-toggle="modal" data-target="#createPelanggaran">
            Tambah data pelanggaran
         </button>
         <a href="{{ route('klasifikasi-pelanggaran.index') }}" class="btn btn-outline-success btn-new-data">Ubah
            Klasifikasi</a>
         <div class="table-responsive mt-3 col-lg-12">

            <table class="table table-bordered table-lg">
               <thead>
                  <tr class="text-uppercase">
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
                  @foreach ($pelanggarans as $pelanggaran)
                     <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pelanggaran->nama }}</td>
                        <td
                           class="text-uppercase @php
                           $jenis = '';
                           $colorPoint = '';
      
                        if ($pelanggaran->klasifikasi->jenis == 'ringan') {
                           $colorPoint = 'text-success';
                           $jenis = 'ringan';
                        } elseif ($pelanggaran->klasifikasi->jenis == 'sedang') {
                           $colorPoint = 'text-warning';
                           $jenis = 'sedang';
                        } elseif ($pelanggaran->klasifikasi->jenis == 'berat') {
                           $colorPoint = 'text-danger';
                           $jenis = 'berat';
                        } else {
                           $colorPoint = 'text-danger';
                           $jenis = 'error';
                        }
                     @endphp">
                           <strong>{{ $pelanggaran->klasifikasi->jenis }}</strong>
                        </td>
                        <td>
                           <span class="{{ $colorPoint }}">{{ $pelanggaran->klasifikasi->poin }}</span>
                        </td>
                        <td>{{ $pelanggaran->keterangan }}</td>
                        <td>{{ $pelanggaran->updated_at->diffForHumans() }}</td>

                        <td class="d-flex justify-content-center">


                           <button type="button" class="badge bg-primary border-0 text-decoration-none text-white"
                              data-toggle="modal" data-target="#showPelanggaran{{ $pelanggaran->id }}">
                              <i class="las la-eye"
                                 style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                           </button>

                           <button type="button"
                              class="badge bg-success border-0 text-decoration-none text-white mx-1 py-2"
                              data-toggle="modal" data-target="#editPelanggaran{{ $pelanggaran->id }}">
                              <i class="las la-edit"
                                 style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                           </button>

                           {{-- <a href="{{ route('pelanggaran.edit', $pelanggaran->id) }}"
                              class="badge bg-success text-decoration-none text-white mx-1 py-2">
                              <i class="las la-edit"
                                 style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                           </a> --}}

                           <form action="{{ route('pelanggaran.destroy', $pelanggaran->id) }}" method="POST">
                              @method('delete')
                              @csrf
                              <button class="badge btn-danger text-decoration-none text-white border-0 py-2"
                                 onclick="return confirm('yes/no?')">
                                 <i class="las la-trash-alt"
                                    style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                           </form>
                        </td>

                        @include('dashboard.pelanggaran.modal.show')
                        @include('dashboard.pelanggaran.modal.create')
                        @include('dashboard.pelanggaran.modal.edit')

                     </tr>
                  @endforeach

               </tbody>
            </table>
         </div>
      </div>
   </div>



@endsection
