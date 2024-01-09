@extends('layouts.admin')
@section('title', 'Guess The Voice')
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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Guess The Voice Add Question</a></li>
                        <li class="breadcrumb-item active">Setup</li>
                    </ol>
                </div>
                <h4 class="page-title">Add Guess The Voice Question</h4>
            </div>
        </div>
    </div>
    @include('admin.includes.flash-message')
    <!-- end page title -->

</div> <!-- container -->
<div class="row">
    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.update-guess-the-voice-question') }}" id="questionForm">
        @csrf
        <input type="hidden" name="id" value="{{ $question->id }}">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">


                            <div class="col-md-12 mb-2">
                                <label for="text" class="form-label">Question <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="text" id="question" placeholder="Question" value="{{ old('question',$question->question) }}">
                                @error('text')
                                <code class="text text-danger">{{ $message }}</code>
                                @enderror
                            </div>


                            <div class="col-md-12 mb-2">
                               
                                <label for="image" class="form-label">Audio File <span class="text-danger"><small>( required )</small></span></label>
                                <input type="file" class="form-control" name="file" id="image">
                                @if( ($question->file) != '' )
                                <br>
                                <div class="text-white"> <audio style="width:234px" controls>
                                                <source src="{{ asset('audios/'.$question->file) }}" type="audio/mp3">
                                                Your browser does not support the audio tag.
                                            </audio>
                                        </div>
                                @endif

                                @error('file')
                                <code class="text text-danger">{{ $message }}</code>
                                @enderror

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