@extends('auth')
@section('description')
   <div class="my-4"></div>
@endsection
@section('container')
   <form action="{{ route('password.update') }}" method="POST">
      @csrf
      <input type="hidden" name="token" value="{{ request()->token }}">


      <div class="form-floating">
         <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
            placeholder="name@example.com" autocomplete="email" required autofocus value="{{ $email ?? old('email') }}">
         @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
         @enderror
         <label for="email">Email address</label>
      </div>

      <div class="form-floating">
         <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
            placeholder="Password" required autocomplete="new-password">
         @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
         @enderror
         <label for="password">Password</label>
      </div>

      <div class="form-floating" style="margin-top: 5px">
         <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
            id="password-confirm" name="password_confirmation" placeholder="Password confirmation" required>
         @error('password_confirmation')
            <div class="invalid-feedback">{{ $message }}</div>
         @enderror
         <label for="password-confirm">Confirm Password</label>
      </div>


      <button class="w-100 btn btn-lg btn-primary btn-auth" id="btn-resetpass"
         type="submit">{{ __('Reset Password') }}</button>

      <div class="row mt-3">
         <div class="col-lg-12 text-center">
            <span class="text-muted">Already remember?</span><span>
               <a href="{{ route('login') }}" class="text-decoration-none">
                  Login here!</a></span>
         </div>
      </div>

      <p class="mt-5 mb-3 text-muted">&copy; 2021-2025</p>
   </form>
@endsection
