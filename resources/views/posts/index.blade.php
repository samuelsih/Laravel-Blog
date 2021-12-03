@extends('layout.app')

@section('content')
    @if($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div>
        <h2 class="fw-bold">Blog</h2>
        <p>This is blog i have made</p>
    </div>

    <div class="row">
        @foreach ($posts as $post)

        <div class="col-lg-4 mb-3 d-flex align-items-stretch">
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
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title">{{ $post->title }}</h5>
                  <h3>Author : {{ $post->user->name }}</h3>
                  @foreach ($post->categories as $category)
                    <span>{{ $category->name }}</span>
                  @endforeach
                  <p class="card-text mb-4">
                      {{ $post->description }}
                  </p>
                  <a href="{{ route('posts.show', ['slug' => $post->slug]) }}" class="btn btn-primary mt-auto align-self-start">Read More</a>
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

