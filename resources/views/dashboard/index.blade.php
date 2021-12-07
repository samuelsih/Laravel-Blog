@extends('layout.dashboard')

@section('content')
    <div class="fs-2 text my-3">
        <h1>Your Posts</h1>
    </div>

    @if($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    @elseif($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(count($posts) <= 0)
        <h3>You dont have any posts</h3>

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

            @foreach ($posts as $post)
                <tr>
                    <th scope="row">
                        {{ $loop->index + 1 }}
                    </th>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->description }}</td>

                    <td>{{ $post->category->name }}</td>

                    <td>
                        <a
                            href="{{ route('posts.edit', ['username' => $post->user->username, 'post' => $post->slug]) }}"
                            class="btn btn-success me-3"
                        >
                            Edit
                        </a>
                        <form action="{{ route('posts.destroy', ['username' => $post->user->username, 'post' => $post->slug]) }}" method="post" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-warning">Delete</button>
                        </form>

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
