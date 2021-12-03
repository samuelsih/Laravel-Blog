@extends('layout.app')

@section('content')
    <div>
        <h2 class="fw-bold">Blog</h2>
        <p>This is blog i have made</p>
    </div>

    <div class="row">
        @foreach ($posts as $post)

        <div class="col-4">
            <div class="card">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                  <img
                    src="https://mdbootstrap.com/img/new/standard/nature/111.jpg"
                    class="img-fluid"
                  />
                  <a href="#">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                  </a>
                </div>
                <div class="card-body">
                  <h5 class="card-title">{{ $post->title }}</h5>
                  @foreach ($post->categories as $category)
                    <span>{{ $category->name }}</span>
                  @endforeach
                  <p class="card-text">
                      {{ $post->content }}
                  </p>
                  <a href="{{ route('posts.show', ['slug' => $post->slug]) }}" class="btn btn-primary">Read More</a>
                </div>
              </div>
        </div>

        @endforeach
    </div>

    {{-- @foreach ($posts as $post)
        <tr>
            <td> Post -> title :  {{ $post->title }}</td>
            <td> Post -> slug {{ $post->slug }}</td>
            <td>
                <ul>
                    @foreach ($post->categories as $category)
                        <li>{{ $category->name }}</li>
                    @endforeach
                </ul>
            </td>
        </tr>
    @endforeach --}}

@endsection

