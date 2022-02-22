@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item">
      <a href="{{ route('penghargaan.index') }}" class="text-decoration-none">{{ __('Data Penghargaan') }}</a>
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
            klasifikasi</a> --}}

         <button type="button" class="btn btn-primary btn-new-data" data-toggle="modal" data-target="#createKlasifikasi">
            Tambah data
            klasifikasi <i class="fas fa-plus"></i></button>
         @include('dashboard.penghargaan.modal.create-klasifikasi

         ')
         <div class="table-responsive mt-3 col-lg-12">

            <table class="table table-bordered table-md">
               <thead>
                  <tr class="text-uppercase">
                     <th scope="col">#</th>
                     <th scope="col">Tingkatan</th>
                     <th scope="col">Point</th>
                     <th scope="col">Updated</th>
                     <th scope="col" class="text-center">Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($klasifikasi as $k)
                     <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-uppercase">
                           {{ $k->tingkatan }}</td>
                        <td>
                           <span class="{{ __('text-success') }}">{{ $k->poin }}</span>
                        </td>
                        <td>{{ $k->updated_at->diffForHumans() }}</td>

                        <td class="d-flex justify-content-center">

                           <button type="button" class="badge bg-primary border-0 text-decoration-none text-white"
                              data-toggle="modal" data-target="#showKlasifikasi{{ $k->id }}">
                              <i class="las la-eye"
                                 style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                           </button>

                           <button type="button"
                              class="badge bg-success border-0 text-decoration-none text-white  mx-1 py-2"
                              data-toggle="modal" data-target="#editKlasifikasi{{ $k->id }}">
                              <i class="las la-edit"
                                 style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                           </button>
                           {{-- <a href="{{ route('klasifikasi-pelanggaran.edit', $k->id) }}"
                              class="badge bg-success text-decoration-none text-white mx-1 py-2">
                              <i class="las la-edit"
                                 style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                           </a> --}}
                           <form action="{{ route('klasifikasi-penghargaan.destroy', $k->id) }}" method="POST">
                              @method('delete')
                              @csrf
                              <button class="badge btn-danger text-decoration-none text-white border-0 py-2"
                                 onclick="return confirm('yes/no?')">
                                 <i class="las la-trash-alt"
                                    style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                           </form>
                        </td>
                        @include('dashboard.penghargaan.modal.edit-klasifikasi')
                        @include('dashboard.penghargaan.modal.show-klasifikasi')

                     </tr>
                  @endforeach

               </tbody>
            </table>
         </div>
      </div>
   </div>



@endsection
