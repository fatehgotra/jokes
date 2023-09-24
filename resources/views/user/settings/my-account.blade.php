@extends('layouts.user')
@section('title', 'My Account')
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
                            <li class="breadcrumb-item active">My Account</li>
                        </ol>
                    </div>
                    <h4 class="page-title">My Account</h4>
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
                    <form id="accountForm" method="POST"
                        action="{{ route('user.my-account.update', Auth::guard('user')->id()) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name" class="col-form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter Full Name" value="{{ old('name', $user->name) }}">
                            @error('name')
                                <code id="name-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter Email Address" value="{{ old('email', $user->email) }}">
                            @error('email')
                                <code id="name-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                placeholder="Enter Phone Number" value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <code id="name-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="avatar" class="col-form-label">Profile Picture</label>
                            <div class="custom-file">
                                <input type="file" class="form-control" id="avatar" name="avatar"
                                    onchange="loadPreview(this);">                                   
                            </div>
                            @if ($errors->has('avatar'))
                                <code class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('avatar') }}</strong>
                                </code>
                            @endif
                            <img id="preview_img" src="{{ $user->avatar }}" class="mt-2" width="100"
                                height="100" />
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-warning" form="accountForm">Update Account Details</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function loadPreview(input, id) {
            id = id || '#preview_img';
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(id)
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
