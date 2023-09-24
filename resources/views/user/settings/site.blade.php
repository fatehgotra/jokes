@extends('layouts.admin')
@section('title', 'site settings')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Site Settings</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Site Settings</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->

    </div> <!-- container -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="signupEmail" method="POST" action="{{ route('admin.setting-save') }}">
                        @csrf
                        <div class="col-md-12 mb-2">
                            <label for="description" class="form-label"> Signup email video link <span class="text-danger">*</span></label>
                            <input class="form-control" name="signup_video_link" value="{{ get_setting('signup_video_link') }}"  rows="10" placeholder="Enter link">
                            @error('signup_video_link')
                            <code id="description-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-warning" form="signupEmail">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.1.9/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea#signup_email_inst',
        height: 300,
        menubar: false,
        toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help ',
    });
</script>
@endpush

