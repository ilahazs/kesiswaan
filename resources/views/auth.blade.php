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

      input:-webkit-autofill {
         background-color: #202f6b !important;
         background-image: none !important;
         color: #000000 !important;
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
         background-image: url('{{ asset('img/bg-auth.jpg') }}');
         background-repeat: no-repeat;
         background-attachment: fixed;
         background-size: cover;

      }

      .form-signin {
         width: 100%;
         max-width: 420px;
         padding: 15px;
         margin: auto;
      }

      .form-signin .checkbox {
         font-weight: 400;
      }

      .form-signin .form-floating:focus-within {
         z-index: 2;
      }

      .form-floating input {
         border: 0px rgb(10, 0, 68) solid
      }

      .form-floating input:active {
         border: 0px rgb(10, 0, 68) solid;
         box-shadow: 3px 2px 22px 1px rgba(0, 0, 0, 0.24);
      }

      .form-floating input[type="text"] {
         border-bottom: 2px rgb(77, 77, 77) solid;
      }

      .form-floating input:focus {
         border: 0px rgb(0, 0, 0) solid;
         box-shadow: 3px 2px 22px 1px rgba(0, 0, 0, 0.24);

      }

      .form-floating input:-webkit-autofill {
         /* -webkit-box-shadow: 200px 200px 100px white inset; */
         /* box-shadow: 200px 200px 100px white inset; */
         background-color: #282e54;

      }

      .form-signin input[type="email"],
      .form-signin input[type="text"] {
         margin-bottom: -0.5px;
         border-bottom-right-radius: 0;
         border-bottom-left-radius: 0;
         background-color: #2d324f;
         /* background-color: rgba(19, 0, 89, 0.761); */
         opacity: .7;
         color: white;

      }

      .form-signin input[type="password"] {
         margin-bottom: 10px;
         border-top-left-radius: 0;
         border-top-right-radius: 0;
         /* background-color: rgba(19, 0, 89, 0.761); */
         background-color: #2d324f;

         opacity: .7;
         color: white;
      }

      .form-signin .form-floating:focus-within {
         color: rgb(0, 0, 0);
      }

      .form-signin .form-floating {
         color: rgb(0, 0, 0);
      }

      .form-signin .form-floating label {
         color: rgb(165, 165, 165);
      }

      .form-signin .form-floating:focus label {
         color: rgb(0, 0, 0);
      }

      .form-floating>.form-control:-webkit-autofill~label {
         /* opacity: 1; */
         color: #000000;
         transform: scale(.85) translateY(-.5rem) translateX(.15rem)
      }


      .form-floating>.form-control:-webkit-autofill {
         padding-top: 1.625rem;
         padding-bottom: .625rem;
         background-color: rgb(72, 79, 123)
      }


      .btn-auth {
         border-radius: 15px;
         background-color: rgb(17, 0, 112);
         border: 1px rgb(11, 0, 73) solid;
      }

      .btn-auth:active {
         transform: scale(0.98);
         /* Scaling button to 0.98 to its original size */
         box-shadow: 3px 2px 22px 1px rgba(0, 0, 0, 0.24);
         border: 1px rgb(20, 10, 73) solid;
         background-color: rgb(23, 0, 153);

         /* Lowering the shadow */
      }


      * {
         font-family: Poppins, 'SF Compact Text';
         font-weight: 500;
      }

      /* FLASH MESSAGE STYLING */
      .fade {
         transition: opacity .2s linear;
      }

      .show {
         transition: .5s;
      }

      /* BTN STYLING */


      .btn-auth:hover {
         transition: .5s;
         background-color: rgba(22, 0, 146, 0.707);
      }


      .btn-primary {
         color: #fff;
         background-color: #04285e;

         border-color: #15325e
      }

      .btn-primary:hover {
         color: #fff;
         background-color: #04214d;
         border-color: #0b254d
      }

      .btn-check:focus+.btn-primary,
      .btn-primary:focus {
         color: #fff;
         background-color: #0a274d;

         border-color: #011e49;
         box-shadow: 0 0 0 .25rem rgba(11, 44, 75, 0.645)
      }

      .btn-check:active+.btn-primary,
      .btn-check:checked+.btn-primary,
      .btn-primary.active,
      .btn-primary:active,
      .show>.btn-primary.dropdown-toggle {
         color: #fff;
         background-color: #04214d;
         border-color: #0b2449
      }

      .btn-check:active+.btn-primary:focus,
      .btn-check:checked+.btn-primary:focus,
      .btn-primary.active:focus,
      .btn-primary:active:focus,
      .show>.btn-primary.dropdown-toggle:focus {
         box-shadow: 0 0 0 .15rem rgba(11, 60, 75, 0.645)
      }

      /* .btn-primary.disabled,
      .btn-primary:disabled {
         color: #fff;
         background-color: #05234f;
         border-color: #052659
      } */

      #btn-forgotpass {
         border-radius: 10px;
      }

      #btn-resetpass {
         border-radius: 10px;
      }

   </style>

   <!-- Custom styles for this template -->
   <link href="signin.css" rel="stylesheet">
</head>

<body class="text-center">

   <main class="form-signin">
      <a href="{{ route('index') }}">
         <img class="mb-4" src="{{ asset('img/logo-smkn4bdg.png') }}" alt="Logo SMKN 4 Bandung" width="120"
            height="120">
      </a>
      <h1 class="h3 mb-2 fw-normal text-white">{{ $title }}</h1>

      @yield('description')
      {{-- @if (session()->has('status'))
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            {!! session('status') !!}
            <button type="button" class="btn-close close" data-bs-dismiss="alert" aria-label="Close"><span
                  aria-hidden="true">×</span></button>
         </div>
      @endif --}}

      @if (session('fails'))
         <div class="col-lg-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
               {!! session('fails') !!}
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         </div>
      @endif

      @if (session('status'))
         <div class="col-lg-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               {!! session('status') !!}
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         </div>
      @endif

      @yield('container')

      <p class="mt-5 mb-3 text-muted">&copy; 2021-2025</p>


   </main>
   {{-- <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script> --}}
   {{-- <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script> --}}

   {{-- <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
   {{-- <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script> --}}
   <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
