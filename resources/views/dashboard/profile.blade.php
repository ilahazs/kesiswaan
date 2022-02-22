@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      {{ $title }}
   </li>
@endsection
@section('container')

   <form action="{{ route('profile.update', $user->id) }}" method="post">
      @csrf
      @method('put')
      <div class="card card-shadow mb-5">
         <div class="card-body" style="background-color: white">
            <div class="container rounded bg-white my-2">
               <div class="row">
                  <div class="col-md-3 border-right">
                     <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5"
                           width="150px"
                           src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span
                           class="font-weight-bold">{{ Auth::user()->name }}</span><span
                           class="text-black-50">{{ Auth::user()->email }}</span><span>
                        </span></div>
                  </div>
                  <div class="col-md-9 border-right">
                     <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                           <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                           <input type="hidden" name="gender" value="{{ $user->gender }}">
                           <div class="col-md-6">
                              <label class="labels">Nama Lengkap</label>
                              <input type="text" class="form-control" placeholder="Fullname" value="{{ $user->name }}"
                                 name="name">
                           </div>
                           <div class="col-md-6">
                              <label class="labels">Username</label>
                              <input type="text" class="form-control" placeholder="Username"
                                 value="{{ $user->username }}" name="username">
                           </div>
                        </div>
                        <div class="row mt-3">

                           @if (Auth::user()->role == 'siswa')
                              <div class="col-md-6">
                                 <label class="labels">Alamat Email</label>
                                 <input type="email" class="form-control" placeholder="example@gmail.com"
                                    value="{{ $user->email }}" name="email">
                              </div>
                              <div class="col-md-2">
                                 <label class="labels">Sebagai</label>
                                 <input type="text" class="form-control bg-white" value="{{ $user->role }}" name="role"
                                    disabled readonly>
                              </div>
                              <div class="col-md-2">
                                 <label class="labels">Penghargaan</label>
                                 <input type="text" class="form-control bg-white" value="{{ $poinPenghargaan }}"
                                    name="role" disabled readonly>
                              </div>
                              <div class="col-md-2">
                                 <label class="labels">Pelanggaran</label>
                                 <input type="text" class="form-control bg-white" value="{{ $poinPelanggaran }}"
                                    name="role" disabled readonly>
                              </div>
                           @elseif(Auth::user()->role == 'guru')
                              <div class="col-md-5">
                                 <label class="labels">Alamat Email</label>
                                 <input type="email" class="form-control bg-white" value="{{ $user->email }}"
                                    name="email">
                              </div>
                              <div class="col-md-4">
                                 <label class="labels">NIP</label>
                                 <input type="nip" class="form-control bg-white" value="{{ $nip }}" name="nip">
                              </div>
                              <div class="col-md-2">
                                 <label class="labels">Sebagai</label>
                                 <input type="text" class="form-control bg-white" value="{{ $user->role }}" name="role"
                                    disabled readonly>
                              </div>
                           @else
                              <div class="col-md-10">
                                 <label class="labels">Alamat Email</label>
                                 <input type="email" class="form-control bg-white" value="{{ $user->email }}" disabled
                                    readonly>
                              </div>
                              <div class="col-md-2">
                                 <label class="labels">Sebagai</label>
                                 <input type="text" class="form-control bg-white" value="{{ $user->role }}" name="role"
                                    disabled readonly>
                              </div>
                           @endif
                        </div>
                        @if (Auth::user()->role == 'siswa')
                           <div class="row mt-3">
                              <div class="col-md-5">
                                 <label class="labels">NIS</label>
                                 <input type="text" class="form-control bg-white" value="{{ $nis }}" name="role"
                                    disabled readonly>
                              </div>
                           </div>
                        @endif

                     </div>
                     {{-- <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience"><span>SECURITY
                              SETTINGS</span><span class="border px-3 p-1 add-experience"><i
                                 class="fa fa-plus"></i>&nbsp;PASSWORD</span></div><br>
                        <div class="col-md-12">
                           <label class="labels">Password saat ini</label>
                           <input type="password" class="form-control" placeholder="current password"
                              value="{{ old('currentpassword') }}" name="currentpassword">
                        </div> <br>
                        <div class="col-md-12">
                           <label class="labels">Password baru</label>
                           <input type="password" class="form-control" placeholder="new password"
                              value="{{ old('newpassword') }}" name="newpassword">
                        </div><br>
                        <div class="col-md-12">
                           <label class="labels">Ulangi password</label>
                           <input type="password" class="form-control" value="{{ old('repeatpassword') }}"
                              name="repeatpassword">
                        </div>
                     </div> --}}

                     <div class="mt-2 d-flex justify-content-end">
                        <button class="btn btn-primary profile-button px-5" type="submit">Save
                           Profile</button>
                     </div>
                  </div>

               </div>
            </div>
         </div>
      </div>
   </form>
@endsection
