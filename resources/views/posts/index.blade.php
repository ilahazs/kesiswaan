@extends('layouts.main')
@section('container')
   <h1 class="mb-3 text-center">{{ $title }}</h1>

   <div class="row justify-content-center my-3">
      <div class="col-md-6">
         <form action="/posts" method="get">
            @if (request('category'))
               <input type="hidden" name="category" value="{{ request('category') }}">
            @elseif (request('author'))
               <input type="hidden" name="author" value="{{ request('author') }}">
            @endif
            <div class="input-group mb-3">
               <input type="text" class="form-control" placeholder="Search data ..." name="search"
                  value="{{ request('search') }}">
               <button class="btn btn-outline-primary" type="submit">Search</button>
            </div>
         </form>
      </div>
   </div>

   <hr class="mb-3">
   <div class="d-flex justify-content-end">
      {{ $posts->links() }}
   </div>





   @if ($posts->count())
      <div class="card mb-3">
         @if ($posts[0]->image)
            <div style="max-height: 350px; overflow: hidden;">
               <img src="{{ asset('storage/' . $posts[0]->image) }}" class="img-fluid" alt="Image post">
            </div>
         @else
            <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" class="card-img-top"
               alt="Image post">
         @endif

         <div class="card-body text-center">
            <h5 class="card-title"><a href="{{ route('posts.show', $posts[0]->slug) }}"
                  class="text-decoration-none text-dark">{{ $posts[0]->title }}</a></h5>
            <small class="text-muted">By.
               <a href="/posts?author={{ $posts[0]->author->username }}"
                  class="text-decoration-none">{{ $posts[0]->author->name }}</a> in
               <a href="/posts?category={{ $posts[0]->category->slug }}"
                  class="text-decoration-none">{{ $posts[0]->category->name }}</a>
               {{ ' - ' . $posts[0]->created_at->diffForHumans() }}
            </small>

            <article>
               {!! Str::limit($posts[0]->body, 150, '...') !!}
            </article>

            <a href="{{ route('posts.show', $posts[0]->slug) }}" class="btn btn-primary"
               style="padding: 8px 50px; border-radius: 25px">Read
               more</a>
         </div>
      </div>

      <div class="container">
         <div class="row">
            @foreach ($posts->skip(1) as $post)
               <div class="col-md-4 mb-3">
                  <div class="card">
                     <div class="position-absolute text-white px-3 py-2"
                        style="background-color: rgba(0, 0, 0, 0.8); border-radius: 0 10px 10px 0">
                        <a href="/posts?category={{ $post->category->slug }}"
                           class="text-decoration-none text-white">{{ $post->category->name }}</a>
                     </div>

                     @if ($post->image)
                        <div style="max-height: 115px; overflow: hidden;">
                           <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="Image post">
                        </div>
                     @else
                        <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}"
                           class="card-img-top" alt="Image post">
                     @endif


                     <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <small class="text-muted">By. <a href="/posts?author={{ $post->author->username }}"
                              class="text-decoration-none">{{ $post->author->name }}</a> in
                           <a href="/posts?category={{ $post->category->slug }}"
                              class="text-decoration-none">{{ $post->category->name }}</a>
                           <br>
                           <span> {{ $post->created_at->diffForHumans() }}</span>
                        </small>
                        <article class="my-2">
                           {!! Str::limit($post->body, 70, '...') !!}
                        </article>
                        <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-primary">Read more</a>
                     </div>
                  </div>
               </div>
            @endforeach


         </div>
      </div>

   @else
      <p class="text-center fs-4">{{ __('Postingan kosong') }}</p>
   @endif




   {{-- <article class="border-bottom py-3">
      <div class="row">
         <div class="col-md-10">
            <h3>{{ $post->title }}</h3>
         </div>
         <div class="col-md-2">
            <div class="d-flex justify-content-end">
               <a href="{{ route('user.detail', $post->author->username) }}"
                  class="badge bg-primary text-decoration-none text-light mt-2 mx-1"
                  style="border: 1px solid black;">{{ $post->author->name }}</a>
               <a href="{{ route('category.detail', $post->category->slug) }}"
                  class="badge bg-success text-decoration-none text-light mt-2 mx-1"
                  style="border: 1px solid black;">{{ $post->category->name }}</a>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-10">
            {!! Str::limit($post->body, 125, ' ...') !!}
         </div>
         <div class="col-md-2">
            <div class="d-flex justify-content-end mt-1">
               <a href="{{ route('posts.show', $post->slug) }}" class="text-decoration-none">Show detail</a>
            </div>
         </div>
      </div>
   </article> --}}
@endsection
