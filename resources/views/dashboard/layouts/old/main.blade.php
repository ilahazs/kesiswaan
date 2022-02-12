<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="description" content="">
   <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
   <meta name="generator" content="Hugo 0.84.0">
   <title> {{ $title . ' | ' . config('app.name') }}</title>
   {{-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css"> --}}

   <!-- Bootstrap core CSS -->
   <link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
   {{-- Trix Editor --}}
   <link rel="stylesheet" href="{{ asset('assets/trix/trix.css') }}">
   {{-- Own CSS --}}
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   <style>
      * {
         font-family: 'SF Compact Text';
         font-weight: 400;
      }


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

      /* Trix Editor: remove link file form */
      trix-toolbar [data-trix-button-group="file-tools"] {
         display: none;
      }

   </style>


   <!-- Custom styles for this template -->
   <link href="{{ asset('assets/dashboard/dashboard.css') }}" rel="stylesheet">
</head>

<body>


   @include('dashboard.layouts.header')


   {{-- <span class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio doloremque iusto quis
      suscipit harum, quod et deleniti tempore necessitatibus cumque possimus consequatur recusandae a accusantium sunt
      distinctio minima qui ea?</span> --}}

   <div class="container-fluid">
      <div class="row">

         @include('dashboard.layouts.sidebar')

         <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="pt-3 border-bottom-0">
               <ol class="breadcrumb">
                  @yield('breadcrumb')
               </ol>
            </nav>

            {{-- <div
               class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">




            </div> --}}
            {{-- <div class="border-bottom mb-3"> --}}
            <h1 class="h2">@yield('heading-title')</h1>
            {{-- </div> --}}
            <hr>


            @yield('container')


         </main>


      </div>
   </div>


   {{-- Trix Editor --}}
   <script src="{{ asset('assets/trix/trix.js') }}"></script>
   {{-- Bootstrap --}}
   <script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
   <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
      integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
   {{-- Jquery --}}
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

   {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
      integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script> --}}
   {{-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script> --}}

   <script src="{{ asset('assets/dashboard/dashboard.js') }}"></script>
</body>

</html>
