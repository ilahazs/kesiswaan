@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('dashboard.posts.index') }}" class="text-decoration-none">All Post</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('dashboard.posts.index') }}"
         class="text-decoration-none {{ Request::is('dashboard/posts/*') ? 'text-secondary' : '' }}">{{ $title }}</a>
   </li>
@endsection
@section('container')


   <div class="container">
      <div class="row justify-content-center mb-5">
         <div class="col-lg-11">
            <h1 class="mb-4">{{ $post->title }}</h1>

            @auth
               @if (Auth::user()->role == 'admin')
                  <p>By.
                     <a href="/posts?category={{ $post->author->username }}"
                        class="text-decoration-none">{{ $post->author->name }}
                     </a> in
                     <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none">
                        {{ $post->category->name }}
                     </a>
                  </p>

                  <div class="row mb-3 justify-content-end">
                     <div class="col-12">
                        <a href="{{ route('dashboard.posts.index') }}" class="btn btn-primary"><span
                              data-feather="arrow-left" style="margin-right: 5px"></span>Back to all my posts</a>
                        <a href="{{ route('dashboard.posts.edit', $post->slug) }}" class="btn btn-success"><span
                              data-feather="edit" style="margin-right: 5px"></span>Edit</a>
                        <form action="{{ route('dashboard.posts.destroy', $post->slug) }}" method="POST"
                           class="d-inline">
                           @method('delete')
                           @csrf
                           <button class="btn btn-danger text-decoration-none text-white" style="margin-right: 5px"
                              onclick="return confirm('yes/no?')"><span data-feather="trash-2"
                                 class="me-2 "></span>Delete</button>

                        </form>
                        {{-- <a href="{{ route('dashboard.posts.destroy', $post->slug) }}" class="btn btn-danger   "><span
                              data-feather="trash-2" style="margin-right: 5px"></span>Delete</a> --}}
                     </div>
                  </div>
               @else

                  <div class="row mb-3 justify-content-end">
                     <div class="col">
                        <a href="{{ route('dashboard.posts.index') }}" class="btn btn-primary"><span
                              data-feather="arrow-left" style="margin-right: 5px"></span>Back to all my posts</a>
                        <a href="{{ route('dashboard.posts.edit', $post->slug) }}" class="btn btn-success"><span
                              data-feather="edit" style="margin-right: 5px"></span>Edit</a>
                        <a href="{{ route('dashboard.posts.destroy', $post->slug) }}" class="btn btn-danger   "><span
                              data-feather="trash-2" style="margin-right: 5px"></span>Delete</a>
                     </div>
                  </div>
               @endif
            @endauth

            @if ($post->image)
               <div style="max-height: 350px; overflow: hidden;">
                  <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="Image post">
               </div>
            @else
               <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" class="img-fluid"
                  alt="Image post">
            @endif

            <article class="mt-2 mb-5 fs-6">
               {!! $post->body !!}
            </article>

            <div class="d-flex justify-content-end">
               <a href="{{ route('dashboard.posts.index') }}" class="text-decoration-none text-white btn btn-primary"
                  style="border-radius: 15px">Back to
                  all</a>
            </div>
         </div>
      </div>
   </div>

@endsection
