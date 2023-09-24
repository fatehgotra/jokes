@extends('layouts.admin')
@section('title', 'Users')
@section('head')
<link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        @if(request()->get('status'))
                        <li class="breadcrumb-item active">{{ ucfirst(request()->get('status')) }} Users</li>
                        @endif

                        @if(request()->get('active'))
                        <li class="breadcrumb-item active">{{ request()->get('active') == 'yes' ? 'Active': 'Inactive' }} Users</li>
                        @endif
                    </ol>
                </div>
                @if(request()->get('status'))
                <h4 class="page-title">{{ ucfirst(request()->get('status')) }} Users</h4>
                @endif

                @if(request()->get('active'))
                <h4 class="page-title">{{ request()->get('active') == 'yes' ? 'Active': 'Inactive' }} Users</h4>
                @endif

                @if( request()->get('status') == null )
                <h4 class="page-title">All Users</h4>
                @endif

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @if($errors->any())

            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong><i class="dripicons-wrong me-2"></i> </strong> {{ implode('', $errors->all(':message')) }}
            </div>

            @endif
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12 table-responsive">
                            <button class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Add User</button>

                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email Address</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>

                                        @if($user->status == 1)
                                        <td><span class="badge bg-success">Active</span>
                                        </td>
                                        @else
                                        <td><span class="badge bg-danger">Inactive</span>
                                        </td>

                                        @endif
                                        <td>
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">

                                                @if($user->status == 1)
                                                <a href="javascript:void(0)" onclick="markUser({{ $user->id,'ds' }})" class="dropdown-item"><i class="mdi mdi-block-helper"></i>
                                                    Mark Inactive</a>
                                                @else
                                                <a href="javascript:void(0)" onclick="markUser({{ $user->id ,'en'}})" class="dropdown-item"><i class="mdi mdi-check-circle"></i>
                                                    Mark Active</a>
                                                @endif

                                                <form id='mark-form{{ $user->id }}' action='{{ route("admin.markuser") }}' method='POST'>
                                                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                    <input type='hidden' name='id' value='{{ $user->id }}'>
                                                    <input type="hidden" name="status" value="{{ ($user->status == 1) ? 0: 1 }}">
                                                </form>

                                                <a href="{{ route('admin.userlogin', $user->id )}}" class="dropdown-item"><i class="mdi mdi-login"></i>
                                                    Login as {{ $user->name }}</a>


                                                <a href="javascript:void(0);" onclick="confirmDelete({{ $user->id }})" class="dropdown-item"><i class="mdi mdi-trash-can"></i>
                                                    Delete
                                                    User</a>
                                                <form id='delete-form{{ $user->id }}' action='{{ route("admin.deleteUser") }}' method='POST'>
                                                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                    <input type='hidden' name='id' value='{{ $user->id }}'>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>

            </div>
            <div class="modal-body">

                <div class="card-body">

                    <form action="{{ route('admin.adduser') }}" method="POST" id="adduser">
                        @csrf
                        <div class="mb-2">
                            <label for="name" class="form-label">Name</label>
                            <input class="form-control" type="text" name="name" required id="name" placeholder="Enter name" value="{{ old('name') }}">
                        </div>

                        <div class="mb-2">
                            <label for="emailaddress" class="form-label">Email address</label>
                            <input class="form-control" type="email" required name="email" id="emailaddress" placeholder="Enter email" value="{{ old('email') }}">
                        </div>

                        <div class="mb-2">
                            <label for="phone" class="form-label">Phone</label>
                            <input class="form-control" type="number" required name="phone" id="name" placeholder="Enter phone number" value="{{ old('phone') }}">
                        </div>


                        <div class="mb-2">

                            <label for="password" class="form-label">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" name="password" required class="form-control" placeholder="Enter password">
                                <div class="input-group-append" data-password="false">
                                    <div class="input-group-text">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label for="confirm" class="form-label">Status</label>
                            <select class="form-control" name="status">
                                <option value="1">Active</option>
                                <option value="0">InActive</option>
                            </select>
                        </div>

                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="adduser">Save changes</button>
            </div>
        </div>
    </div>
</div>
<style>
    .form-label {
        color: black !important;
    }
</style>
@endsection
@push('scripts')

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Datatables js -->
<script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>


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
            confirmButtonText: 'Yes, delete user!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form' + no).submit();
            }
        })
    };

    function markUser(no,st) {
        Swal.fire({
            title: 'Are you sure?',
            text: (st == 'en') ? "You want to make active this user" : "You want to make inactive this user" ,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: (st == 'en' ) ? 'Yes, Mark Active' : 'Yes Mark Inactive',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('mark-form' + no).submit();
            }
        })
    };
</script>


    @endpush