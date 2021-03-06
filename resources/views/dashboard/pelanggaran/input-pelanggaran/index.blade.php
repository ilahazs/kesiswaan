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
   <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
   <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
@endsection
@section('container')

   <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">



   <div class="card">
      <div class="card-body">
         <a href="{{ route('pelanggaran.students.create') }}" class="btn btn-primary btn-new-data">Tambah rekap
            pelanggaran
            siswa</a>
         {{-- <button type="button" class="btn btn-primary btn-new-data" data-toggle="modal"
            data-target="#showDataStudent{{ $student->id }}">
            Tambah rekap pelanggaran
            siswa></button>
         @include('dashboard.pelanggaran.input-pelanggaran.modal.create') --}}
         <div class="table-responsive mt-3 col-lg-12">

            <table class="table table-bordered table-sm" id="datasiswa-pelanggaran">
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
                              
                              if ($student->poin_pelanggaran <= 20) {
                                  $colorPoint = 'text-success';
                                  $jenis = 'ringan';
                              } elseif ($student->poin_pelanggaran <= 30 && $student->poin_pelanggaran >= 21) {
                                  $colorPoint = 'text-warning';
                                  $jenis = 'sedang';
                              } elseif ($student->poin_pelanggaran <= 50 && $student->poin_pelanggaran >= 31) {
                                  $colorPoint = 'text-danger';
                                  $jenis = 'berat';
                              } else {
                                  $colorPoint = 'text-danger';
                                  $jenis = 'error';
                              }
                           @endphp
                           <span class="{{ $colorPoint }}">{{ $student->poin_pelanggaran }}</span>
                        </td>
                        <td>
                           <div class="my-1 mx-1">
                              <select class="form-control form-control-sm" name="rekap_pelanggaran" id="rekap_pelanggaran">
                                 <option disabled selected>List pelanggaran</option>
                                 @foreach ($student->pelanggarans as $pelanggaran)
                                    <option disabled>{{ $pelanggaran->nama . ' | ' . $pelanggaran->klasifikasi->poin }}
                                    </option>
                                 @endforeach
                              </select>
                           </div>

                        </td>
                        <td>{{ $student->updated_at->diffForHumans() }}</td>


                        <td class="">
                           <div class="d-flex align-items-center justify-content-center h-100">

                              <button type="button" class="badge bg-primary border-0 text-decoration-none text-white py-2"
                                 data-toggle="modal" data-target="#showDataStudent{{ $student->id }}">
                                 <i class="las la-eye"
                                    style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                              </button>
                              @include('dashboard.pelanggaran.input-pelanggaran.modal.show')
                              <a href="{{ route('pelanggaran.students.edit', $student->nis) }}"
                                 class="badge bg-success text-decoration-none text-white mx-1 py-2">
                                 <i class="las la-edit"
                                    style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                              </a>
                              <a href="{{ route('pelanggaran.students.dismiss', $student->nis) }}"
                                 class="badge bg-danger text-decoration-none text-white me-1 py-2">
                                 <i class="las la-trash-alt"
                                    style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                              </a>
                              {{-- <form action="{{ route('pelanggaran.students.destroy', $student->nis) }}" method="POST">
                                 @method('delete')
                                 @csrf
                                 <button class="badge btn-danger text-decoration-none text-white border-0"
                                    onclick="return confirm('yes/no?')"><span data-feather="trash-2"></span></button>
                              </form> --}}
                           </div>
                        </td>
                     </tr>
                  @endforeach

               </tbody>
            </table>
         </div>
      </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
   <script>
      const dataTable = new simpleDatatables.DataTable("#datasiswa-pelanggaran", {
         searchable: true,
         fixedHeight: true,
      })
   </script>

@endsection
