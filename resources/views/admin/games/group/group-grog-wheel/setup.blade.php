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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Grog spin the wheel</a></li>
                        <li class="breadcrumb-item active">Setup</li>
                    </ol>
                </div>
                <h4 class="page-title">Grog spin the wheel</h4>
            </div>
        </div>
    </div>
    @include('admin.includes.flash-message')
    <!-- end page title -->

</div> <!-- container -->

<div class="row">
    <form method="POST" action="{{ route('admin.store-group-grog-wheel') }}" id="courseForm" enctype="multipart/form-data">
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


                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label">Game description <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" id="description" placeholder="Game description" value="{{ old('description',$game ? $game->description : '') }}" rows="4">{{ $game ? $game->description : '' }}</textarea>
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