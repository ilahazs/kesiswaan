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
         {{-- <button type="button" class="btn bg-primary btn-new-data border-0 text-decoration-none text-white"
            data-toggle="modal" data-target="#createLaporan">
            Buat Laporan Baru
         </button> --}}
         <a href="{{ route('laporan.create') }}"
            class="btn bg-primary btn-new-data border-0 text-decoration-none text-white">Buat Laporan Baru
         </a>
         <a href="{{ route('laporan.index') }}" class="btn btn-outline-success btn-new-data">Simpan
            PDF</a>
         <div class="table-responsive mt-3 col-lg-12">

            <div class="card">
               <div class="card-header">
                  <ul class="nav nav-tabs card-header-tabs">
                     @can('admin')
                        <li class="nav-item">
                           <a class="nav-link active" aria-current="true" href="#">Semua</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="#">Terbaca</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Pending</a>
                        </li>
                     @endcan
                     @can('siswa')
                        <li class="nav-item">
                           <a class="nav-link active" aria-current="true" href="#">Semua</a>
                        </li>
                     @endcan
                     @can('guru')
                        <li class="nav-item">
                           <a class="nav-link active" aria-current="true" href="#">Semua</a>
                        </li>
                     @endcan
                  </ul>
               </div>
               <div class="card-body">

                  @forelse ($laporans as $laporan)
                     <div class="card shadow-sm mb-4 text-start">
                        {{-- <h5 class="card-header">Featured</h5> --}}
                        <div class="card-body">
                           <div class="row">
                              <div class="col-lg-2">
                                 <img src="{{ asset('assets/img/undraw_profile.svg') }}" alt="" width="100px"
                                    class="">
                              </div>
                              <div class="col-lg-8 d-flex align-items-center justify-content-start">
                                 <h5 class="card-title">
                                    {{ $laporan->nama_pelaku }}
                                    <div class="w-100"></div>
                                    <hr>
                                    <span class="text-sm-start row" style="color: rgb(73, 73, 73); font-size: 1rem;">
                                       <div class="col-lg-6">
                                          Dilaporkan oleh {{ $laporan->role_pelapor }} : <a
                                             href="#">{{ $laporan->nama_pelapor }}</a>
                                       </div>
                                       <div class="col-lg-6">
                                          Tersangka : <a
                                             href="{{ route('students.show', $laporan->nis_pelaku) }}">{{ $laporan->nama_pelaku }}</a>
                                       </div>
                                    </span>
                                 </h5>
                              </div>
                              <div class="col-lg-2 d-flex align-text-top justify-content-end">
                                 <div>
                                    <button type="button"
                                       class="badge bg-success border-0 text-decoration-none text-white py-2"
                                       data-toggle="modal" data-target="#editLaporan{{ $laporan->id }}">
                                       <i class="fas fa-fw fa-edit"
                                          style="font-size: 1.5em; line-height: .95em; vertical-align: -.1em"></i>
                                       {{-- <a href="#" class="badge p-2 text-white bg-success">
                                          <i class="fas fa-fw fa-edit"
                                             style="font-size: 1.5em; line-height: .95em; vertical-align: -.1em"></i>
                                       </a> --}}
                                 </div>
                                 <div class="mx-1">
                                    {{-- <a href="#" class="badge p-2 text-white bg-primary mx-1">
                                       <i class="fas fa-fw fa-eye"
                                          style="font-size: 1.5em; line-height: .95em; vertical-align: -.1em"></i>
                                    </a> --}}
                                    <button type="button"
                                       class="badge bg-primary border-0 text-decoration-none text-white py-2"
                                       data-toggle="modal" data-target="#showLaporan{{ $laporan->id }}">
                                       <i class="fas fa-fw fa-eye"
                                          style="font-size: 1.5em; line-height: .95em; vertical-align: -.1em"></i>
                                 </div>


                                 <div>
                                    <form action="{{ route('laporan.destroy', $laporan->id) }}" method="POST">
                                       @method('delete')
                                       @csrf
                                       <button class="badge btn-danger text-decoration-none text-white border-0 py-2"
                                          onclick="return confirm('yes/no?')">
                                          <i class="fas fa-fw fa-minus"
                                             style="font-size: 1.5em; line-height: .95em; vertical-align: -.1em"></i>
                                    </form>
                                 </div>
                              </div>
                           </div>
                           <div class="row mt-3">
                              <div class="col-lg-8">
                                 <p class="card-text">{{ $laporan->keterangan }}
                                 </p>
                              </div>
                              <div class="col-lg-2"></div>
                              <div class="col-lg-2 d-flex align-items-end justify-content-end">
                                 <div class="d-flex justify-content-end">

                                    <button type="button"
                                       class="btn bg-primary text-decoration-none text-white align-items-end"
                                       data-toggle="modal" data-target="#showLaporan{{ $laporan->id }}">
                                       Detail
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     @include('dashboard.laporan.modal.show')
                     @include('dashboard.laporan.modal.edit')
                  @empty
                     <div class="card shadow-sm mb-4 text-start">
                        {{-- <h5 class="card-header">Featured</h5> --}}
                        <div class="card-body">
                           <div class="row">

                              <div class="col-lg-12">
                                 <ul class="list-group">
                                    <li
                                       class="list-group-item d-flex justify-content-between align-items-center bg-warning text-white">
                                       Belum ada data yang dilaporkan!
                                       <span class="badge bg-danger badge-pill">kosong</span>
                                    </li>
                                 </ul>
                              </div>

                           </div>

                        </div>
                     </div>
                  @endforelse





               </div>
            </div>

         </div>
      </div>
   </div>



@endsection
