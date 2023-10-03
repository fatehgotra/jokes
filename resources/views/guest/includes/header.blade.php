<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container-fluid content-row">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ url('/') }}" class="logo">
                        <h3>SHOP N SAVE</h3>
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
                        <li><a href="{{ route('user.login') }}">Login <img src="assets/images/profile-header.jpg" alt=""></a></li>


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
<!-- ***** Header Area End ***** -->