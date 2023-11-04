@extends('layouts.admin')
@section('title', 'Group - Guess The Celebrity')
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
                        <li class="breadcrumb-item"><a href="javascript:void(0);"> Group - Guess The Celebrity </a></li>
                        <li class="breadcrumb-item active">Setup</li>
                    </ol>
                </div>
                <h4 class="page-title">Group - Guess The Celebrity</h4>
            </div>
        </div>
    </div>
    @include('admin.includes.flash-message')
    <!-- end page title -->

</div> <!-- container -->

<div class="row">
    <form method="POST" action="{{ route('admin.store-group-guess-celebrity') }}" id="courseForm" enctype="multipart/form-data">
        @csrf
        <input hidden name="game_id" value="{{ $game ? $game->id : '' }}">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h3>Setup</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ old('name', $game ? $game->name : '' ) }}">
                            </div>
                            @error('name')
                            <code class="text text-danger">{{ $message }}</code>
                            @enderror

                            <div class="col-md-6 mb-2">
                              
                                <label for="statuses" class="form-label">Status<span class="text-danger">*</span></label>
                                <select name="status" id="statuses" class="form-select" value="{{ old('status') }}">

                                    <option value="1" {{  ( $game->status == '1' ? "selected" : '' )  }}>Active</option>
                                    <option value="0" {{  ( $game->status == '0' ? "selected" : '' )  }}>Inactive</option>

                                </select>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="game_question_limit" class="form-label"> No. of question per game <span class="text-danger"> <small> </small> </span></label>
                                <input type="number" min="0" class="form-control" name="game_question_limit" placeholder="game questions limit" value="{{ old('game_question_limit', $game ? $game->game_question_limit : '' ) }}">
                                @error('game_question_limit')
                                <code class="text text-danger">{{ $message }}</code>
                                @enderror
                            </div>



                            <div class="col-md-6 mb-2">
                                <label for="ques_time_limit" class="form-label"> Game question timeout limit <span class="text-danger"> <small>( in seconds) </small> </span></label>
                                <input type="number" min="0" class="form-control" name="question_limit" placeholder="Question time limit" value="{{ old('question_limit', $game ? $game->ques_time_limit : '' ) }}">
                                @error('question_limit')
                                <code class="text text-danger">{{ $message }}</code>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="lifeline" class="form-label"> No. of lifeline <span class="text-danger"> <small> </small> </span></label>
                                <input type="number" min="0" class="form-control" name="lifeline" placeholder="Enter lifelines" value="{{ old('lifeline', $game ? $game->lifeline : '' ) }}">
                                @error('lifeline')
                                <code class="text text-danger">{{ $message }}</code>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="qualified_score" class="form-label"> Qualified score for leader <span class="text-danger"> <small> </small>( greater than or equal to this ) </span></label>
                                <input type="number" min="0" class="form-control" name="qualified_score" placeholder="Enter qualified score" value="{{ old('qualified_score', $game ? $game->qualified_score : '' ) }}">
                                @error('qualified_score')
                                <code class="text text-danger">{{ $message }}</code>
                                @enderror
                            </div>



                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label">Game description <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" id="description" placeholder="Game description" value="{{ old('description',$game ? $game->description : '') }}" rows="4">{{ $game ? $game->description : '' }}</textarea>
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="rules" class="form-label"> Rules <span class="text-danger"> <small> </small> </span></label>
                                <textarea id="rules" name="rules" value="{{ $game->rules }}">{!! $game->rules !!}</textarea>
                                @error('rules')
                                <code class="text text-danger">{{ $message }}</code>
                                @enderror
                            </div>

                            @error('description')
                            <code class="text text-danger">{{ $message }}</code>
                            @enderror

                            <div class="col-md-12 mb-2 text-end">
                                <button type="submit" class="btn btn-sm btn-warning" form="courseForm">Save</button>

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
    CKEDITOR.replace('rules', {});
</script>
@endpush