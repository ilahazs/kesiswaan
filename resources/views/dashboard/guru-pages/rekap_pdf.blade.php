@extends('pdf.main')
@section('container')


   <div class="table-responsive mt-5 col-lg-12">
      <h2 class="mb-3">{{ $namaKelas }}</h2>
      <div class="mb-3 row">
         <div class="col-md-1" style="margin-right: 10px">
            <label for="wk" class="col-form-label">Walikelas</label>
         </div>
         <div class="col-md-1 mt-1" style="margin-right: -80px">
            <label>:</label>
         </div>
         <div class="col-md-2">
            <input type="text" disabled readonly class="form-control bg-white" id="wk" value="{{ $namaWalikelas }}">
         </div>
      </div>
      <div class="mb-3 row">
         <div class="col-md-2" style="margin-right: -100px">
            <label for="wk" class="col-form-label">Jumlah siswa</label>
         </div>
         <div class="col-md-1 mt-1" style="margin-right: -80px">
            <label>:</label>
         </div>
         <div class="col-md-2">
            <input type="text" disabled readonly class="form-control bg-white" id="wk" value="{{ $students->count() }}">
         </div>
      </div>
      <hr class="mt-2 mb-4">

      <table class="table table-bordered table-sm">
         <thead>
            <tr>
               <th scope="col">No</th>
               <th scope="col">Nama</th>
               <th scope="col" class="text-center">Pelanggaran</th>
               <th scope="col" class="text-center">Penghargaan</th>
            </tr>
         </thead>
         <tbody>
            @forelse ($students as $student)
               <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $student->nama }}</td>
                  <td>
                     <ul>
                        @forelse ($student->pelanggarans as $pelanggaran)
                           <li>{{ $pelanggaran->nama . ' : ' . $pelanggaran->poin }}</li>
                        @empty
                           <span class="text-uppercase">Data masih kosong</span>
                        @endforelse
                     </ul>
                  </td>
                  <td>
                     <ul>
                        @forelse ($student->penghargaans as $penghargaan)
                           <li>{{ $penghargaan->nama . ' : ' . $penghargaan->poin }}</li>
                        @empty
                           <span class="text-uppercase">Data masih kosong</span>
                        @endforelse
                     </ul>
                  </td>
               </tr>
            @empty
               <tr class="text-center">
                  <td>Kelas anda masih koosng</td>
               </tr>
            @endforelse
         </tbody>
      </table>
   </div>

@endsection
