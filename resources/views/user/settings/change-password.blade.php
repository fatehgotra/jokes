@extends('layouts.user')
@section('title', 'Change Password')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Change Password</h4>
                </div>
            </div>
        </div>
        @include('user.includes.flash-message')
        <!-- end page title -->

    </div> <!-- container -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="passwordForm" method="POST" action="{{ route('user.change-password') }}">
                        @csrf
                        <div class="form-group">
                            <label for="current_password" class="col-form-label">Current password *</label>
                            <input type="password" id="current_password" name="current_password"
                                class="form-control @error('current_password') is-invalid @enderror">
                            @error('current_password')
                                <code id="current_password-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_password" class="col-form-label">New password *</label>
                            <input type="password" id="new_password" name="new_password"
                                class="form-control @error('new_password') is-invalid @enderror">
                            @error('new_password')
                                <code id="password-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirmation" class="col-form-label">Confirm Password
                                *</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                class="form-control">
                            @error('new_password_confirmation')
                                <code id="new_password_confirmation-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-warning" form="passwordForm">Update Password</button>
                </div>
            </div>
        </div>
    </div>
@endsection
