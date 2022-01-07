@extends('layouts.main')
@section('container')


   <div class="container">
      <div class="row justify-content-center mb-5">
         <div class="col-md-8">
            <h1 class="mb-4">{{ $post->title }}</h1>

            <p>By.
               <a href="/posts?category={{ $post->author->username }}"
                  class="text-decoration-none">{{ $post->author->name }}
               </a> in
               <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none">
                  {{ $post->category->name }}
               </a>
            </p>

            @if ($post->image)
               <div style="max-height: 350px; overflow: hidden;">
                  <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="Image post">
               </div>
            @else
               <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" class="img-fluid"
                  alt="Image post">
            @endif

            <article class="my-2 fs-6">
               {!! $post->body !!}
            </article>

            <div class="d-flex justify-content-end">
               <a href="{{ route('posts.index') }}" class="text-decoration-none text-white badge bg-primary">Back to
                  all</a>
            </div>
         </div>
      </div>
   </div>




   <hr>
@endsection
