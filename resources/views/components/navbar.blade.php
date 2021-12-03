{{-- component untuk navbar --}}
<nav class="navbar navbar-light bg-light py-3 mb-3">
    <div class="container">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link fw-bold text-dark" href="{{ route('home') }}">Laravel Blog</a>
            </li>
        </ul>

        <div class="d-flex align-items-center">
            <button type="button" class="btn btn-outline-primary px-3 me-2 text-dark">
              <a href="{{ route('login') }}" class="text-dark text-decoration-none">Log in</a>
            </button>
            <button type="button" class="btn btn-primary me-3">
              <a href="{{ route('register') }}" class="text-light text-decoration-none">Sign Up</a>
            </button>
            <a
              class="btn btn-dark px-3"
              href="#"
              role="button"
              ><i class="fab fa-github"></i>
            </a>
        </div>
    </div>


</nav>

