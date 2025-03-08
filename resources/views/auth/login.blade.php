@extends('layout.auth')

@section('content')
    <div class="container">
        <div class="row">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="col-lg-12">
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6 col-lg-6 d-none d-lg-block">
                                <x-auth.banner />
                            </div>
                            <!-- end col -->

                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4">
                                    <div>
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <p class="text-muted">Sign in to continue to OMS.</p>
                                    </div>

                                    <div class="mt-4">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                placeholder="Enter Username" required autofocus autocomplete="false">
                                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                                        </div>

                                        <div class="mb-3">
                                            {{-- <div class="float-end">
                                                <a href="auth-pass-reset-cover.html" class="text-muted">
                                                    Forgot password?
                                                </a>
                                            </div> --}}
                                            <label class="form-label" for="password-input">Password</label>

                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input"
                                                    placeholder="Enter password" id="password" name="password" required>

                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button" id="password-addon">
                                                    <i class="ri-eye-fill align-middle"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                id="auth-remember-check" name="remember">
                                            <label class="form-check-label" for="auth-remember-check">
                                                Remember me
                                            </label>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Sign In</button>
                                        </div>
                                        {{-- @dd($errors->get('username')[0]) --}}
                                        @if (
                                            $errors->has('username') &&
                                                is_array($errors->get('username')) &&
                                                str_contains($errors->get('username')[0] ?? '', 'another device'))
                                            <div class="mt-1">
                                                <button onclick="submitResetSession()" class="btn btn-danger w-100"
                                                    type="button">
                                                    Logout Other Devices
                                                </button>
                                            </div>
                                        @endif
                                        {{-- <div class="mt-4 text-center">
                                            <x-auth.socialite />
                                        </div> --}}
                                    </div>

                                    {{-- <div class="mt-5 text-center">
                                        <p class="mb-0">Don't have an account ? <a href="auth-signup-cover.html"
                                                class="fw-semibold text-primary text-decoration-underline">
                                                Signup</a> </p>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function submitResetSession() {
                let username = document.getElementById('username').value;
                if (username == '') {
                    alert('Please enter username');
                    return;
                }
                window.location.href = '{{ url('reset-login-session') }}/' + username;
            }
        </script>
    @endpush
@endsection
