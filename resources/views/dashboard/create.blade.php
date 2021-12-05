@extends('layout.dashboard')

@section('name', $user)

@section('content')
    <div class="text my-3 border-bottom">
        <h2>Create a New Post</h2>
    </div>

    <div class="col-lg-8">
        <form method="post" action="{{ route('posts.store', Auth::user()->username) }}">
            @csrf
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp" placeholder="e.g. : Cara Memasukkan Gajah ke Dalam Kulkas">
            </div>
            <div class="mb-3">
              <label for="slug" class="form-label">Slug</label>
              <input type="text" class="form-control" id="slug" name="slug" placeholder="e.g. : noob-master-69">
            </div>

            <div class="mb-3">
                <label for="categories" class="form-label">Categories</label>
                <ul class="list-group">
                    <li class="list-group-item"><input type="checkbox" name="categories[]" value="random"> Random </li>
                    <li class="list-group-item"><input type="checkbox" name="categories[]" value="technology"> Technology</li>
                    <li class="list-group-item"><input type="checkbox" name="categories[]" value="tutorial"> Tutorial</li>
                </ul>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
          </form>
    </div>



@endsection
