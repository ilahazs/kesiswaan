@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard') }}" class="text-decoration-none">Home</a>
   </li>
   <li class="breadcrumb-item" aria-current="page">
      <a href="{{ route('dashboard.posts.index') }}"
         class="text-decoration-none {{ Request::is('dashboard/posts') ? 'text-secondary' : '' }}">{{ $title }}</a>
   </li>
@endsection
@section('container')

   @if (session('success'))
      <div class="col-lg-11">
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {!! session('success') !!}
         </div>
      </div>
   @endif

   <div class="table-responsive mt-3 col-lg-11">
      <a href="{{ route('dashboard.posts.create') }}" class="btn btn-primary mb-3">Create new post</a>

      <table class="table table-bordered table-sm">
         <thead>
            <tr>
               <th scope="col">#</th>
               <th scope="col">Title</th>
               <th scope="col">Category</th>
               <th scope="col">Updated</th>
               <th scope="col">Action</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($posts as $post)
               <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $post->title }}</td>
                  <td>{{ $post->category->name }}</td>
                  <td>{{ $post->updated_at->diffForHumans() }}</td>
                  <td class="d-flex justify-content-evenly">
                     <a href="{{ route('dashboard.posts.show', $post->slug) }}"
                        class="badge bg-primary text-decoration-none text-white px-2">
                        <span data-feather="eye"></span>
                     </a>
                     <a href="{{ route('dashboard.posts.edit', $post->slug) }}"
                        class="badge bg-success text-decoration-none text-white px-2">
                        <span data-feather="edit"></span>
                     </a>
                     <form action="{{ route('dashboard.posts.destroy', $post->slug) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button class="badge btn-danger text-decoration-none text-white px-2 border-0"
                           onclick="return confirm('yes/no?')"><span data-feather="trash-2"></span></button>

                     </form>
                  </td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </div>

@endsection
