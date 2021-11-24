<header class="section-header">
    <section class="header-main">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-1">
                    <div class="brand-wrap">
                        <a href="{{ url('/') }}">
                            <img class="logo" src="{{ asset('frontend/images/logo-dark.png') }}" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 mr-2">
                    <search-header></search-header>
                </div>
                <div class="col-lg-3 col-sm-6 ml-1 justify-content-end">
                    <div class="widgets-wrap d-flex justify-content-end">
                    <div class="widget-header">
                            <a href="#" class="icontext">
                                <div class="icon-wrap icon-xs bg2 round text-secondary"><i
                                        class="fa fa-shopping-cart"></i></div>
                                <div class="text-wrap">
                                   
                                </div>
                            </a>
                    </div>
                        @guest
                            <div class="widget-header">
                                <a href="{{ route('login') }}" class="ml-3 icontext">
                                    <div class="icon-wrap icon-xs bg-primary round text-white"><i class="fa fa-user"></i></div>
                                    <div class="text-wrap"><span> Farmer Login</span></div>
                                </a>
                            </div>
                            <div class="widget-header">
                                <a href="{{ route('register') }}" class="ml-3 icontext">
                                    <div class="icon-wrap icon-xs bg-success round text-white"><i class="fa fa-user"></i></div>
                                    <div class="text-wrap"><span>Farmer Register</span></div>
                                </a>
                            </div>
                        @else
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->full_name }} <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Orders</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('site.partials.nav')
</header>