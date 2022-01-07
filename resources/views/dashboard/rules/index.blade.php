@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('dashboard.ruledata.index') }}"
         class="text-decoration-none {{ Request::is('dashboard/ruledata*') ? 'text-secondary' : '' }}">{{ $title }}</a>
   </li>
@endsection
@section('container')

   @if (session('success'))
      <div class="col-lg-11">
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {!! session('success') !!}
         </div>
      </div>
   @endif

   <div class="table-responsive mt-3 col-lg-12">
      <a href="{{ route('dashboard.ruledata.create') }}" class="btn btn-primary mb-3">Create new rule</a>

      <table class="table table-bordered table-sm">
         <thead>
            <tr>
               <th scope="col">#</th>
               <th scope="col">Tipe</th>
               <th scope="col">Keterangan</th>
               <th scope="col">Jenis</th>
               <th scope="col">Point</th>
               <th scope="col">Updated</th>
               <th scope="col" class="text-center">Aksi</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($rulesData as $rule)
               <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td class="{{ $rule->data_type == 1 ? 'text-primary' : 'text-danger' }}">
                     {{ $rule->data_type == 1 ? 'Penghargaan' : 'Pelanggaran' }}</td>
                  <td>{{ $rule->keterangan }}</td>
                  <td
                     class="@php
                        switch ($rule->jenis) {
                           case 'ringan':
                              echo 'text-success';
                              break;
                           case 'sedang':
                              echo 'text-secondary';
                              break;
                           case 'berat':
                              echo 'text-danger';
                              break;
                           default:
                              echo 'text-secondary';
                              break;
                        }
                     @endphp">
                     {{ $rule->jenis }}</td>
                  @php
                     $colorPoint = '';
                     if ($rule->point >= 30 && $rule->point <= 39) {
                         $colorPoint = 'text-success';
                     } elseif ($rule->point >= 40 && $rule->point <= 49) {
                         $colorPoint = 'text-warning';
                     } elseif ($rule->point >= 50 && $rule->point <= 100) {
                         $colorPoint = 'text-danger';
                     }
                  @endphp

                  <td class="{{ $colorPoint }}">
                     {{ $rule->point }}</td>
                  <td>{{ $rule->updated_at->diffForHumans() }}</td>
                  <td class="d-flex justify-content-center text-">
                     <button type="button" class="badge bg-primary border-0 text-decoration-none text-white"
                        data-bs-toggle="modal" data-bs-target="#showRule{{ $rule->id }}">
                        <span data-feather="eye"></span>
                     </button>
                     @include('dashboard.rules.modal.show')
                     <a href="{{ route('dashboard.ruledata.edit', $rule) }}"
                        class="badge bg-success text-decoration-none text-white mx-2">
                        <span data-feather="edit"></span>
                     </a>
                     <form action="{{ route('dashboard.ruledata.destroy', $rule->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button class="badge btn-danger text-decoration-none text-white border-0"
                           onclick="return confirm('yes/no?')"><span data-feather="trash-2"></span></button>

                     </form>
                  </td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </div>


@endsection
