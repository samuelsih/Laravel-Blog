@extends('layout.dashboard')

{{-- karna ada stack di dashboard layout, kita push apa yang kita mau di section trix-editor --}}
@push('trix-editor-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/trix.css') }}">
@endpush

@section('content')
    <div class="text my-3 border-bottom">
        <h2>Create a New Post</h2>
    </div>

    <div class="col-lg-8">
        <form method="post" action="{{ route('posts.store', Auth::user()->username) }}">
            @csrf
            @error('title')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required>
              <div id="text__title" class="form-text">e.g : Cara Memasukkan Gajah ke Dalam Kulkas</div>
            </div>

            @error('slug')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
            <div class="mb-3">
              <label for="slug" class="form-label">Slug</label>
              <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" required>
              <div id="text__slug" class="form-text">e.g : noob-master-69</div>
            </div>

            @error('description')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" rows="2" class="form-control" required>
                    {{ old('description') ?? '' }}
                </textarea>
            </div>


            @error('categories')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="categories" class="form-label">Categories</label>
                <ul class="list-group">
                    @foreach ($categories as $category)
                        <li class="list-group-item"><input type="checkbox" name="name[]" value="{{ $category->name }}"> {{ $category->name }} </li>
                    @endforeach
                </ul>
            </div>
            @if($message = Session::get('error'))
                <div class="text-danger mb-3">{{ $message }}</div>
            @endif

            @error('content')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <p>Content</p>
                <input id="content" type="hidden" name="content">
                <trix-editor input="content"></trix-editor>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
          </form>
    </div>

    @push('trix-editor-js')
        <script type="text/javascript" src="{{ asset('js/trix.js') }}"></script>
    @endpush

@endsection
