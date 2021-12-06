@extends('layout.app')

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
                  <h4>Topic : {{ $post->category->name }}</h4>

                  <p class="card-text mb-4">
                      {{ $post->description }}
                  </p>
                  <a href="{{ route('blog.show', ['slug' => $post->slug]) }}" class="btn btn-primary mt-auto align-self-start">Read More</a>
                </div>
              </div>
        </div>

        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>

    <script>
        setTimeout(() => {
            const alertNode = document.querySelector('.alert')
            const alert = bootstrap.Alert.getInstance(alertNode)
            alert.close()
        }, 1000);
    </script>

@endsection

