@extends('layout.app')


@section('content')
    <div class="container">
        <section class="max-vh-100 d-flex justify-content-center align-items-center">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                  <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                      <h3 class="mb-5">Register</h3>

                      <form action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="form-outline mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">

                            @error('email')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-outline mb-4">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}">

                            @error('username')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-outline mb-4">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">

                            @error('name')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-outline mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control">

                            @error('password')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-outline mb-4">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password" class="form-control">
                        </div>

                        <button class="btn btn-success inline-block text-center">Register</button>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    </div>


@endsection
