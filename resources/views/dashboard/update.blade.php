@extends('layout.form')

@section('method', $method)

@section('form')
    <div class="col-lg-8">
        <form
        method="post"
        action="{{ route('posts.update', ['username' => Auth::user()->username, 'post' => $post->slug]) }}"
        enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')
            @error('title')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
            <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $post->title }}" required>
            <div id="text__title" class="form-text">e.g : Cara Memasukkan Gajah ke Dalam Kulkas</div>
            </div>

            @error('slug')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
            <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ $post->slug }}" required>
            <div id="text__slug" class="form-text">e.g : noob-master-69</div>
            </div>

            @error('image')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input class="form-control" type="file" id="image" name="image">
                <div id="text__slug" class="form-text">Max : 2 mb</div>
            </div>

            @error('description')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" rows="2" class="form-control" required>{{ $post->description }}</textarea>
            </div>


            @error('categories')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="category" class="form-label">Categories</label>
                <select class="form-select" name="category">
                    @foreach ($categories as $category)
                        <option
                        value={{ $category->name }}>{{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            @if($message = Session::get('error'))
                <div class="text-danger mb-3">{{ $message }}</div>
            @endif

            @error('content')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <input id="content" type="hidden" name="content">
                <trix-editor input="content">{!! $post->content !!}</trix-editor>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
