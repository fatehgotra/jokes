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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Guess The Voice Questions</a></li>
                        <li class="breadcrumb-item active">Setup</li>
                    </ol>
                </div>
                <h4 class="page-title">Guess The Voice Questions</h4>
            </div>
        </div>
    </div>
    @include('admin.includes.flash-message')
    <!-- end page title -->

</div> <!-- container -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12 text-end">
                        <a href="{{ route('admin.add-guess-the-voice-question') }}" class="btn btn-sm btn-dark float-end">Add
                            Question</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>File</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if( count($questions) )
                                @foreach( $questions as $question)
                                <tr>
                                    <td>{{ $question->id }}</td>
                                    <td>{{ $question->text }}</td>
                                    @if( $question->status == 1)
                                    <td> <span class="badge bg-success"> Enable </span></td>
                                    @else
                                    <td> <span class="badge bg-danger"> Disable </span></td>
                                    @endif

                                    <td>
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="{{ route('admin.edit-guess-the-voice-question', $question->id) }}" class="dropdown-item"><i class="mdi mdi-account-edit-outline"></i>
                                                Edit question</a>
                                            <a href="javascript:void(0);" onclick="confirmDelete({{ $question->id }})" class="dropdown-item"><i class="mdi mdi-trash-can"></i>
                                                Delete
                                                question</a>
                                            <form id='delete-form{{ $question->id }}' action='{{ route('admin.delete-guess-the-voice-question', $question->id) }}' method='POST'>
                                                <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                <input type='hidden' name='id' value='{{ $question->id }}'>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Datatables js -->
    <script src="{{ asset('assets_admin/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/vendor/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets_admin/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/vendor/responsive.bootstrap4.min.js') }}"></script>


    <!-- Datatable Init js -->
    <script>
        $(function() {
            $("#basic-datatable").DataTable({
                "paging": true,
                "pageLength": 20,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "order": [
                    [0, 'desc']
                ]
            });
        });
    </script>


    <script type="text/javascript">
        function confirmDelete(no) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form' + no).submit();
                }
            })
        };
    </script>   
@endpush
