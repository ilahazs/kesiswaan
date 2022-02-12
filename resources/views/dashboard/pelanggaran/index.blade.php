@extends('dashboard.layouts.main')
@section('heading-title', $title)
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
      <div class="table-responsive mt-3 col-lg-12">
         <a href="{{ route('pelanggaran.create') }}" class="btn btn-primary mb-3">Tambah data aturan
            pelanggaran</a>

         <table class="table table-bordered table-lg">
            <thead>
               <tr class="text-uppercase">
                  <th scope="col">NO</th>
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
                  <td class="text-uppercase @php
                           $jenis = '';
                           $colorPoint = '';
      
                        if ($pelanggaran->poin <= 20) {
                           $colorPoint = 'text-success';
                           $jenis = 'ringan';
                        } elseif ($pelanggaran->poin <= 30 && $pelanggaran->poin >= 21) {
                           $colorPoint = 'text-warning';
                           $jenis = 'sedang';
                        } elseif ($pelanggaran->poin <= 50 && $pelanggaran->poin >= 31) {
                           $colorPoint = 'text-danger';
                           $jenis = 'berat';
                        } else {
                           $colorPoint = 'text-danger';
                           $jenis = 'error';
                        }
                     @endphp">
                     <strong>{{ $jenis }}</strong>
                  </td>
                  <td>
                     <span class="{{ $colorPoint }}">{{ $pelanggaran->poin }}</span>
                  </td>
                  <td>{{ $pelanggaran->keterangan }}</td>
                  <td>{{ $pelanggaran->updated_at->diffForHumans() }}</td>

                  <td class="d-flex justify-content-center">

                     <button type="button" class="badge bg-primary border-0 text-decoration-none text-white" data-toggle="modal" data-target="#showPelanggaran{{ $pelanggaran->id }}">
                        show
                     </button>
                     @include('dashboard.pelanggaran.modal.show')

                     {{-- <a href="{{ route('pelanggaran.edit', $pelanggaran->id) }}"
                     class="badge bg-success text-decoration-none text-white mx-2">
                     edit
                     </a> --}}
                     <span class="badge btn-success mx-1 border-0" style="padding-top: 5px"><a href="{{ route('pelanggaran.edit', $pelanggaran->id) }}" class=" text-decoration-none text-white">edit</a></span>

                     <form action="{{ route('pelanggaran.destroy', $pelanggaran->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button class="badge btn-danger text-decoration-none py-1 text-white border-0" onclick="return confirm('yes/no?')">delete
                        </button>
                     </form>
                  </td>
               </tr>
               @endforeach

            </tbody>
         </table>
      </div>
   </div>
</div>



@endsection
