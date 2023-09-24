<div class="row">
    <div class="col-12">

            <div class="card">
                <div class="card-header">
                   Latest Users
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>phone</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if( count($users) > 0 )
                                    @foreach ($users as $user)
                                  
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email}}</td>
                                        <td>{{ $user->phone}}</td>
                                        <td>
                                            @if($user->status == 1)
                                            <span class="badge badge-outline-success">Active</span>
                                            @else
                                            <span class="badge badge-outline-danger">Inactive</span>
                                            @endif

                                        </td>

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
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
