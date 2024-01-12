@extends('layouts.app')
@section('title', 'Signup')
@section('content')

<main class="main">
    <div class="container">
        <section class="wrapper">

            <div class="card1">

                <div class="card-body1">

                    <div class="heading">
                        <h1 class="text text-large">Sign Up</h1>
                        <p class="text text-normal">Already have account? <span><a href="{{ route('user.login') }}" class="text text-links">Login</a></span>
                        </p>
                    </div>

                    <form action="{{ route('user.signup') }}" method="POST">
                        @csrf

                        <div class="mb-2">
                            <label for="name" class="form-label">Name</label>
                            <input class="form-control" type="text" name="name" id="name" placeholder="Enter your name" value="{{ old('name') }}">
                            @error('name')
                            <code id="email-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="emailaddress" class="form-label">Email address</label>
                            <input class="form-control" type="email" name="email" id="emailaddress" placeholder="Enter your email" value="{{ old('email') }}">
                            @error('email')
                            <code id="email-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="phone" class="form-label">Phone</label>
                            <input class="form-control" type="number" name="phone" id="name" placeholder="Enter your phone number" value="{{ old('phone') }}">
                            @error('phone')
                            <code id="email-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>


                        <div class="mb-2">

                            <label for="password" class="form-label">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                <!-- <div class="input-group-append" data-password="false">
                                    <div class="input-group-text">
                                        <span class="fas fa-eye"></span>
                                    </div>
                                </div> -->
                            </div>
                            @error('password')
                            <code id="password-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="confirm" class="form-label">Confirm password</label>
                            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password">
                            @error('password_confirmation')
                            <code id="email-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="remember" id="checkbox-signin" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                            </div>
                        </div>

                        <div class="mb-0 text-center">
                            <button class="btn btn-warning" type="submit"> Sign Up </button>
                            <a href="{{ route('user.login')  }}" class="btn btn-secondary" type="submit"> Back </a>
                        </div>


                    </form>
                </div> <!-- end card-body -->
            </div>
            <!-- end card -->

        </section>
    </div>
</main>

<style>
    :root {
        --color-white: #fff;
        --color-light: #f1f5f9;
        --color-black: #121212;
        --color-night: #001632;
        --color-red: #f44336;
        --color-blue: #1a73e8;
        --color-gray: #80868b;
        --color-grayish: #dadce0;
        --shadow-normal: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        --shadow-medium: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-large: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    html {
        font-size: 100%;
        font-size-adjust: 100%;
        box-sizing: border-box;
        scroll-behavior: smooth;
    }

    *,
    *::before,
    *::after {
        padding: 0;
        margin: 0;
        box-sizing: inherit;
        list-style: none;
        list-style-type: none;
        text-decoration: none;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-rendering: optimizeLegibility;
    }

    a,
    button {
        font-family: inherit;
        font-size: inherit;
        line-height: inherit;
        cursor: pointer;
        border: none;
        outline: none;
        background: none;
        text-decoration: none;
    }

    img {
        display: block;
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        max-width: 80rem;
        /* min-height: 100vh; */
        width: 100%;
        padding: 0 2rem;
        margin: 0 auto;
    }

    .ion-logo-apple {
        font-size: 1.65rem;
        line-height: inherit;
        margin-right: 0.5rem;
        color: var(--color-black);
    }

    .ion-logo-google {
        font-size: 1.65rem;
        line-height: inherit;
        margin-right: 0.5rem;
        color: var(--color-red);
    }

    .ion-logo-facebook {
        font-size: 1.65rem;
        line-height: inherit;
        margin-right: 0.5rem;
        color: var(--color-blue);
    }

    .text {
        font-family: inherit;
        line-height: inherit;
        text-transform: unset;
        text-rendering: optimizeLegibility;
    }

    .text-large {
        font-size: 2rem;
        font-weight: 600;
        color: #FFDF3A;
    }

    .text-normal {
        font-size: 1rem;
        font-weight: 400;
        color: var(--color-black);
    }

    .text-links {
        font-size: 1rem;
        font-weight: 400;
        color: #FFDF3A;
    }

    .text-links:hover {
        text-decoration: underline;
    }

    .main .wrapper {
        max-width: 28rem;
        width: 100%;
        /* margin: 2rem auto; */
        padding: 2rem 2.5rem;
        border: none;
        outline: none;
        border-radius: 0.25rem;
        color: #fff;
        background: #418BE0;
        box-shadow: var(--shadow-large);
    }

    .main .wrapper .form {
        width: 100%;
        height: auto;
        margin-top: 2rem;
    }

    .main .wrapper .form .input-control {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.25rem;
    }

    .main .wrapper .form .input-field {
        font-family: inherit;
        font-size: 1rem;
        font-weight: 400;
        line-height: inherit;
        width: 100%;
        height: auto;
        padding: 0.75rem 1.25rem;
        border: none;
        outline: none;
        border-radius: 2rem;
        color: var(--color-black);
        background: var(--color-light);
        text-transform: unset;
        text-rendering: optimizeLegibility;
    }

    .main .wrapper .form .input-submit {
        font-family: inherit;
        font-size: 1rem;
        font-weight: 500;
        line-height: inherit;
        cursor: pointer;
        min-width: 100%;
        height: auto;
        padding: 0.65rem 1.25rem;
        border: none;
        outline: none;
        border-radius: 2rem;
        color: black;
        background: #fff;
        box-shadow: var(--shadow-medium);
        text-transform: capitalize;
        text-rendering: optimizeLegibility;
    }

    .main .wrapper .striped {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        margin: 1rem 0;
    }

    .main .wrapper .striped-line {
        flex: auto;
        flex-basis: auto;
        border: none;
        outline: none;
        height: 2px;
        background: var(--color-grayish);
    }

    .main .wrapper .striped-text {
        font-family: inherit;
        font-size: 1rem;
        font-weight: 500;
        line-height: inherit;
        color: var(--color-black);
        margin: 0 1rem;
    }

    .main .wrapper .method-control {
        margin-bottom: 1rem;
    }

    .main .wrapper .method-action {
        font-family: inherit;
        font-size: 0.95rem;
        font-weight: 500;
        line-height: inherit;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: auto;
        padding: 0.8rem 1.25rem;
        outline: none;
        border: 2px solid var(--color-grayish);
        border-radius: 2rem;
        color: var(--color-black);
        background: var(--color-white);
        text-transform: capitalize;
        text-rendering: optimizeLegibility;
        transition: all 0.35s ease;
    }

    .main .wrapper .method-action:hover {
        background: var(--color-light);
    }
</style>

<!-- bundle -->
<script src="{{ asset('assets_admin/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets_admin/js/app.min.js') }}"></script>

@endsection