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
         max-width: 380px;
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
      <h1 class="h3 mb-2 fw-normal text-white">{{ config('app.name') }}</h1>

      <div class="description mb-3">
         <span class="text-muted">Enter your credentials and start using our service to manage your data.</span>
      </div>

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

      <form action="{{ route('login-authenticate') }}" method="POST">
         @csrf
         <div class="form-floating">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
               placeholder="name@example.com" required autofocus value="{{ old('email') }}">
            @error('email')
               <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="email">Email address</label>
         </div>

         <div class="form-floating">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
               name="password" placeholder="Password" required autofocus value="{{ old('password') }}">
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

         <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
      </form>

      {{-- <div class="row mt-3">
         <div class="col-lg-12 text-center">
            <span>Doesn't have account?
               <a href="{{ route('register') }}" class="text-decoration-none">
                  Register here!</a></span>
         </div>
      </div> --}}
      <p class="mt-5 mb-3 text-muted">&copy; 2021-2025</p>


   </main>


</body>

</html>
