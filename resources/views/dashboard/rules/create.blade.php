@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('dashboard.ruledata.index') }}" class="text-decoration-none">All Rule Data</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('dashboard.ruledata.create') }}"
         class="text-decoration-none {{ Request::is('dashboard/ruledata/create') ? 'text-secondary' : '' }}">{{ $title }}</a>
   </li>
@endsection
@section('container')

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

   <div class="row mb-5">
      <div class="col-lg-8">
         <form method="POST" action="{{ route('dashboard.ruledata.store') }}">
            @csrf

            <div class="mb-3">
               <div class="row d-flex justify-content-start">
                  <div class="col-md-4">
                     <label for="kelas" class="form-label">Tipe Data</label>
                  </div>
                  <div class="col-md-4">

                     <label for="point" class="form-label">Jenis</label>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-4">
                     <select class="form-control" name="data_type" id="kelas">
                        <option selected disabled>Select Jenis</option>
                        @foreach ($data_type as $d)
                           @php
                              $dalamText = '';
                              switch ($d) {
                                  case 0:
                                      $dalamText = 'Pelanggaran';
                                      break;
                                  case 1:
                                      $dalamText = 'Penghargaan';
                                      break;
                                  default:
                                      $dalamText = 'Undefined';
                                      break;
                              }
                           @endphp
                           @if (old('data_type') === $d)
                              <option value="{{ $d }}" selected>{{ $dalamText }}</option>
                           @else
                              <option value="{{ $d }}">{{ $dalamText }}</option>
                           @endif
                        @endforeach
                     </select>
                  </div>

                  <div class="col-md-4">

                     <select class="form-control" name="jenis" id="jenis" onchange="showForm()">
                        <option disabled selected>Select Jenis Data</option>
                        @foreach ($jenis as $j)
                           @if (old('jenis') == $j)
                              <option value="{{ $j }}" selected id="jenis_data">{{ $j }}</option>
                           @else
                              <option value="{{ $j }}" id="jenis_data">{{ $j }}</option>
                           @endif
                        @endforeach
                     </select>
                  </div>


               </div>
            </div>

            {{-- <div class="mb-3">
               <label for="point" class="form-label">Besar Point</label>
               <input type="text" class="form-control @error('point') is-invalid @enderror" id="point" name="point"
                  value="{{ old('point') }}">
               @error('point')
                  <div class="invalid-feedback">
                     {{ $message }}
                  </div>
               @enderror
            </div> --}}
            <div class="mb-3  ">
               <div class="row">
                  <div class="col-lg-8">
                     <label for="point" class="form-label">Besar Point</label>

                     <input type="number" class="form-control @error('point') is-invalid @enderror" id="input_point"
                        name="point_template" placeholder="ringan: 30 | sedang: 40 | tinggi: 50" disabled readonly>
                     @error('point')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                  </div>
               </div>
            </div>

            <div class="mb-3">
               <div class="row">
                  <div class="col-lg-8">
                     <label for="keterangan" class="form-label">Keterangan</label>
                     <input type="text" placeholder="Deskripsi Data ..."
                        class="form-control @error('keterangan')
                        is-invalid
                     @enderror"
                        id="keterangan" name="keterangan" value="{{ old('keterangan') }}">
                     @error('keterangan')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                  </div>
               </div>
            </div>


            <div class="d-flex justify-content-end">
               <button type="submit" class="btn btn-primary px-4">Save</button>
            </div>
         </form>
      </div>
   </div>

   <script>
      // show or hide form bukti script
      function showForm() {
         //    const jenis_data = document.getElementById('jenis_data');
         //    const input_point = document.getElementById('input_point');

         //    console.log(jenis_data.value);
         //    if (jenis_data.value == 'ringan') {
         //       input_point.value = 30;
         //       input_point.innerHTML = 30;
         //    } else if (jenis_data.value == 'sedang') {
         //       input_point.value = 40;
         //       input_point.innerHTML = 40;
         //    } else if (jenis_data.value == 'tinggi') {
         //       input_point.value = 50;
         //       input_point.innerHTML = 50;
         //    }
         // }
         // $(document).ready(function() {
         //    $("#jenis_data").change(function() {
         //       $("#input_point").html(90);
         //    });

         // });
   </script>


@endsection
