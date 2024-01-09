@extends('layouts.user')
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
                            <button class="btn btn-info" data-toggle="modal" data-target="#addJokeModal" onclick="{$('#addJokeModal').modal('show')}">Add Joke</button>

                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
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

                                                <!-- <a href="javascript:void(0)" onclick="viewJoke({{  $joke->id }},'view', {{ $joke->category_id }})" class="dropdown-item"><i class="mdi mdi-eye"></i>
                                                    View</a>

                                                <a href="javascript:void(0)" onclick="viewJoke({{ $joke->id, }},'edit',{{ $joke->category_id }})" class="dropdown-item"><i class="mdi mdi-pencil"></i>
                                                    Edit</a> -->


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

<!--Add Modal -->
<div class="modal fade" id="addJokeModal" tabindex="-1" role="dialog" aria-labelledby="addJokeModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">

        <div class="modal-content" style="text-align:center;font-size:23px">
            <div class="modal-body">
                <input type="hidden" id="jokeid" name="id" value="">


                <!-- <textarea id="addjokearea" name="addjokearea" class="form-control" value=""></textarea> -->

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

                <!-----Audio start------->

                <form action="{{route('user.save-audio')}}" method="POST" enctype='multipart/form-data'>
                    @csrf
                    <div id="controls">
                        <button id="recordButton" class="btn btn-success">Record</button>
                        <a href="{{ route('user.jokes') }}" class="btn btn-info">Reset</a>
                        <button id="stopButton" class="btn btn-danger" disabled>Stop</button>
                    </div>
                    <div id="formats">Click record to start recording</div>

                    <ul id="recordingsList"></ul>
                    <!-- inserting these scripts at the end to be able to use all the elements in the DOM -->

                </form>

                <!-----Audio End---->

            </div>
            <div class="text-right m-1">
                <!-- <button type="button" class="btn btn-success adbtn" data-dismiss="modal" onclick="addJoke()">
                    Add
                </button> -->

                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="{$('#addJokeModal').modal('hide')}">
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
    CKEDITOR.replace('jokearea', {});
    CKEDITOR.replace('addjokearea', {});
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
                    $('#editJokeModal').find('#category_id option[value="' + cat + '"]').prop('selected', true);
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

    function addJoke() {

        if (CKEDITOR.instances.addjokearea.getData() == '') {
            alert('Please add joke');
            return;
        }
        let url = '{{ route("user.add-joke" ) }}';

        $.ajax({
            url: url,
            type: "POST",
            dataType: "JSON",
            data: {

                joke: CKEDITOR.instances.addjokearea.getData(),
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {}
        });

        setTimeout(() => {
            window.location.href = "{{ route('user.jokes',['status'=>'unpublished']) }}";
        }, 100);

    }
</script>




<script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>
<script>
    //webkitURL is deprecated but nevertheless
    URL = window.URL || window.webkitURL;

    var gumStream; //stream from getUserMedia()
    var rec; //Recorder.js object
    var input; //MediaStreamAudioSourceNode we'll be recording

    // shim for AudioContext when it's not avb. 
    var AudioContext = window.AudioContext || window.webkitAudioContext;
    var audioContext //audio context to help us record

    var recordButton = document.getElementById("recordButton");
    var stopButton = document.getElementById("stopButton");
    //var pauseButton = document.getElementById("pauseButton");

    //add events to those 2 buttons
    recordButton.addEventListener("click", startRecording);
    stopButton.addEventListener("click", stopRecording);
    // pauseButton.addEventListener("click", pauseRecording);

    function startRecording() {
        console.log("recordButton clicked");

        /*
            Simple constraints object, for more advanced audio features see
            https://addpipe.com/blog/audio-constraints-getusermedia/
        */

        var constraints = {
            audio: true,
            video: false
        }

        /*
            Disable the record button until we get a success or fail from getUserMedia() 
        */

        recordButton.disabled = true;
        stopButton.disabled = false;
        // pauseButton.disabled = false

        /*
            We're using the standard promise based getUserMedia() 
            https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia
        */

        navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
            console.log("getUserMedia() success, stream created, initializing Recorder.js ...");

            /*
                create an audio context after getUserMedia is called
                sampleRate might change after getUserMedia is called, like it does on macOS when recording through AirPods
                the sampleRate defaults to the one set in your OS for your playback device

            */
            audioContext = new AudioContext();

            //update the format 
            // document.getElementById("formats").innerHTML = "Format: 1 channel pcm @ " + audioContext.sampleRate / 1000 + "kHz"

            document.getElementById("formats").innerHTML = "Recording audio... ";

            /*  assign to gumStream for later use  */
            gumStream = stream;

            /* use the stream */
            input = audioContext.createMediaStreamSource(stream);

            /* 
                Create the Recorder object and configure to record mono sound (1 channel)
                Recording 2 channels  will double the file size
            */
            rec = new Recorder(input, {
                numChannels: 1
            })

            //start the recording process
            rec.record()

            console.log("Recording started");

        }).catch(function(err) {
            //enable the record button if getUserMedia() fails
            recordButton.disabled = false;
            stopButton.disabled = true;
            // pauseButton.disabled = true
        });
    }

    function pauseRecording() {
        console.log("pauseButton clicked rec.recording=", rec.recording);
        if (rec.recording) {
            //pause
            rec.stop();
            pauseButton.innerHTML = "Resume";
        } else {
            //resume
            rec.record()
            pauseButton.innerHTML = "Pause";

        }
    }

    function stopRecording() {
        document.getElementById('recordButton').style.display = "none";
        document.getElementById("formats").innerHTML = "Recording stopped";

        console.log("stopButton clicked");

        //disable the stop button, enable the record too allow for new recordings
        stopButton.disabled = true;
        recordButton.disabled = false;
        //pauseButton.disabled = true;

        //reset button just in case the recording is stopped while paused
        //  pauseButton.innerHTML = "Pause";

        //tell the recorder to stop the recording
        rec.stop();

        //stop microphone access
        gumStream.getAudioTracks()[0].stop();

        //create the wav blob and pass it on to createDownloadLink
        rec.exportWAV(createDownloadLink);
    }

    function createDownloadLink(blob) {

        var url = URL.createObjectURL(blob);
        var au = document.createElement('audio');
        var li = document.createElement('li');
        var link = document.createElement('a');

        //name of .wav file to use during upload and download (without extendion)
        var filename = new Date().toISOString();

        //add controls to the <audio> element
        au.controls = true;
        au.src = url;

        //save to disk link
        // link.href = url;
        // link.download = filename + ".wav"; //download forces the browser to donwload the file using the  filename
        // link.innerHTML = "Save to disk";

        //add the new audio element to li
        li.appendChild(au);
        au.classList.add('form-control');
        au.classList.add('mb-3');

        //add the filename to the li
        //  li.appendChild(document.createTextNode(filename + ".wav "))

        //add the save to disk link to li
        li.appendChild(link);

        //upload link
        var upload = document.createElement('a');
        upload.href = "#";
        upload.innerHTML = "Upload";
        upload.classList.add('btn');
        upload.classList.add('btn-success');
        upload.addEventListener("click", function(event) {
            var xhr = new XMLHttpRequest();
            //   var xhr=new HttpRequest();
            xhr.onload = function(e) {
                if (this.readyState === 4) {
                    console.log("Server returned: ", e.target.responseText);
                }
            };
            var fd = new FormData();
            fd.append("audio_data", blob, filename);
            fd.append("category_id", $('#category_id').val());
            // fd.append("_token",string,{{ csrf_token()}} );
            xhr.open("POST", "{{ route('user.save-audio') }}", true);
            xhr.send(fd);

            setTimeout(() => {
                window.location.reload(true);
            }, 1000);


        })
        li.appendChild(document.createTextNode(" ")) //add a space in between
        li.appendChild(upload) //add the upload link to li

        //add the li element to the ol
        recordingsList.appendChild(li);
        recordingsList.style.listStyle = "none";
    }
</script>


@endpush