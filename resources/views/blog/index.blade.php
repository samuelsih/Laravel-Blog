@extends('layout.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
@endpush

@section('content')
    @if($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @else

    @endif

    <div>
        <h2 class="fw-bold">Blog</h2>
        <div class="d-flex flex-row align-items-center input-group">
            <p class="me-3 pt-2">Select Categories : </p>
            @foreach ($categories as $category)
                <form action="{{ route('blog.index') }}" method="get">
                    <input type="hidden" class="form-control" type="text" name="category" value="{{ $category->name }}"/>
                    <button class="badge bg-primary me-3" type="submit">{{ $category->name }}</button>
                </form>
            @endforeach
            <form action="{{ route('blog.index') }}" method="get">
                <input type="hidden" class="form-control" type="text" name="category" value="All"/>
                <button class="badge bg-primary me-3" type="submit">All</button>
            </form>
        </div>

    </div>

    <div class="row">
        @foreach ($posts as $post)

        <div class="col-lg-4 mb-3 d-flex align-items-stretch">
            <div class="card" style="width: 23rem;">
                @if($post->image)
                    <div class="img-container mx-auto" style="width:10rem">
                        <img src="{{ asset('storage/'.$post->image) }}" class="card-img-top mx-auto">
                    </div>
                @else
                    <img
                    src="https://codingyaar.com/wp-content/uploads/bootstrap-profile-card-image.jpg"
                    class="img-fluid"
                    />

                @endif
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title">{{ $post->title }}</h5>
                  <p class="card-text text-muted fst-italic mb-2">Wrote {{ $post->updated_at->diffForHumans() }} by {{ $post->user->name }}</p>
                  <div class="flex align-items-center">
                    <span class="badge bg-primary mb-3">{{ $post->category->name }}</span>
                  </div>
                  <p class="card-text">{{ $post->description }}</p>
                  <a href="{{ route('blog.show', ['slug' => $post->slug]) }}" class="btn btn-primary mt-auto">Know More</a>
                </div>
              </div>
        </div>

        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-3">
        {{ $posts->links() }}
    </div>

@endsection

