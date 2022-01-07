@extends('dashboard.layouts.main')
@section('heading-title', $title)
@section('breadcrumb')
   <li class="breadcrumb-item">
      <a href="{{ route('dashboard') }}" class="text-decoration-none">Home</a>
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

   <div class="row mb-5">
      <div class="col-lg-8">
         <form method="POST" action="{{ route('dashboard.posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
               <label for="title" class="form-label">Title</label>
               <input type="text"
                  class="form-control @error('title')
                  is-invalid
               @enderror" id="title"
                  name="title" value="{{ old('title') }}">
               @error('title')
                  <div class="invalid-feedback">
                     {{ $message }}
                  </div>
               @enderror
            </div>
            <div class="mb-3">
               <label for="slug" class="form-label">Slug</label>
               <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                  value="{{ old('slug') }}" readonly>
               @error('slug')
                  <div class="invalid-feedback">
                     {{ $message }}
                  </div>
               @enderror
            </div>
            <div class="mb-3">
               <label for="category" class="form-label">Category</label>
               <select class="form-control" name="category_id" id="category">
                  <option disabled selected>Select Category</option>
                  @foreach ($categories as $category)
                     @if (old('category_id') == $category->id)
                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                     @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                     @endif
                  @endforeach
               </select>
            </div>
            {{-- File Input --}}
            <div class="mb-3">
               <label for="image" class="form-label">Image</label>
               <img class="img-preview img-fluid mb-3 col-sm-5">
               <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image"
                  onchange="previewImage()">
               @error('image')
                  <div class="invalid-feedback">
                     {{ $message }}
                  </div>
               @enderror
            </div>
            <div class="mb-3">
               <label for="body" class="form-label">Body</label>
               @error('body')
                  <p class="text-danger">{{ $message }}</p>
               @enderror
               <input id="body" type="hidden" name="body" value="{{ old('body') }}">
               <trix-editor input="body"></trix-editor>
            </div>


            <button type="submit" class="btn btn-primary px-4">Save</button>
         </form>
      </div>
   </div>

   <script text="javascript">
      const title = document.querySelector('#title');
      const slug = document.querySelector('#slug');

      title.addEventListener('change', function() {
         fetch('{{ route('dashboard.posts.checkSlug') }}?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
      });

      document.addEventListener('trix-file-accept', function(e) {
         e.preventDefault();
      })

      function previewImage() {
         const image = document.querySelector('#image');
         const imagePreview = document.querySelector('.img-preview');

         imagePreview.style.display = 'block';

         const OFReader = new FileReader();
         OFReader.readAsDataURL(image.files[0]);

         OFReader.onload = function(OFREvent) {
            imagePreview.src = OFREvent.target.result;
         }
      }
   </script>


@endsection
