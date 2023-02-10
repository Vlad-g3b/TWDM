<!doctype html>
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'MyBills') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                @auth
                <li class="nav-item"> 
                    <a class="nav-link" href="{{route('home')}}">{{ __('Dashboard')}}</a>
                </li>
                <li class="nav-item"> 
                    <a class="nav-link" href="{{route('bills')}}">{{ __('Bills')}}</a>
                </li>
                <li class="nav-item"> 
                    <a class="nav-link" href="{{route('categories')}}">{{ __('Categories')}}</a>
                </li>
                <li class="nav-item"> 
                    <a class="nav-link" href="{{route('addresses')}}">{{ __('Addresses')}}</a>
                </li>
                <li class="nav-item"> 
                    <a class="nav-link" href="{{route('history')}}">{{ __('History')}}</a>
                </li>
                <li class="nav-item"> 
                    <a class="nav-link" href="{{route('contact')}}">{{ __('Contact')}}</a>
                </li>
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('wallet') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('wallet-form').submit();">
                             {{ __('Wallet') }}
                         </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <form id="wallet-form" action="{{ route('wallet') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</html>