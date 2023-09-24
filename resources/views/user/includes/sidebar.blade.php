<div class="leftside-menu">

    <!-- LOGO -->
    <a href="{{ route('user.dashboard') }}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('assets/welcome.png') }}" alt="logo" height="50px">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/welcome.png') }}" alt="logo" class="img-fluid" height="50px">
        </span>
    </a>

    <!-- LOGO -->
    <a href="{{ route('user.dashboard') }}" class="logo text-center logo-dark">
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
                <a href="{{ route('user.dashboard') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#jokes" aria-expanded="false" aria-controls="jokes" class="side-nav-link">
                   <i class=" mdi mdi-comment-outline"></i>
                    <span> Jokes </span>
                </a>
                    <div class="{{ request()->is('user/jokes') || request()->is('user/jokes/*') ? 'collapse show' : 'collapse' }}" id="jokes">
                        <ul class="side-nav-second-level">
                        <li>
                                <a href="{{ route('user.jokes') }}">All Jokes</a>
                            </li>
                            <li>
                                <a href="{{ route('user.jokes', ['status' => 'published']) }}">Published Jokes</a>
                            </li>
                            <li>
                                <a href="{{ route('user.jokes', ['status' => 'unpublished']) }}">UnPublished Jokes</a>
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
                            <a href="{{ route('user.password.form') }}">Change Password</a>
                        </li>
                        <li>
                            <a href="{{ route('user.my-account.edit', Auth::guard('user')->id() ) }}">My Account</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>

</div>