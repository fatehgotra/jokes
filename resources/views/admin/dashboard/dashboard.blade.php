@extends('layouts.admin')
@section('title', "Dashboard")
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
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>
       @include('admin.dashboard.stats')

       @include('admin.dashboard.users', ['users' => $users])

       @include('admin.dashboard.jokes', ['jokes' => $jokes])
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
            "pageLength": 5,
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

        $("#jokes-datatable").DataTable({
            "paging": true,
            "pageLength": 5,
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