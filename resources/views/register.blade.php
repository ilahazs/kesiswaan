<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="description" content="">
   <meta name="author" content="Ilham Prabu Zaky S">
   <meta name="generator" content="Bootstrap v5">
   <title>{{ $title }} | {{ config('app.name') }}</title>

   <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">



   <!-- Bootstrap core CSS -->
   <link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">

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
         background-color: #f5f5f5;
      }

      .form-signin {
         width: 100%;
         max-width: 330px;
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
      <h1 class="h3 mb-3 fw-normal">Please register</h1>

      <form action="{{ route('register-authenticate') }}" method="POST">
         @csrf
         <div class="form-floating">
            <input type="text" id="name" name="name" placeholder="Your name"
               class="form-control @error('name') is-invalid @enderror" required value="{{ old('name') }}">
            @error('name')
               <div class="invalid-feedback">
                  {{ $message }}
               </div>
            @enderror
            <label for="name">Name</label>
         </div>
         <div class="form-floating">
            <input type="email" id="email" name="email" placeholder="name@example.com"
               class="form-control @error('email') is-invalid @enderror" required value="{{ old('email') }}">
            @error('email')
               <div class="invalid-feedback">
                  {{ $message }}
               </div>
            @enderror
            <label for="email">Email address</label>
         </div>
         <div class="form-floating">
            <input type="password" id="password" name="password" placeholder="Password"
               class="form-control @error('password') is-invalid @enderror" required value="{{ old('password') }}">
            @error('password')
               <div class="invalid-feedback">
                  {{ $message }}
               </div>
            @enderror
            <label for="password">Password</label>
         </div>

         <div class="row mb-3">
            <div class="col-lg-12 text-center">
               <span>Already
                  registered? <a href="{{ route('login') }}" class="text-decoration-none">
                     Login here!</a></span>
            </div>
         </div>
         <button class="w-100 btn btn-lg btn-primary" type="submit">Send</button>
      </form>

      <p class="mt-5 mb-3 text-muted">&copy; 2021-2025</p>
   </main>



</body>

</html>
