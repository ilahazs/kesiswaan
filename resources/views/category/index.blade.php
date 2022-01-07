@extends('layouts.main')
@section('container')
   <h1 class="mb-3">All category</h1>
   <hr>

   <div class="container">
      <div class="row">
         @foreach ($categories as $category)
            <div class="col-md-4">
               <a href="/posts?category={{ $category->slug }}">
                  <div class="card bg-dark text-white">
                     <img src="https://source.unsplash.com/1200x400?{{ $category->name }}" class="card-img"
                        alt="Category Image">
                     <div class="card-img-overlay d-flex align-items-center p-0">
                        <h5 class="card-title text-center flex-fill px-4 py-2" style="background-color: rgba(0, 0, 0, 0.7)">
                           {{ $category->name }}
                        </h5>
                     </div>
                  </div>
               </a>
            </div>
         @endforeach
      </div>
   </div>


   <div class="list-group my-3">

      @foreach ($categories as $category)
         <a href="/posts?category={{ $category->slug }}"
            class="list-group-item list-group-item-action d-flex justify-content-between">{{ $category->name }}
            <span class="badge rounded-pill bg-primary px-3">{{ $category->posts->count() }}</span>
         </a>


      @endforeach
   </div>

@endsection
