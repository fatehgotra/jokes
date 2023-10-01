@extends('layouts.admin')
@section('title', 'Jokes')
@section('head')
<link href="{{ asset('assets_admin/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets_admin/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
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
                        <li class="breadcrumb-item active">{{ ucfirst(request()->get('status')) }} Jokes</li>
                        @endif

                        @if(request()->get('active'))
                        <li class="breadcrumb-item active">{{ request()->get('active') == 'yes' ? 'Active': 'Inactive' }} Jokes</li>
                        @endif
                    </ol>
                </div>
                @if(request()->get('status'))
                <h4 class="page-title">{{ ucfirst(request()->get('status')) }} Jokes</h4>
                @endif

                @if(request()->get('active'))
                <h4 class="page-title">{{ request()->get('active') == 'yes' ? 'Active': 'Inactive' }} Jokes</h4>
                @endif

                @if( request()->get('status') == null )
                <h4 class="page-title">Jokes Categories</h4>
                @endif

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12 table-responsive">

                            <button class="btn btn-info" data-toggle="modal" data-target="#exampleModal" onclick="{$('#exampleModal').modal('show')}">Add Category</button>

                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $cat)
                                    <tr>
                                        <td>{{ $cat->id }}</td>
                                        <td>{{ $cat->category }}</td>

                                        <td>
                                            @if($cat->status == 1)
                                            <span class="badge badge-outline-success">Enable</span>
                                            @else
                                            <span class="badge badge-outline-danger">Disabled</span>
                                            @endif

                                        </td>


                                        <td>
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end">


                                                <a href="javascript:void(0)" onclick="edit({{  $cat->id }},'{{ $cat->category }}',{{ $cat->status }} )" class="dropdown-item"><i class="mdi mdi-pencil"></i>
                                                    Edit</a>



                                                <a href="javascript:void(0);" onclick="confirmDelete({{ $cat->id }})" class="dropdown-item"><i class="mdi mdi-trash-can"></i>
                                                    Delete
                                                    Category</a>
                                                <form id='delete-cat{{ $cat->id }}' action='{{ route("admin.delete_category") }}' method='POST'>
                                                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                    <input type='hidden' name='id' value='{{ $cat->id }}'>
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
                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>

            </div>
            <div class="modal-body">

                <div class="card-body">

                    <form action="{{ route('admin.add_category') }}" method="POST" id="adduser">
                        @csrf
                        <div class="mb-2">
                            <label for="category" class="form-label"> Category Name</label>
                            <input class="form-control" type="text" name="category" required id="category" placeholder="Enter category" value="{{ old('category') }}">
                        </div>

                        <div class="mb-2">
                            <label for="confirm" class="form-label">Status</label>
                            <select class="form-control" name="status">
                                <option value="1">Enable</option>
                                <option value="0">Disable</option>
                            </select>
                        </div>

                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="{ $('#exampleModal').modal('hide') }" >Close</button>
                <button type="submit" class="btn btn-primary" form="adduser">Save changes</button>
            </div>
        </div>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleEditModalLabel">Edit Category</h5>

            </div>
            <div class="modal-body">

                <div class="card-body">

                    <form action="{{ route('admin.edit_category') }}" method="POST" id="editform">
                        @csrf
                        <input type="hidden" name="editId" id="editId" value="">
                        <div class="mb-2">
                            <label for="category" class="form-label"> Category Name</label>
                            <input class="form-control" type="text" name="category" required id="editcategory" placeholder="Enter category" value="{{ old('category') }}">
                        </div>

                        <div class="mb-2">
                            <label for="confirm" class="form-label">Status</label>
                            <select class="form-control" name="status" id="editstatus">
                                <option value="1">Enable</option>
                                <option value="0">Disable</option>
                            </select>
                        </div>

                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="{ $('#editModal').modal('hide') }">Close</button>
                <button type="submit" class="btn btn-primary" form="editform">Save changes</button>
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

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('jokearea', {

    });
</script>


<script>
    function edit(id, cat, status) {

        $('#editcategory').val(cat);
        $('#editstatus option[value="' + status + '"]').prop('selected', true);
        $('#editId').val(id);

        $('#editModal').modal('show');
    }


    function confirmDelete(no) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete category!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-cat' + no).submit();
            }
        })
    };
</script>


@endpush