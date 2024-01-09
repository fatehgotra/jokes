@extends('layouts.admin')
@section('title', 'Local Trivia')
@section('head')
<link href="{{ asset('assets_admin/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets_admin/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection
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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Add True False Statement</a></li>
                        <li class="breadcrumb-item active">Setup</li>
                    </ol>
                </div>
                <h4 class="page-title">Add True False Statement</h4>
            </div>
        </div>
    </div>
    @include('admin.includes.flash-message')
    <!-- end page title -->

</div> <!-- container -->
<div class="row">
    <form method="POST" enctype="multipart/form-data"  action="{{ route('admin.store-true-false-question') }}" id="questionForm" >
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">


                            <div class="col-md-12 mb-2">
                                <label for="question" class="form-label">Statement <span class="text-danger">*</span></label>
                                <textarea  class="form-control" name="statement" id="statement" placeholder="Enter statement ..." > {{ old('statement') }} </textarea>
                                @error('statement')
                                <code class="text text-danger">{{ $message }}</code>
                                @enderror
                            </div>


                            <!-- <div class="col-md-12 mb-2">
                                <label for="image" class="form-label">Image <span class="text-danger"><small>( if required )</small></span></label>
                                <input type="file" class="form-control" name="image" id="image">
                            </div> -->


                            <div class="col-md-12 mb-2">
                                <label for="correct_option" class="form-label">Correct Option<span class="text-danger">*</span></label>
                                <select name="correct_option" id="correct_option" class="form-select">
                                    <option value="" >Please Select</option>
                                    <option value="true" @if ( old("correct_option") == "true" ? "selected" : '')  @endif >True</option>
                                    <option value="false" @if ( old('correct_option') == "false" ? "selected" : '' ) @endif >False</option>
                                </select>

                                @error('correct_option')
                                <code class="text text-danger">{{ $message }}</code>
                                @enderror
                            </div>


                            <div class="col-md-12 mb-2">
                                <label for="statuses" class="form-label">Status<span class="text-danger">*</span></label>
                                <select name="status" id="statuses" class="form-select">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-2 text-end">
                                <button type="submit" class="btn btn-sm btn-warning" form="questionForm">Save</button>
                                <a href="{{ route('admin.true-false-questions') }}" class="btn btn-sm btn-dark">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src = "https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js" ></script>
<script>
    CKEDITOR.replace('statement', {});
</script>
@endpush