<div class="navbar-custom">
    <ul class="list-unstyled topbar-menu float-end mb-0">       

        <!-- <li class="notification-list">
            <a class="nav-link end-bar-toggle" href="javascript: void(0);">
                <i class="mdi mdi-spin dripicons-gear noti-icon"></i>
            </a>
        </li> -->

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                aria-expanded="false">
                <span class="account-user-avatar"> 
                    @isset(Auth::user()->avatar)
                        <img src="{{ asset('storage/uploads/admin/'.Auth::user()->avatar) }}" alt="user-image" class="rounded-circle">
                    @else
                        <img src="{{ asset('assets_admin/images/users/avatar.png') }}" alt="user-image" class="rounded-circle">
                    @endif
                </span>
                <span>
                    <!-- <span class="account-user-name">{{ Auth::guard('admin')->user()->name }}</span> -->
                  
                        <span class="account-position">Administrator</span>
                   
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome !</h6>
                </div>

                <!-- item-->
                <a href="{{ route('admin.my-account.edit', Auth::guard('admin')->id()) }}" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-circle me-1"></i>
                    <span>My Account</span>
                </a>

                <!-- item-->
                <a href="{{ route('admin.password.form') }}" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-edit mr-1"></i>
                    <span>Change Password</span>
                </a>

                <!-- item-->
                <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                    <i class="mdi mdi-logout mr-1"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ 'App\Models\Admin' == Auth::getProvider()->getModel() ? route('admin.logout') : route('admin.logout') }}" method="POST" style="display: none;">
                   {{ csrf_field() }}
               </form>
            </div>
        </li>

    </ul>
    <button class="button-menu-mobile open-left">
        <i class="mdi mdi-menu"></i>
    </button>    
</div>