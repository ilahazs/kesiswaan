@extends('layouts.main')
@section('container')
   @if (session()->has('status-role'))
      <div class="alert alert-danger fade show" role="alert">
         {!! session('status-role') !!}
      </div>
   @endif

   <style>
      button.btn-reverse-outline-dark {
         background-color: #000;
         color: white;
         padding: 5px 20px;
         font-weight: bold;
         border: 2px solid rgb(105, 105, 105);
         border-radius: 10px;
         transition: 0.3s;
      }

      button.btn-reverse-outline-dark:hover {
         background-color: #fff;
         color: rgb(0, 0, 0);
         padding: 5px 10px;
         font-weight: bold;
         border: 2px solid #000;
      }

   </style>


   <h1>Home Page</h1>
   <hr>
   <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus voluptas incidunt qui ducimus totam enim veniam
      voluptates dolorum modi at magnam, repellat commodi, rem illum numquam tenetur porro quas perferendis sint molestiae.
      Provident odio vel possimus obcaecati dicta consectetur eligendi ipsum consequatur praesentium sed dignissimos, quam
      iste sunt, corporis nam.</p>
   <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus voluptas incidunt qui ducimus totam enim veniam
      voluptates dolorum modi at magnam, repellat commodi, rem illum numquam tenetur porro quas perferendis sint molestiae.
      Provident odio vel possimus obcaecati dicta consectetur eligendi ipsum consequatur praesentium sed dignissimos, quam
      iste sunt, corporis nam.</p>

   <button type="button" class="btn-reverse-outline-dark mt-3" data-bs-toggle="tooltip" data-bs-placement="left"
      title="Sign in for features">
      Hello @auth
         {{ Auth::user()->name }}
      @else World
      @endauth!
   </button>
@endsection
