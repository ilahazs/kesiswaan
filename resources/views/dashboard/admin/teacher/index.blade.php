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

   <div class="card card-shadow mb-5" style="border-radius: 25px">
      <div class="card-body" style="background-color: white">
         <button type="button" class="btn bg-primary btn-new-data border-0 text-decoration-none text-white"
            data-toggle="modal" data-target="#tambahGuru">
            Tambah data wakel
         </button>
         @include('dashboard.admin.teacher.modal.create')

         <div class="table-responsive mt-3 col-lg-12">
            <table class="table table-responsive-lg">
               <thead>
                  <tr>
                     <th scope="col">#</th>
                     <th scope="col">Nama</th>
                     <th scope="col">NIP</th>
                     <th scope="col">Kelas</th>
                     {{-- <th scope="col"><i class="fas fa-1x fa-layer-group"></i></th> --}}
                  </tr>
               </thead>
               <tbody>
                  @forelse ($teachers as $teacher)
                     <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $teacher->nama }}</td>
                        <td>{{ $teacher->nip }}</td>
                        @php
                           $romawiTingkatan = '';
                           switch ($teacher->kelas->tingkatan) {
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
                           $concatKelas = $romawiTingkatan . ' ' . $teacher->kelas->jurusan . ' ' . $teacher->kelas->nama;
                        @endphp
                        <td>{{ $concatKelas }}</td>
                        <td class="d-flex justify-content-center">
                           <button type="button" class="badge bg-primary border-0 text-decoration-none text-white"
                              data-toggle="modal" data-target="#showTeacher{{ $teacher->id }}">
                              <i class="las la-eye"
                                 style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                           </button>

                           <button type="button"
                              class="badge bg-success border-0 text-decoration-none text-white mx-1 py-2"
                              data-toggle="modal" data-target="#editTeacher{{ $teacher->id }}">
                              <i class="las la-edit"
                                 style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                           </button>

                           <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST">
                              @method('delete')
                              @csrf
                              <button class="badge btn-danger text-decoration-none text-white border-0 py-2"
                                 onclick="return confirm('yes/no?')">
                                 <i class="las la-trash-alt"
                                    style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                           </form>
                        </td>


                     </tr>

                     @include('dashboard.admin.teacher.modal.show')
                     @include('dashboard.admin.teacher.modal.edit')
                  @empty
               <tbody class="text-center">
                  <td>
                     <h3>Data masih kosong</h3>

                  </td>
               </tbody>
               @endforelse
               </tbody>
            </table>
         </div>
      </div>
   </div>
@endsection
