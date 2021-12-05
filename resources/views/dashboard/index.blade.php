@extends('layout.dashboard')

@section('name', $user->username)

@section('content')
    <div class="fs-2 text my-3">
        <h1>Your Posts</h1>
    </div>

    @if($user->posts->isEmpty())
        <div class="fs-4 text">
            <h3>You dont have any posts</h3>
        </div>
    @else

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Categories</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        @foreach ($user->posts as $post)
            <tr>
                <th scope="row"></th>
                <td>{{ $post->title }}</td>
                <td>{{ $post->description }}</td>

                @foreach ($post->categories as $category)
                    <td>
                        <ol>
                            <li>{{ $category->name }}</li>
                        </ol>
                    </td>
                @endforeach

                <td>
                    <a href="#" class="btn btn-primary">Action</a>
                </td>
            </tr>
        @endforeach

        <tbody>
            <tr>
                <th scope="row"></th>
            </tr>
        </tbody>
    </table>

    @endif





@endsection
