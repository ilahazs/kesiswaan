<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <link rel="icon" href="{{ asset('img/logo-smkn4bdg.png') }}">
   <!-- Bootstrap CSS -->
   <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
   {{-- Bootstrap icon --}}
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

   {{-- Own CSS --}}
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">

   <title>{{ config('app.name') }} | {{ $title }}</title>
</head>

<body>

   @include('layouts.partials.navbar')


   <div class="container my-3">
      @yield('container')
   </div>



   <!-- Option 1: Bootstrap Bundle with Popper -->
   <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
</body>

</html>
