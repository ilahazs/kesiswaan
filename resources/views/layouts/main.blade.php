<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
   {{-- <link rel="icon" href="{{ asset('img/arch.svg') }}"> --}}

   <!-- Bootstrap CSS -->
   <link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
   {{-- Bootstrap icon --}}
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

   {{-- Font Awesome --}}
   <link href="{{ asset('css/sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
   {{-- Own CSS --}}
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">


   <style>
      * {
         font-family: 'SF Compact Text';
         font-weight: 400;
      }

   </style>

   <title>{{ config('app.name') }} | {{ $title }}</title>
</head>

<body>

   @include('layouts.partials.navbar')


   <div class="container my-3">
      @yield('container')
   </div>



   <!-- Option 1: Bootstrap Bundle with Popper -->
   <script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
