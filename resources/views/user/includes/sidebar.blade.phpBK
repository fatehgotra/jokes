<div class="leftside-menu">

    <!-- LOGO -->
    <a href="{{ route('admin.dashboard') }}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo" height="50px">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo" class="img-fluid" height="50px">
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
            @unlessrole('course-coordinator|community-head')
            <li class="side-nav-item {{ request()->is('admin/volunteers') || request()->is('admin/volunteers/*') ? 'menuitem-active' : '' }}">
                <a data-bs-toggle="collapse" href="#volunteers" aria-expanded="false" aria-controls="volunteers" class="side-nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="22" height="22" aria-hidden="true">
                        <path strokelinecap="round" strokelinejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z">
                        </path>
                    </svg>
                    <span> Volunteers </span>
                    @role('admin')
                    <span class="badge bg-dark float-end me-1">{{ \App\Models\User::whereIn('role', ['volunteer', 'both'])->count() }}</span>
                    @else
                    @php
                    $branch = Auth::guard('admin')->user()->branch;
                    @endphp
                    @if( !is_null($branch) )
                    <span class="badge bg-dark float-end me-1">{{ \App\Models\User::with('lodgementInformation')->whereHas('lodgementInformation', function ($q) use ($branch) {
                                $q->where(function ($q) use ($branch) {
                                    $q->whereIn('registration_location_type', $branch);
                                });
                            })->whereIn('role', ['volunteer', 'both'])->count() }}</span>
                    @endif

                    @endrole
                </a>
                <div class="{{ request()->is('admin/volunteers') || request()->is('admin/volunteers/*') ? 'collapse show' : 'collapse' }}" id="volunteers">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('admin.volunteers.index', ['status' => 'pending']) }}">Pending Volunteers</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.volunteers.index', ['status' => 'approve']) }}">Approved Volunteers</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.volunteers.index', ['status' => 'decline']) }}">Declined Volunteers</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.volunteers.index', ['active' => 'yes']) }}">Active Volunteers</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.volunteers.index', ['active' => 'no']) }}">Non Active Volunteers</a>
                        </li>
                    </ul>
                </div>
            </li>


            @endunlessrole
            @unlessrole('course-coordinator|community-head')
            <li class="side-nav-item {{ request()->is('admin/members') || request()->is('admin/members/*') ? 'menuitem-active' : '' }}">
                <a data-bs-toggle="collapse" href="#members" aria-expanded="false" aria-controls="members" class="side-nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="22" height="22" aria-hidden="true">
                        <path strokelinecap="round" strokelinejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z">
                        </path>
                    </svg>
                    <span> Members </span>
                    @role('admin')
                    <span class="badge bg-dark float-end me-1">{{ \App\Models\User::whereIn('role', ['member', 'both'])->count() }}</span>
                    @else
                    @php
                    $branch = Auth::guard('admin')->user()->branch;
                    @endphp
                    @if( !is_null($branch) )
                    <span class="badge bg-dark float-end me-1">{{ $cn = \App\Models\User::with('lodgementInformation')->whereHas('lodgementInformation', function ($q) use ($branch) {
                                $q->where(function ($q) use ($branch) {
                                    $q->whereIn('registration_location_type', $branch);
                                });
                            })->whereIn('role', ['member', 'both'])->count() }}</span>
                    @endif

                    @endrole
                </a>
                <div class="{{ request()->is('admin/members') || request()->is('admin/members/*') ? 'collapse show' : 'collapse' }}" id="members">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('admin.members.index', ['status' => 'pending']) }}">Pending Members</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.members.index', ['status' => 'approve']) }}">Approved Members</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.members.index', ['status' => 'decline']) }}">Declined Members</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.members.index', ['active' => 'yes']) }}">Active Members</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.members.index', ['active' => 'no']) }}">Non Active Members</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item {{ request()->is('admin/generate-report') || request()->is('admin/generate-report/*') ? 'menuitem-active' : '' }}">
                <a data-bs-toggle="collapse" href="#report" aria-expanded="false" aria-controls="report" class="side-nav-link">
                    <i class="mdi mdi-book-open-page-variant-outline"></i>
                    <span> Reports </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="{{ request()->is('admin/generate-report') || request()->is('admin/generate-report/*') || request()->is('admin/hours') || request()->is('admin/hours/*') ? 'collapse show' : 'collapse'   }}" id="report">
                    <ul class="side-nav-second-level">
                        @role('admin')
                        <li class="{{ request()->is('admin/generate-report') || request()->is('admin/generate-report/*') ? 'menuitem-active' : '' }}">
                            <a href="{{ route('admin.generate-report') }}">Generate Report</a>
                        </li>
                        @endrole
                        <li class="{{ request()->is('admin/hours') || request()->is('admin/hours/*') ? 'menuitem-active' : '' }}">
                            <a href="{{ route('admin.hours') }}">Add Hours Report</a>
                        </li>
                    </ul>
                </div>

            </li>

            @endunlessrole

            @unlessrole('course-coordinator')


            <li class="side-nav-item {{ request()->is('admin/campaigns') || request()->is('admin/campaigns/*') ? 'menuitem-active' : ''  }}">
                <a data-bs-toggle="collapse" href="#activity" aria-expanded="false" aria-controls="report" class="side-nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" width="22" height="22">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.712 4.33a9.027 9.027 0 011.652 1.306c.51.51.944 1.064 1.306 1.652M16.712 4.33l-3.448 4.138m3.448-4.138a9.014 9.014 0 00-9.424 0M19.67 7.288l-4.138 3.448m4.138-3.448a9.014 9.014 0 010 9.424m-4.138-5.976a3.736 3.736 0 00-.88-1.388 3.737 3.737 0 00-1.388-.88m2.268 2.268a3.765 3.765 0 010 2.528m-2.268-4.796a3.765 3.765 0 00-2.528 0m4.796 4.796c-.181.506-.475.982-.88 1.388a3.736 3.736 0 01-1.388.88m2.268-2.268l4.138 3.448m0 0a9.027 9.027 0 01-1.306 1.652c-.51.51-1.064.944-1.652 1.306m0 0l-3.448-4.138m3.448 4.138a9.014 9.014 0 01-9.424 0m5.976-4.138a3.765 3.765 0 01-2.528 0m0 0a3.736 3.736 0 01-1.388-.88 3.737 3.737 0 01-.88-1.388m2.268 2.268L7.288 19.67m0 0a9.024 9.024 0 01-1.652-1.306 9.027 9.027 0 01-1.306-1.652m0 0l4.138-3.448M4.33 16.712a9.014 9.014 0 010-9.424m4.138 5.976a3.765 3.765 0 010-2.528m0 0c.181-.506.475-.982.88-1.388a3.736 3.736 0 011.388-.88m-2.268 2.268L4.33 7.288m6.406 1.18L7.288 4.33m0 0a9.024 9.024 0 00-1.652 1.306A9.025 9.025 0 004.33 7.288" />
                    </svg>
                    <span> Activities </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="{{ request()->is('admin/campaigns') || request()->is('admin/campaigns/*') || request()->is('admin/community-activity') || request()->is('admin/community-activity/*')  ? 'collapse show' : 'collapse'   }}" id="activity">
                    <ul class="side-nav-second-level">
                        @role('admin')
                        <li class="{{ request()->is('admin/generate-report') || request()->is('admin/generate-report/*') ? 'menuitem-active' : '' }}">
                            <a href="{{ route('admin.campaigns.index') }}">Global Activities </a>
                        </li>
                        @endrole
                        <li class="{{ request()->is('admin/community') || request()->is('admin/community/*')   ? 'menuitem-active' : ''  }}">
                            <a href="{{ route('admin.community') }}"> Community Activity </a>
                        </li>
                        @role('community-head')
                        <li class="{{ request()->is('admin/community-activity') || request()->is('admin/community-activity/*')   ? 'menuitem-active' : ''  }}">
                            <a href="{{ route('admin.community-activity') }}"> Add Community Activity </a>
                        </li>
                        @endrole
                    </ul>
                </div>

            </li>


            @endunlessrole



            @role('admin')

            <li class="side-nav-item {{ request()->is('admin/alerts') || request()->is('admin/alerts/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('admin.alerts.index') }}" class="side-nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" width="22" height="22" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5" />
                    </svg>

                    <span> Alerts </span>
                </a>
            </li>

            <li class="side-nav-item {{ request()->is('admin/updates') || request()->is('admin/updates/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('admin.updates.index') }}" class="side-nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" width="22" height="22">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                    </svg>


                    <span> Updates </span>
                </a>
            </li>


            <li class="side-nav-item {{ request()->is('admin/survey-forms') || request()->is('admin/survey-forms/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('admin.survey-forms') }}" class="side-nav-link">
                    <i class="mdi mdi-bulletin-board"></i>
                    <span> Surveys </span>
                </a>
            </li>

            <li class="side-nav-item {{ request()->is('admin/mapping') || request()->is('admin/mapping/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('admin.mapping') }}" class="side-nav-link">
                    <i class="mdi mdi-map"></i>
                    <span> Interactive Map</span>
                </a>
            </li>

            @endrole


            @hasanyrole('admin|course-coordinator')

            <li class="side-nav-item {{ request()->is('admin/learning/courses') || request()->is('admin/learning/courses/*') || request()->is('admin/learning/mcqs') || request()->is('admin/learning/mcqs/*') || request()->is('admin/learning/videos') || request()->is('admin/learning/videos/*') ? 'menuitem-active' : '' }}">
                <a data-bs-toggle="collapse" href="#learning" aria-expanded="false" aria-controls="learning" class="side-nav-link">
                    <svg class="shrink-0" width="22" height="22" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <span> Learning </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="{{ request()->is('admin/learning/courses') || request()->is('admin/learning/courses/*') || request()->is('admin/learning/mcqs') || request()->is('admin/learning/mcqs/*') || request()->is('admin/learning/videos') || request()->is('admin/learning/videos/*') || request()->is('admin/learning/chat-requests') || request()->is('admin/learning/chat-requests/*') ? 'collapse show' : 'collapse' }}" id="learning">
                    <ul class="side-nav-second-level">
                        <li class="{{ request()->is('admin/learning/courses') || request()->is('admin/learning/courses/*') ? 'menuitem-active' : '' }}">
                            <a href="{{ route('admin.courses.index') }}">Courses</a>
                        </li>
                        <li class="{{ request()->is('admin/learning/mcqs') || request()->is('admin/learning/mcqs/*') ? 'menuitem-active' : '' }}">
                            <a href="{{ route('admin.mcqs.index') }}">MCQs</a>
                        </li>
                        <li class="{{ request()->is('admin/learning/videos') || request()->is('admin/learning/videos/*') ? 'menuitem-active' : '' }}">
                            <a href="{{ route('admin.videos.index') }}">Videos</a>
                        </li>
                        <li class="{{ request()->is('admin/learning/chat-requests') || request()->is('admin/learning/chat-requests/*') ? 'menuitem-active' : '' }}">
                            <a href="{{ route('admin.ticket-list') }}">Chat Request</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endhasanyrole

            @role('admin')
            <li class="side-nav-item">
                <a href="{{ route('admin.admins.index') }}" class="side-nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="22" height="22">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>

                    <span> User Management </span>
                </a>
            </li>
            @endrole

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
                        @role('admin')
                        <li>
                            <a href="{{ route('admin.site-settings') }}">Site Settings</a>
                        </li>
                        @endrole
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