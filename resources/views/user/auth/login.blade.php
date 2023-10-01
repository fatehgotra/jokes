<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Cloudinc" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets_admin/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('assets_admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets_admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <!-- <link href="{{ asset('assets_admin/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" /> -->
    <link href="{{ asset('assets_admin/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets_admin/css/style2.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                @include('guest.includes.flash-message')
                    <div class="card">

                        <div class="card-body">

                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Login</h4>

                            </div>

                            <form action="{{ route('user.login') }}" method="POST">
                                @csrf

                                <div class="mb-2">
                                    <label for="emailaddress" class="form-label">Email address</label>
                                    <input class="form-control" type="email" name="email" id="emailaddress" placeholder="Enter your email" value="{{ old('email') }}">
                                    @error('email')
                                    <code id="email-error" class="text-danger">{{ $message }}</code>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <a href="{{ route('user.password.request') }}" class="text-muted float-end"><small>Forgot your password?</small></a>
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                        <div class="input-group-append" data-password="false">
                                            <div class="input-group-text">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('password')
                                    <code id="password-error" class="text-danger">{{ $message }}</code>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="remember" id="checkbox-signin" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                    </div>
                                </div>

                                <div class="mb-0 text-center">
                                    <button class="btn btn-warning" type="submit"> Log In </button>
                                    <a href="{{ url('/') }}" class="btn btn-secondary" type="submit"> Back </a>
                                </div>
                              

                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->


    <!-- bundle -->
    <script src="{{ asset('assets_admin/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/app.min.js') }}"></script>
   
</body>

</html>