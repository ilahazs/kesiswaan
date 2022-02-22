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
            data-toggle="modal" data-target="#createUser">
            Tambah data user
         </button>
         <div class="table-responsive mt-3 col-lg-12">
            <table class="table table-responsive-lg">
               <thead>
                  <tr>
                     <th scope="col">#</th>
                     <th scope="col">Name</th>
                     <th scope="col">Username</th>
                     <th scope="col">Email</th>
                     <th scope="col">Role</th>
                     {{-- <th scope="col"><i class="fas fa-1x fa-layer-group"></i></th> --}}
                  </tr>
               </thead>
               <tbody>
                  @foreach ($users as $user)
                     <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ __('') }}</td>
                        <td class="d-flex justify-content-center">
                           <button type="button" class="badge bg-primary border-0 text-decoration-none text-white"
                              data-toggle="modal" data-target="#showUser{{ $user->id }}">
                              <i class="las la-eye"
                                 style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                           </button>

                           <button type="button"
                              class="badge bg-success border-0 text-decoration-none text-white mx-1 py-2"
                              data-toggle="modal" data-target="#editUser{{ $user->id }}">
                              <i class="las la-edit"
                                 style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>
                           </button>

                           <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                              @method('delete')
                              @csrf
                              <button class="badge btn-danger text-decoration-none text-white border-0 py-2"
                                 onclick="return confirm('yes/no?')">
                                 <i class="las la-trash-alt"
                                    style="font-size: 1.33333em; line-height: .75em; vertical-align: -.1em"></i>

                           </form>
                        </td>
                        @include('dashboard.admin.user.modal.show')
                        @include('dashboard.admin.user.modal.create')
                        @include('dashboard.admin.user.modal.edit')

                     </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
@endsection
