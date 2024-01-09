<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header">
                Latest Jokes
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table id="jokes-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Joke</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if( count($jokes) > 0 )
                                @foreach ($jokes as $joke)

                                <tr>
                                    <td>{{ $joke->id }}</td>
                                    <td>
                                        <audio controls>
                                            <source src="{{ asset('audios/'.$joke->joke) }}" type="audio/mp3">
                                            Your browser does not support the audio tag.
                                        </audio>
                                    </td>

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


                                            <a href="javascript:void(0);" onclick="confirmDelete({{ $joke->id }})" class="dropdown-item"><i class="mdi mdi-trash-can"></i>
                                                Delete
                                                Joke</a>

                                            <form id='delete-joke{{ $joke->id }}' action='{{ route("admin.deleteUser") }}' method='POST'>
                                                <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                <input type='hidden' name='id' value='{{ $joke->id }}'>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content" style="text-align:center;font-size:23px">
            <div class="modal-body">

            </div>
            <div class="text-right m-1">

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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('jokearea', {

    });
</script>


<script>
    function viewJoke(id, mode) {


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
                    $('#editJokeModal').modal('show');
                }

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