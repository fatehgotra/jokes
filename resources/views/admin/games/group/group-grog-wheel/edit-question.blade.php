@extends('layouts.admin')
@section('title', 'Grog spin the wheel')
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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Grog spin the wheel edit question</a></li>
                        <li class="breadcrumb-item active">Setup</li>
                    </ol>
                </div>
                <h4 class="page-title">Grog spin the wheel edit question</h4>
            </div>
        </div>
    </div>
    @include('admin.includes.flash-message')
    <!-- end page title -->

</div> <!-- container -->
<div class="row">
    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.update-group-grog-wheel-question') }}" id="questionForm">
        @csrf
        <input type="hidden" name="id" value="{{ $question->id }}">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">


                            <div class="col-md-12 mb-2">
                                <label for="text" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{ old('name',$question->name) }}">
                                @error('name')
                                <code class="text text-danger">{{ $message }}</code>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="text" class="form-label">Task <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="task" id="task" placeholder="Enter Task" value="{{ old('task',$question->task) }}">
                                @error('task')
                                <code class="text text-danger">{{ $message }}</code>
                                @enderror
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