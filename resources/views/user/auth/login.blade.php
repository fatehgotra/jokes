@extends('layouts.app')
@section('title', 'Login')
@section('content')

<main class="main">
  <div class="container">
    <section class="wrapper">
      <div class="heading">
        <h1 class="text text-large">Sign In</h1>
        <p class="text text-normal">New user? <span><a href="#" class="text text-links">Create an account</a></span>
        </p>
      </div>
      <form name="signin" class="form" action="{{ route('user.login') }}" method="POST">
        @csrf
        <div class="input-control">
          <label for="email" class="input-label" hidden>Email Address</label>
          <input type="email" name="email" id="email" class="input-field" placeholder="Email Address">

        </div>
        @error('email')
        <code id="email-error" class="text-white mb-1">{{ $message }}</code>
        @enderror
        <div class="input-control">
          <label for="password" class="input-label" hidden>Password</label>
          <input type="password" name="password" id="password" class="input-field" placeholder="Password">
        </div>
        @error('password')
          <code id="password-error" class="text-white mb-1">{{ $message }}</code>
          @enderror
        <div class="input-control">
          <a href="#" class="text text-links">Forgot Password</a>
        </div>
        <div class="input-control">
          <input type="submit" name="submit" class="input-submit" value="Sign In">
        </div>
      </form>
      <div class="striped">
        <span class="striped-line"></span>
        <span class="striped-text">Or</span>
        <span class="striped-line"></span>
      </div>

      <div class="method-control">
        <a href="#" class="method-action" style="background-color: #2D496B; border:none;color:#fff">
          <i class="ion ion-logo-facebook"></i>
          <span>Sign in with Facebook</span>
        </a>
      </div>

      <div class="method">
        <div class="method-control">
          <a href="#" class="method-action" style="background-color: #DD4933; border:none;color:#fff">
            <i class="ion ion-logo-google"></i>
            <span>Sign in with Google</span>
          </a>
        </div>


      </div>
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
    padding: 0.35rem 1.25rem;
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
@endsection