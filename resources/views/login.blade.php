@extends('auth')
@section('description')
   <div class="description mb-3">
      <span class="text-muted">Enter your credentials and start using our service to manage your data.</span>
   </div>
@endsection
@section('container')
   <form action="{{ route('login-authenticate') }}" method="POST" autocomplete="off">
      @csrf
      {{-- <div class="form-floating">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
               placeholder="name@example.com" required autofocus value="{{ old('email') }}">
            @error('email')
               <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="email">Email address</label>
         </div> --}}
      {{-- <div class="form-floating">
         <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
            placeholder="name@example.com" required autofocus value="{{ old('username') }}">
         @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
         @enderror
         <label for="username">Username</label>
      </div> --}}

      {{-- Username/Email --}}
      <div class="form-floating">
         <input id="login" type="text" class="form-control {{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" name="login" value="{{ old('username') ?: old('email') }}"
                required autofocus>

         @if ($errors->has('username') || $errors->has('email'))
            <span class="invalid-feedback">
               <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
            </span>
         @endif
         <label for="username">Username/Email</label>

      </div>



      <div class="form-floating">
         <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required autofocus value="{{ old('password') }}">
         @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
         @enderror
         <label for="password">Password</label>
      </div>


      <div class="row mb-3">
         <div class="col-lg-12 text-center d-flex justify-content-end">
            <span>
               <a href="{{ route('password.email') }}" class="text-decoration-none">
                  Forgot Password?</a></span>
         </div>
      </div>

      <button class="w-100 btn btn-lg btn-primary btn-auth" type="submit">Sign in</button>
   </form>
@endsection
