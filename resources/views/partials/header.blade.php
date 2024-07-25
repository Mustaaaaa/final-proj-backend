<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            
            <div class="my-logo">
                <img src="{{Vite::asset('resources/img/logo.png')}}" alt="">
            </div>
            {{-- config('app.name', 'Laravel') --}}
        </a>


        {{-- Pulsante viewport --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link text-blue" href="{{ route('admin.companies.index') }}"> Ristoranti </a>
                        
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-blue dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Menu
                        </a>
                        <ul class="dropdown-menu px-2">
                            <li>
                            <a class="nav-link text-blue" href="{{ route('admin.dishes.index') }}"> Tutti i tuoi Menu </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            @foreach ($companies as $company)                            
                                <li>
                                    <a href="{{route('admin.dishes.showOne', $company->id)}}" class="text-blue">
                                        {{$company->name}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-blue dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Ordini
                        </a>
                        <ul class="dropdown-menu px-2">
                            <li>
                                <a class="nav-link text-blue" href="{{ route('admin.orders.index') }}"> Tutti i tuoi Ordini </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            @foreach ($companies as $company)                            
                                <li>                                   
                                    <a href="{{ route('admin.orders.showOne', $company->id) }}" class="text-blue">
                                        {{ $company->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-blue" href="{{ route('admin.statistics.index') }}"> Statistiche </a>
                        
                    </li>
                @endauth
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-blue" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-blue" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-blue" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-blue" href="{{ route('admin.dashboard') }}">{{__('Dashboard')}}</a>
                            <a class="dropdown-item text-blue" href="{{ url('profile') }}">{{__('Profilo')}}</a>
                            <a class="dropdown-item text-blue" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>