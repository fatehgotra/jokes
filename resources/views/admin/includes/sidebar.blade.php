<div class="leftside-menu">

    <!-- LOGO -->
    <a href="{{ route('admin.dashboard') }}" class="logo text-center logo-light">
        <span class="logo-lg" style="margin: 2%;">

            <img src="{{ asset('assets/images/logo.png') }}" height="50px">

        </span>
        <span class="logo-sm">

            <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid" height="50px">

        </span>
    </a>

    <!-- LOGO -->
    <a href="{{ route('admin.dashboard') }}" class="logo text-center logo-dark">
        <span class="logo-lg">
            {{-- <img src="assets/images/logo-dark.png" alt="" height="16"> --}}
            <h2 class="text-primary">{{ config('app.name', 'Laravel') }}</h2>
        </span>
        <span class="logo-sm">
            {{-- <img src="assets/images/logo_sm_dark.png" alt="" height="16"> --}}
            <h2 class="text-primary">RC</h2>
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-item">
                <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users" class="side-nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="22" height="22" aria-hidden="true">
                        <path strokelinecap="round" strokelinejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z">
                        </path>
                    </svg>
                    <span> Users </span>
                </a>
                <div class="{{ request()->is('admin/users') || request()->is('admin/users/*') ? 'collapse show' : 'collapse' }}" id="users">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('admin.users.index') }}">All users</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.index', ['status' => 'active']) }}">Active users</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.index', ['status' => 'inactive']) }}">Inactive users</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#jokes" aria-expanded="false" aria-controls="jokes" class="side-nav-link">
                    <i class=" mdi mdi-comment-outline"></i>
                    <span> Jokes </span>
                </a>
                <div class="{{ request()->is('admin/jokes') || request()->is('admin/jokes/*') ? 'collapse show' : 'collapse' }}" id="jokes">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('admin.jokes') }}">All Jokes</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.jokes', ['status' => 'published']) }}">Published Jokes</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.jokes', ['status' => 'unpublished']) }}">UnPublished Jokes</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.jokes.categories') }}">Categories</a>
                        </li>

                    </ul>
                </div>
            </li>

            <!-- <li class="side-nav-item">

                <a data-bs-toggle="collapse" href="#local_trivia" aria-expanded="false" aria-controls="local_trivia" class="side-nav-link">
                    <i class=" mdi mdi-gamepad-circle"></i>
                    <span> Local Trivia </span>
                </a>
                <div class="{{ request()->is('admin/local-trivia') || request()->is('admin/local-trivia/*') ? 'collapse show' : 'collapse' }}" id="local_trivia">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('admin.local-trivia') }}">Setup</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.trivia-questions') }}">Questions</a>
                        </li>

                    </ul>
                </div>

            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#true_false" aria-expanded="false" aria-controls="true_false" class="side-nav-link">
                    <i class=" mdi mdi-gamepad-circle"></i>
                    <span> True False </span>
                </a>
                <div class="{{ request()->is('admin/true-false') || request()->is('admin/true-false/*') ? 'collapse show' : 'collapse' }}" id="true_false">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('admin.true-false') }}">Setup</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.true-false-questions') }}">Questions</a>
                        </li>

                    </ul>
                </div>
            </li> -->

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                    <i class="mdi mdi-gamepad-circle"></i>
                    <span> Solo Games </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="side-nav-second-level">

                        <li class="side-nav-item">

                            <a data-bs-toggle="collapse" href="#local_trivia" aria-expanded="false" aria-controls="local_trivia" class="side-nav-link">
                                <i class="mdi mdi-minus"></i>
                                <span> Local Trivia </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="{{ request()->is('admin/local-trivia') || request()->is('admin/local-trivia/*') ? 'collapse show' : 'collapse' }}" id="local_trivia">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ route('admin.local-trivia') }}">Setup</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.trivia-questions') }}">Questions</a>
                                    </li>

                                </ul>
                            </div>

                        </li>


                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#true_false" aria-expanded="false" aria-controls="true_false" class="side-nav-link">
                                <i class="mdi mdi-minus"></i>
                                <span> True False </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="{{ request()->is('admin/true-false') || request()->is('admin/true-false/*') ? 'collapse show' : 'collapse' }}" id="true_false">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ route('admin.true-false') }}">Setup</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.true-false-questions') }}">Questions</a>
                                    </li>

                                </ul>
                            </div>
                        </li>


                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#guess_voice" aria-expanded="false" aria-controls="guess_voice" class="side-nav-link">
                                <i class="mdi mdi-minus"></i>
                                <span> Guess The Voice </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="{{ request()->is('admin/guess-the-voice') || request()->is('admin/guest-the-voice/*') ? 'collapse show' : 'collapse' }}" id="guess_voice">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ route('admin.guess-the-voice') }}">Setup</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.guess-the-voice-questions') }}">Questions</a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#guess_lcelb" aria-expanded="false" aria-controls="guess_lcelb" class="side-nav-link">
                                <i class="mdi mdi-minus"></i>
                                <span> Guess Local Celebrity </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="{{ request()->is('admin/guess-local-celebrity') || request()->is('admin/guess-local-celebrity/*') ? 'collapse show' : 'collapse' }}" id="guess_lcelb">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ route('admin.guess-local-celebrity') }}">Setup</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.guess-local-celebrity-questions') }}">Questions</a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPagesGroup" aria-expanded="false" aria-controls="sidebarPagesGroup" class="side-nav-link">
                    <i class="mdi mdi-gamepad-circle"></i>
                    <span> Group Games </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPagesGroup">
                    <ul class="side-nav-second-level">

                        <li class="side-nav-item">

                            <a data-bs-toggle="collapse" href="#group_location" aria-expanded="false" aria-controls="group_location" class="side-nav-link">
                                <i class="mdi mdi-minus"></i>
                                <span> Guess The Location </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="{{ request()->is('admin/group-guess-location') || request()->is('admin/group-guess-location/*') ? 'collapse show' : 'collapse' }}" id="group_location">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ route('admin.group-guess-location') }}">Setup</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.group-guess-location-questions') }}">Questions</a>
                                    </li>

                                </ul>
                            </div>

                        </li>

                        <li class="side-nav-item">

                            <a data-bs-toggle="collapse" href="#group_voice" aria-expanded="false" aria-controls="group_voice" class="side-nav-link">
                                <i class="mdi mdi-minus"></i>
                                <span> Guess The Voice </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="{{ request()->is('admin/group-gues-voice') || request()->is('admin/group-guess-voice/*') ? 'collapse show' : 'collapse' }}" id="group_voice">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ route('admin.group-guess-voice') }}">Setup</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.group-guess-voice-questions') }}">Questions</a>
                                    </li>

                                </ul>
                            </div>

                        </li>

                        <li class="side-nav-item">

                            <a data-bs-toggle="collapse" href="#group_celeb" aria-expanded="false" aria-controls="group_celeb" class="side-nav-link">
                                <i class="mdi mdi-minus"></i>
                                <span> Guess The Celebrity </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="{{ request()->is('admin/group-guess-celebrity') || request()->is('admin/group-guess-celebrity/*') ? 'collapse show' : 'collapse' }}" id="group_celeb">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ route('admin.group-guess-celebrity') }}">Setup</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.group-guess-celebrity-questions') }}">Questions</a>
                                    </li>

                                </ul>
                            </div>

                        </li>

                        <li class="side-nav-item">

                            <a data-bs-toggle="collapse" href="#group_grog" aria-expanded="false" aria-controls="group_grog" class="side-nav-link">
                                <i class="mdi mdi-minus"></i>
                                <span> Grog Spin The Wheel </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="{{ request()->is('admin/group-grog-wheel') || request()->is('admin/group-grog-wheel/*') ? 'collapse show' : 'collapse' }}" id="group_grog">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ route('admin.group-grog-wheel') }}">Setup</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.group-grog-wheel-questions') }}">Questions</a>
                                    </li>

                                </ul>
                            </div>

                        </li>

                    </ul>
                </div>
            </li>


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarSettings" aria-expanded="false" aria-controls="sidebarSettings" class="side-nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="22" height="22" aria-hidden="true">
                        <path strokelinecap="round" strokelinejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z">
                        </path>
                    </svg>
                    <span> Settings </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarSettings">
                    <ul class="side-nav-second-level">

                        <li>
                            <a href="{{ route('admin.password.form') }}">Change Password</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.my-account.edit', Auth::guard('admin')->id()) }}">My Account</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>

</div>