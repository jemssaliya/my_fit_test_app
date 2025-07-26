<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{App::environment('production') ? 'https://myfittest.com.au': '/'}}">
            <img src="/images/logo@2x.png" height="35" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link"
                       href="{{App::environment('production') ? 'https://myfittest.com.au': '/'}}">Home</a>
                </li>

                @guest
                @else
                    <li class="nav-item active">
                        <a class="nav-link" href="/clients">Clients</a>
                    </li>
                @endguest
            </ul>

            <ul class="navbar-nav ml-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                Sign In
                            </a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{App::environment('production')
                                        ? 'https://myfittest.com.au/index.php/pricing/'
                                        : '/register'}}"
                            >
                                Sign Up
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}  {{Auth::user()->last_name}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-refine"
                             aria-labelledby="navbarDropdown" style="padding:10px;">
                            <a class="dropdown-item" href="/user/profile">{{ __('My Profile') }}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('manage.subscription')}}">Manage Subscription</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}">{{ __('Logout') }}
                            </a>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
