<!DOCTYPE html>
<html lang="en">

<head>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">

   <title>{{ config('app.name') }} | {{ __('Dashboard') }}</title>

   <!-- Custom fonts for this template-->
   <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/all.min.css') }}">
   <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Poppins:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Inter:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
   {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600&display=swap"
      rel="stylesheet"> --}}
   {{-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> --}}
   <link rel="stylesheet" href="{{ asset('assets/line-awesome/css/line-awesome.min.css') }}">
   {{-- <link rel="stylesheet" href="path/to/line-awesome/css/line-awesome-font-awesome.min.css"> --}}

   <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
   <link rel="icon" href="{{ asset('img/logo-smkn4bdg.png') }}">

   <!-- Custom styles for this template-->
   <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
   {{-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> --}}
   {{-- <link href="{{ asset('assets/css/sb-admin-2.css') }}" rel="stylesheet"> --}}
   @toastr_css
   <style>
      body #toast-container>div {
         opacity: .9;
      }

      .btn-new-data {
         margin: 0 0 1px 10px;
      }

   </style>
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body id="page-top">

   <!-- Page Wrapper -->
   <div id="wrapper">

      <!-- Sidebar -->
      @include('dashboard.layouts.sidebar')
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

         <!-- Main Content -->
         <div id="content">

            <!-- Topbar -->
            @include('dashboard.layouts.header')
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

               <!-- Page Heading -->
               <div class="d-sm-flex align-items-center justify-content-between mb-4">
                  <h1 class="h3 mb-0 text-gray-800">@yield('heading-title')</h1>
                  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Simpan PDF</a>
               </div>

               @yield('flash-message')

               {{-- Breadcrumb --}}
               <div class="x-breadcrumb">
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb bg-white shadow-sm">
                        @yield('breadcrumb')

                     </ol>
                  </nav>
               </div>

               @yield('container')



            </div>
            <!-- /.container-fluid -->

         </div>
         <!-- End of Main Content -->

         <!-- Footer -->
         {{-- @include('dashboard.layouts.footer') --}}
         <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

   </div>
   <!-- End of Page Wrapper -->

   <!-- Scroll to Top Button-->
   <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
   </a>

   <!-- Logout Modal-->
   @include('dashboard.layouts.modal.logout')





   <!-- Bootstrap core JavaScript-->
   <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
   <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   {{-- <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script> --}}

   <!-- Core plugin JavaScript-->
   <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

   <!-- Custom scripts for all pages-->
   <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

   <!-- Page level plugins -->
   <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>

   <!-- Page level custom scripts -->
   <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>
   <script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script>

</body>

@jquery
@toastr_js
@toastr_render

</html>
