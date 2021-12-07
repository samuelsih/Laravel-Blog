@extends('layout.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <main class="col-lg-8">
            <article>
                <header class="mb-4">
                    <h1 class="fw-bolder mb-1">{{ $post->title }}</h1>
                    <div class="text-muted fst-italic mb-2">Posted {{ $post->updated_at->diffForHumans() }} by {{ $post->user->name }}</div>
                    <p class="badge bg-primary text-decoration-none link-light">{{ $post->category->name }}</p>
                </header>
                <figure class="mb-4">
                    @if($post->image)
                        <img src="{{ asset('storage/'.$post->image) }}" class="img-fluid rounded">
                    @else
                        <img
                        src="https://codingyaar.com/wp-content/uploads/bootstrap-profile-card-image.jpg"
                        class="img-fluid rounded"
                        />
                    @endif
                </figure>
                <section class="mb-5">
                    {!! $post->content !!}
                </section>
            </article>
        </main>

        <aside class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                @foreach ($categories as $category)
                                <form action="{{ route('blog.index') }}" method="get">
                                    <li>
                                        <input type="hidden" class="form-control" type="text" name="category" value="{{ $category->name }}"/>
                                        <button class="badge bg-primary me-3" type="submit">{{ $category->name }}</button>
                                    </li>
                                </form>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
        </aside>
    </div>
</div>
@endsection
