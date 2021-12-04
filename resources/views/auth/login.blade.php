@extends('layout.app')


@section('content')
    {{-- Jika user berhasil register (lihat RegistrationController), masukkan pesan nya --}}
    @if($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
        <section class="max-vh-100 d-flex justify-content-center align-items-center">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                  <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                      <h3 class="mb-5">Log In</h3>

                      <form action="{{ route('login') }}" method="post">
                        @csrf

                        @error('email')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                        <div class="form-outline mb-4">
                            <input type="email" id="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}"/>
                            <label class="form-label" for="email">Email</label>
                          </div>

                          <div class="form-outline mb-4">
                            <input type="password" id="password" name="password" class="form-control form-control-lg" />
                            <label class="form-label" for="password">Password</label>
                          </div>

                          <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

@endsection
