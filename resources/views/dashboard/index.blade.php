@extends('dashboard.layouts.main')
@section('heading-title', 'Welcome back, ' . Auth::user()->name)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard.index') }}" class="text-decoration-none text-secondary">Home</a>
   </li>
@endsection
@section('container')


   {{-- <div class="table-responsive mt-4">
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
                  <td>{{ $post->title }}</td>
                  <td>{{ $post->category->name }}</td>
                  <td>{{ $post->updated_at->diffForHumans() }}</td>
                  <td>{{ $post->title }}</td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </div> --}}

@endsection
