<!-- Modal -->

<div class="modal fade text-left" id="createUser" data-backdrop="static" data-keyboard="false" tabindex="-1"
   aria-labelledby="createUserLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="createUserLabel">{{ __('Buat User Baru') }}
            </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="card shadow-sm">
               <div class="card-body">
                  <div class="row mb-2">
                     <div class="col-lg-12">
                        <form method="POST" action="{{ route('users.store') }}">
                           @csrf
                           <div class="mb-3">
                              <div class="row">
                                 <div class="col-lg-6">
                                    <label for="name" class="form-label">Nama</label>

                                 </div>
                                 <div class="col-lg-6">
                                    <label for="username" class="form-label">Username</label>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-6">
                                    <input type="text"
                                       class="form-control @error('name')
                                 is-invalid
                              @enderror"
                                       id="name" name="name" value="{{ old('name') }}">
                                    @error('name')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                                 <div class="col-lg-6">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                       id="username" name="username" value="{{ old('username') }}">
                                    @error('username')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                              </div>

                           </div>


                           <div class="mb-4">
                              <div class="row">

                                 <div class="col-md-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror

                                 </div>
                                 <div class="col-md-4">

                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       id="password" name="password" value="{{ old('password') }}">
                                    @error('password')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>

                                 <div class="col-md-4">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-control" name="role" id="role">
                                       <option disabled selected>Pilih role</option>
                                       @foreach ($roles as $role)
                                          @if (old('role') === $role)
                                             <option value="{{ $role }}" selected>{{ $role }}
                                             </option>
                                          @else
                                             <option value="{{ $role }}">{{ $role }}</option>
                                          @endif
                                       @endforeach
                                    </select>

                                    @error('role')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>

                                 {{-- <input type="hidden" name="class_id" value="0">
                                 <input type="hidden" name="user_id" value="0"> --}}

                              </div>
                           </div>


                     </div>
                  </div>
               </div>
            </div>


         </div>

         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>

         </div>
         </form>
      </div>
   </div>
</div>


@if (!empty($errors))
   <script>
      $(function() {
         $('#createUser').modal('show');
      });
   </script>
@endif
