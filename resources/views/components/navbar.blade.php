{{-- component untuk navbar --}}
<nav
    class="navbar navbar-light bg-light py-3 mb-3
    @if(Route::getCurrentRoute()->uri() == '/register' || Route::getCurrentRoute()->uri() == '/login')
        fixed-top
    @endif"
>
    <div class="container">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex flex-row">
            <li class="nav-item me-lg-5 me-md-3">
              <a class="nav-link fw-bold text-dark" href="{{ route('home') }}">Laravel Blog</a>
            </li>

            <form action="{{ route('blog.index') }}" method="get">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search Title..." name="search"/>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </ul>


        <div class="d-flex align-items-center">
            {{-- Jika user sudah login, tampilkan namanya --}}
            @if(Auth::check())
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Hello, {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="{{ route('posts.index', ['username' => Auth::user()->username]) }}">Manage Your Posts</a></li>
                      <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn dropdown-item">
                                Log out
                            </button>
                        </form>
                    </li>
                    </ul>
                </div>
                {{-- <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary px-3 me-2 text-dark">
                        Log out
                    </button>
                </form> --}}

            @else
            {{-- Jika user blum login, tampilkan button login dan register--}}
                <button type="button" class="btn btn-outline-primary px-3 me-2 text-dark">
                    <a href="{{ route('login') }}" class="text-dark text-decoration-none">Log in</a>
                </button>
                <button type="button" class="btn btn-primary me-3">
                    <a href="{{ route('register') }}" class="text-light text-decoration-none">Register</a>
                </button>

            @endif

            <a
              class="btn btn-dark px-3"
              href="https://github.com/samuelsih/Laravel-Blog/tree/second"
              role="button"
              rel="noopener noreferrer"
              ><i class="fab fa-github"></i>
            </a>
        </div>
    </div>


</nav>

