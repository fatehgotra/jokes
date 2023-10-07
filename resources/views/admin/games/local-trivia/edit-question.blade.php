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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Local Trivia Add Question</a></li>
                        <li class="breadcrumb-item active">Setup</li>
                    </ol>
                </div>
                <h4 class="page-title">Add Local Trivia Question</h4>
            </div>
        </div>
    </div>
    @include('admin.includes.flash-message')
    <!-- end page title -->

</div> <!-- container -->
<div class="row">
    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.update-trivia-question') }}" id="questionForm">
        @csrf
        <input type="hidden" name="id" value="{{ $question->id }}">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">


                            <div class="col-md-12 mb-2">
                                <label for="question" class="form-label">Question <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="question" id="question" placeholder="Question" value="{{ old('question',$question->question) }}">
                                @error('question')
                                <code class="text text-danger">{{ $message }}</code>
                                @enderror
                            </div>


                            <div class="col-md-12 mb-2">
                               
                                <label for="image" class="form-label">Image <span class="text-danger"><small>( if required )</small></span></label>
                                <input type="file" class="form-control" name="image" id="image">
                                @if( ($question->image) != '' )
                                <img src="{{ $question->image}}" style="width:50%;padding:2%">
                                @endif

                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="option_1" class="form-label">Option 1 <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="option_1" id="option_1" placeholder="Option 1" rows="3"> {{ old('option_1',$question->option_1) }} </textarea>
                                @error('option_1')
                                <code class="text text-danger">{{ $message }}</code>
                                @enderror
                            </div>


                            <div class="col-md-6 mb-2">
                                <label for="option_2" class="form-label">Option 2 <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="option_2" id="option_2" placeholder="Option 2" rows="3"> {{ old('option_2',$question->option_2) }} </textarea>
                                @error('option_2')
                                <code class="text text-danger">{{ $message }}</code>
                                @enderror
                            </div>


                            <div class="col-md-6 mb-2">
                                <label for="option_3" class="form-label">Option 3 <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="option_3" id="option_3" placeholder="Option 3" rows="3"> {{ old('option_3',$question->option_3) }} </textarea>
                                @error('option_3')
                                <code class="text text-danger">{{ $message }}</code>
                                @enderror
                            </div>


                            <div class="col-md-6 mb-2">
                                <label for="option_4" class="form-label">Option 4 <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="option_4" id="option_4" placeholder="Option 4" rows="3"> {{ old('option_4',$question->option_4) }} </textarea>
                                @error('option_4')
                                <code class="text text-danger">{{ $message }}</code>
                                @enderror
                            </div>


                            <div class="col-md-12 mb-2">
                                <label for="correct_option" class="form-label">Correct Option<span class="text-danger">*</span></label>
                                <select name="correct_option" id="correct_option" class="form-select">
                                    <option value="">Please Select</option>
                                    <option value="option_1" {{ ($question->correct_option  == "option_1" ? "selected" : '' ) }} >Option 1</option>
                                    <option value="option_2" {{ ($question->correct_option  == "option_2" ? "selected" : '' ) }} >Option 2</option>
                                    <option value="option_3" {{ ($question->correct_option  == "option_3" ? "selected" : '' ) }} >Option 3</option>
                                    <option value="option_4" {{ ($question->correct_option  == "option_4" ? "selected" : '' ) }} >Option 4</option>
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
                                <a href="{{ route('admin.trivia-questions') }}" class="btn btn-sm btn-dark">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection