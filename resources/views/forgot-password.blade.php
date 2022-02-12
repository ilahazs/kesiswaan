<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="description" content="">
   <meta name="author" content="Ilham Prabu Zaky S">
   <meta name="generator" content="Bootstrap v5">
   <title>{{ $title }} | {{ config('app.name') }}</title>

   {{-- <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/"> --}}


   <!-- Bootstrap core CSS -->
   <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
   <link rel="icon" href="{{ asset('img/logo-smkn4bdg.png') }}">


   <style>
      .bd-placeholder-img {
         font-size: 1.125rem;
         text-anchor: middle;
         -webkit-user-select: none;
         -moz-user-select: none;
         user-select: none;
      }

      @media (min-width: 768px) {
         .bd-placeholder-img-lg {
            font-size: 3.5rem;
         }
      }

      /* CSS */
      html,
      body {
         height: 100%;
      }

      body {
         display: flex;
         align-items: center;
         padding-top: 40px;
         padding-bottom: 40px;
         /* background-color: #f5f5f5; */
         /* background-image: url('../../public/img/background-auth.jpg'); */
         background-image: url('{{ asset('img/navy-blue.jpg') }}');
         background-repeat: no-repeat;
         background-attachment: fixed;
         background-size: cover;

      }

      .form-signin {
         width: 100%;
         max-width: 430px;
         padding: 15px;
         margin: auto;
      }

      .form-signin .checkbox {
         font-weight: 400;
      }

      .form-signin .form-floating:focus-within {
         z-index: 2;
      }

      .form-signin input[type="email"] {
         margin-bottom: -1px;
         border-bottom-right-radius: 0;
         border-bottom-left-radius: 0;
      }

      .form-signin input[type="password"] {
         margin-bottom: 10px;
         border-top-left-radius: 0;
         border-top-right-radius: 0;
      }

      * {
         font-family: 'SF Compact Text';
         font-weight: 500;
      }

   </style>

   <!-- Custom styles for this template -->
   <link href="signin.css" rel="stylesheet">
</head>

<body class="text-center">

   <main class="form-signin">
      <a href="{{ route('index') }}">
         <img class="mb-4" src="{{ asset('img/logo-smkn4bdg.png') }}" alt="Logo SMKN 4 Bandung" width="70"
            height="70">
      </a>
      <h1 class="h3 mb-3 fw-normal text-white">Reset Password</h1>

      @if (session()->has('status'))
         <div class="alert alert-success fade show" role="alert">
            {!! session('status') !!}
         </div>
      @endif

      @if (session()->has('statusError'))
         <div class="alert alert-danger fade show" role="alert">
            {{ session('statusError') }}
         </div>
      @endif

      <div class="description mb-3">
         <span class="text-muted">Enter your email and we'll send you a reset password link to get back into your
            account.</span>
      </div>


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

            <button class="w-100 btn btn-lg btn-primary" type="submit">{{ __('Send Password Reset Link') }}</button>
         </div>

      </form>

      <div class="row mt-3">
         <div class="col-lg-12 text-center">
            <span class="text-muted">Already remember?</span><span>
               <a href="{{ route('login') }}" class="text-decoration-none">
                  Login here!</a></span>
         </div>
      </div>

      <p class="mt-5 mb-3 text-muted">&copy; 2021-2025</p>
   </main>



</body>

</html>
