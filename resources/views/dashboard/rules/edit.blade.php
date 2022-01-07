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
      <a href="{{ route('dashboard.ruledata.edit', $rule->id) }}"
         class="text-decoration-none {{ Request::is("dashboard/ruledata/$rule->id/edit") ? 'text-secondary' : '' }}">{{ $title }}</a>
   </li>
@endsection
@section('container')

   <div class="row mb-5">
      <div class="col-lg-8">
         <form method="POST" action="{{ route('dashboard.ruledata.update', $rule->id) }}">
            @method('put')
            @csrf

            <div class="mb-3">
               <div class="row d-flex justify-content-start">
                  <div class="col-md-4">
                     <label for="data_type" class="form-label">Tipe Data</label>
                  </div>
                  <div class="col-md-4">

                     <label for="jenis" class="form-label">Jenis</label>
                  </div>
                  <div class="col-md-4">

                     <label for="point" class="form-label">Besar Point</label>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-4">
                     <select class="form-control" name="data_type" id="data_type">
                        <option selected disabled>Select Tipe Data</option>
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
                           @if (old('data_type', $rule->data_type) == $d && $rule->data_type != null)
                              <option value="{{ $d }}" selected>{{ $dalamText }}</option>
                           @else
                              <option value="{{ $d }}">{{ $dalamText }}</option>
                           @endif
                        @endforeach
                     </select>
                  </div>

                  <div class="col-md-4">

                     <select class="form-control" name="jenis" id="jenis">
                        <option disabled selected>Select Jenis</option>
                        @foreach ($jenis as $j)
                           @if (old('jenis', $rule->jenis) == $j)
                              <option value="{{ $j }}" selected>{{ $j }}</option>
                           @else
                              <option value="{{ $j }}">{{ $j }}</option>
                           @endif
                        @endforeach
                     </select>
                  </div>

                  <div class="col-md-4">
                     <input type="number" class="form-control @error('point') is-invalid @enderror" id="point" name="point"
                        placeholder="40 ..." value="{{ old('point', $rule->point) }}">
                     @error('point')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
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

            <div class="mb-3">
               <label for="keterangan" class="form-label">Keterangan</label>
               <input type="text" placeholder="Deskripsi Data ..."
                  class="form-control @error('keterangan')
                  is-invalid
               @enderror"
                  id="keterangan" name="keterangan" value="{{ old('keterangan', $rule->keterangan) }}">
               @error('keterangan')
                  <div class="invalid-feedback">
                     {{ $message }}
                  </div>
               @enderror
            </div>


            <div class="d-flex justify-content-end">
               <button type="submit" class="btn btn-primary px-4">Save</button>
            </div>
         </form>
      </div>
   </div>



@endsection
