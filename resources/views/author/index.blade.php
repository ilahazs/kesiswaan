@extends('layouts.main')
@section('container')
   <h1 class="mb-3">All User</h1>
   <hr>
   <div class="list-group my-3">

      @foreach ($users->skip(1) as $user)
         <a href="/posts?author={{ $user->username }}"
            class="list-group-item list-group-item-action d-flex justify-content-between">
            {{ $user->name }}
            <span class="badge rounded-pill bg-primary px-3">{{ $user->posts->count() }}</span>

         </a>


      @endforeach
   </div>

@endsection
