<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Reset Password| Administrator</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Cloudinc" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets_admin/images/favicon.ico') }}">

        <!-- App css -->
        <link href="{{ asset('assets_admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets_admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('assets_admin/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
        <link href="{{ asset('assets_admin/css/custom.css') }}" rel="stylesheet" type="text/css" />
    </head>

    <body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card">

                            <!-- Logo -->
                            <!-- <div class="card-header pt-1 pb-1 text-center bg-dark">
                                <a href="{{ route('admin.login') }}">
                                    <span><img src="{{ asset('assets/images/logo.png') }}" alt="" class="img-fluid"></span>
                                    {{-- <h1 class="text-white">{{ config('app.name', 'Laravel') }}</h1> --}}
                                </a>
                            </div> -->

                            <div class="card-body">

                                <div class="text-center w-75 m-auto">
                                    <h4 class="text-dark-50 text-center mt-0 mb-3 font-weight-bold">Reset Password</h4>
                                </div>

                                <form action="{{ route('admin.password.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="mb-2">
                                        <label for="emailaddress" class="form-label">Email address</label>
                                        <input class="form-control" type="email" name="email" id="emailaddress" placeholder="Enter your email" value="{{ $email ?? old('email') }}">
                                        @error('email')
                                            <code id="email-error" class="text-danger">{{ $message }}</code>
                                        @enderror
                                    </div>

                                    <div class="mb-2">
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

                                    <div class="mb-2">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm your password">
                                            <div class="input-group-append" data-password="false">
                                                <div class="input-group-text">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-warning" type="submit">Reset Password </button>
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

        <!-- <footer class="footer footer-alt">
            <script>document.write(new Date().getFullYear())</script> © Fiji Red Cross Society
        </footer> -->

        <!-- bundle -->
        <script src="{{ asset('assets_admin/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets_admin/js/app.min.js') }}"></script>

    </body>
</html>
