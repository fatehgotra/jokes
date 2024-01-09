<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container-fluid content-row">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ url('/') }}" class="logo">
                        <img src="{{ asset('assets/images/logo.png') }}" >
                        <!-- <h3 style="font-weight: 400;">SHOP N SAVE</h3> -->
                    </a>
                    <!-- <a href="index.html" class="logo">
                        <img src="assets/images/logo.png" alt="">
                    </a> -->
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Search End ***** -->
                    <!-- <div class="search-input">
                      <form id="search" action="#">
                        <input type="text" placeholder="Type Something" id='searchText' name="searchKeyword" onkeypress="handle" />
                        <i class="fa fa-search"></i>
                      </form>
                    </div> -->
                    <!-- ***** Search End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="{{ url('/') }}" class="active">Home</a></li>
                        <li><a href="{{ url('/#games') }}">Games</a></li>
                        <li><a href="{{ url('jokes') }}">Jokes</a></li>
                        <li class="dropdown"><a class="dropbtn" href="#">Drua</a>
                            <div class="dropdown-content">
                                <a href="https://webmediaclients.com/shopnsaveecom/index.php/product-category/ticket-purchases/">Drua Purchase Ticket</a>
                                <a href="https://webmediaclients.com/shopnsaveecom/index.php/product-category/merchandise-purchases/">Drua Merchandise Purchases</a>
                            </div>
                        </li>
                        <li class="dropdown"><a class="dropbtn" href="#">Health</a>
                            <div class="dropdown-content">
                                <a href="https://webmediaclients.com/shopnsaveecom/index.php/exercise-with-jordan-pillay">Exercise with Jordan Pillay</a>
                                <a href="https://webmediaclients.com/shopnsaveecom/index.php/recipe-cuisines">Healthy Recipes</a>
                            </div>
                        </li>
                        <li><a href="https://webmediaclients.com/shopnsaveecom/index.php/product-category/store/">Store</a></li>
                        <li><a href="https://webmediaclients.com/shopnsaveecom/index.php/category/promotions/">Promotion</a></li>

                        @if( is_null( Auth::guard('user')->user() ) && is_null(Auth::guard('group_user')->user() ))
                        <li class="logb1"><a href="{{ route('user.login') }}">Login <i class="fa fa-sign-in" aria-hidden="true"></i>  </a></li>
                        @elseif( !is_null(Auth::guard('group_user')->user() ) )
                        
                        <li class="dropdown">
                            <a class="dropbtn" href="#">{{ Auth::guard('group_user')->user()->display_name }}</a>
                            <div class="dropdown-content" style="min-width: 0px;">
                                <a href="{{ route('user.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                                    <i class="mdi mdi-logout mr-1"></i>
                                    <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{  route('group.group-logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                        @else
                        <li class="dropdown">
                            <a class="dropbtn" href="#">{{  Auth::guard('user')->user()->name }}</a>
                            <div class="dropdown-content" style="min-width: 0px;">
                                <a href="{{ route('user.my-account.edit', Auth::guard('user')->id()) }}">My Profile</a>
                                <a href="{{ route('user.dashboard') }}">Dashboard</a>
                                <a href="{{ route('user.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                                    <i class="mdi mdi-logout mr-1"></i>
                                    <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{  route('user.logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                        @endif


                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<style>
    .logb {
        background-color: #418BE0;
        border-radius: 23px;
    }
    /* .logo{
        background-image: url('{{asset("assets/images/logo.png")}}') no-repeat;
        background-size: cover;
    } */
</style>
<!-- ***** Header Area End ***** -->