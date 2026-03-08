@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="container hero-shell">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-xl-5">

```
        <div class="hero-card">

            <h1 class="h3 fw-bold mb-3 text-center">
                Create an Account
            </h1>

            <p class="text-secondary text-center mb-4">
                Start tracking your fishing trips and build your personal logbook.
            </p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label text-secondary">Name</label>

                    <input id="name"
                           type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name"
                           value="{{ old('name') }}"
                           required
                           autocomplete="name"
                           autofocus>

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label text-secondary">Email Address</label>

                    <input id="email"
                           type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autocomplete="email">

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label text-secondary">Password</label>

                    <input id="password"
                           type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password"
                           required
                           autocomplete="new-password">

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="mb-4">
                    <label for="password-confirm" class="form-label text-secondary">
                        Confirm Password
                    </label>

                    <input id="password-confirm"
                           type="password"
                           class="form-control"
                           name="password_confirmation"
                           required
                           autocomplete="new-password">
                </div>

                <div class="d-grid gap-3">
                    <button type="submit" class="btn btn-soft btn-soft-success btn-lg">
                        Register
                    </button>
                </div>

            </form>

            <div class="text-center mt-4 text-secondary small">
                Already have an account?
                <a href="{{ route('login') }}">Login</a>
            </div>

        </div>

    </div>
</div>
```

</div>
@endsection

