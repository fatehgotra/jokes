<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets_admin/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('assets_admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets_admin/css/app.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('assets_admin/css/app-dark.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
    <link href="{{ asset('assets_admin/css/custom.css1') }}" rel="stylesheet" type="text/css" />
    @yield('head')
</head>

<body class="loading"
data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="wrapper">
 
        <!-- ========== Left Sidebar Start ========== -->
        @include('admin.includes.sidebar')
        <!-- ========== Left Sidebar End ============ -->

        <!-- ========== Content Section Start ======= -->
        <div class="content-page">
            <div class="content">
                @include('admin.includes.navbar') 
                @include('guest.includes.flash-message')
                @yield('content')
            </div>
        </div>
        <!-- ========== Content Section End ========= -->

    </div>
   
    @include('admin.includes.script')
</body>
<style>
        body.loading {
            visibility:unset;
        }
    </style>
</html>
