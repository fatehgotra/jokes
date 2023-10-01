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
                <h4 class="page-title">All Jokes</h4>
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


                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jokes as $joke)
                                    <tr>
                                        <td>{{ $joke->id }}</td>
                                        <td>{{ $joke->user->name }}</td>
                                        <td>{{ $joke->category->category }}</td>

                                        <td>
                                            @if($joke->status == 1)
                                            <span class="badge badge-outline-success">Published</span>
                                            @else
                                            <span class="badge badge-outline-danger">UnPublished</span>
                                            @endif

                                        </td>


                                        <td>
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">

                                                <a href="javascript:void(0)" onclick="viewJoke({{  $joke->id }},'view',{{ $joke->category_id }})" class="dropdown-item"><i class="mdi mdi-eye"></i>
                                                    View</a>

                                                <a href="javascript:void(0)" onclick="viewJoke({{ $joke->id, }},'edit', {{ $joke->category_id }} )" class="dropdown-item"><i class="mdi mdi-pencil"></i>
                                                    Edit</a>

                                                @if($joke->status == 1)
                                                <a href="javascript:void(0)" onclick="markJoke({{ $joke->id,'ds' }})" class="dropdown-item"><i class="mdi mdi-block-helper"></i>
                                                    Mark UnPublished</a>
                                                @else
                                                <a href="javascript:void(0)" onclick="markJoke({{ $joke->id ,'en'}})" class="dropdown-item"><i class="mdi mdi-check-circle"></i>
                                                    Mark Published</a>
                                                @endif

                                                <form id='mark-form{{ $joke->id }}' action='{{ route("admin.mark-joke") }}' method='POST'>
                                                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                    <input type='hidden' name='id' value='{{ $joke->id }}'>
                                                    <input type="hidden" name="status" value="{{ ($joke->status == 1) ? 0: 1 }}">
                                                </form>

                                                <a href="{{ route('admin.userlogin', $joke->user->id )}}" class="dropdown-item"><i class="mdi mdi-login"></i>
                                                    Login as {{ $joke->user->name }}</a>


                                                <a href="javascript:void(0);" onclick="confirmDelete({{ $joke->id }})" class="dropdown-item"><i class="mdi mdi-trash-can"></i>
                                                    Delete
                                                    Joke</a>
                                                <form id='delete-joke{{ $joke->id }}' action='{{ route("admin.delete-joke") }}' method='POST'>
                                                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                    <input type='hidden' name='id' value='{{ $joke->id }}'>
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
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content" style="text-align:center;font-size:23px">
            <div class="modal-body">

            </div>
            <div class="text-right m-1">
                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="markJoke(localStorage.getItem('view'),'en')">
                    Publish
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="markJoke( localStorage.getItem('view'),'ds' )">
                    UnPublish
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="{$('#exampleModal').modal('hide')}">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editJokeModal" tabindex="-1" role="dialog" aria-labelledby="editJokeModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">

        <div class="modal-content" style="text-align:center;font-size:23px">
            <div class="modal-body">
                <input type="hidden" id="jokeid" name="id" value="">
                <textarea id="jokearea" name="jokearea" class="form-control" value=""></textarea>


                <div class="mb-2">
                    <label for="confirm" class="form-label">Category</label>
                    <select class="form-control" name="category_id" id="category_id">
                        @if( count($jokes_categories) > 0 )
                        @foreach( $jokes_categories as $jc)
                        <option value="{{ $jc->id }}">{{ $jc->category }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>

            </div>

            <div class="text-right m-1">
                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="editJoke()">
                    Update
                </button>

                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="{$('#editJokeModal').modal('hide')}">
                    <span aria-hidden="true">&times;</span>
                </button>

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
    function viewJoke(id, mode, cat) {


        let url = '{{ route("admin.view-joke",  ":id" ) }}';

        url = url.replace(':id', id);

        if (mode == 'view') {
            localStorage.setItem('view', id);
        }

        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            success: function(res) {
                if (mode == 'view') {

                    $('#exampleModal').find('.modal-body').html(res.joke.joke);
                    $('#exampleModal').modal('show');

                } else {

                    CKEDITOR.instances.jokearea.setData(res.joke.joke);
                    $('#editJokeModal').find('#jokeid').val(id);
                    $('#editJokeModal').find('#category_id option[value="'+cat+'"]').prop('selected',true);
                    $('#editJokeModal').modal('show');
                }
                console.log(res);
            }
        });
    }



    function editJoke(id) {

        let url = '{{ route("admin.edit-joke" ) }}';

        $.ajax({
            url: url,
            type: "POST",
            dataType: "JSON",
            data: {
                id: $("#jokeid").val(),
                category_id:$('#category_id').val(),
                joke: CKEDITOR.instances.jokearea.getData(),
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                location.reload(true);
            }
        });

        setTimeout(() => {
            location.reload(true);
        }, 100);
    }

    function markJoke(no, st) {


        Swal.fire({
            title: 'Are you sure?',
            text: (st == 'en') ? "You want to mark publish this joke" : "You want to mark unpublish this joke",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: (st == 'en') ? 'Yes, Mark Publish' : 'Yes Mark Unpublish',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('mark-form' + no).submit();
            }
        })
    };

    function confirmDelete(no) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete Joke!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-joke' + no).submit();
            }
        })
    };
</script>


@endpush