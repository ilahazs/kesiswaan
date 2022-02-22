@extends('auth')
@section('description')
   <div class="description mb-3">
      <span class="text-muted">Enter your email and we'll send you a reset password link to get back into your
         account.</span>
   </div>
@endsection
@section('container')
   <form action="{{ route('password.email') }}" method="POST">
      @csrf
      <div class="form-floating">
         <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
            placeholder="name@example.com" autocomplete="email" required autofocus value="{{ old('email') }}">
         @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
         @enderror
         <label for="email">Email address</label>
      </div>



      <div class="mt-3">

         <button class="w-100 btn btn-lg btn-primary btn-auth" id="btn-forgotpass"
            type="submit">{{ __('Send Password Reset Link') }}</button>
      </div>

   </form>

   <div class="row mt-3">
      <div class="col-lg-12 text-center">
         <span class="text-muted">Already remember?</span><span>
            <a href="{{ route('login') }}" class="text-decoration-none">
               Login here!</a></span>
      </div>
   </div>
@endsection
