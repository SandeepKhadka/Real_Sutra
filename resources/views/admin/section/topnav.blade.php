<!-- START HEADER-->
<header class="header">
    <div class="page-brand" style="background-color: #4362D6">
        <a class="link" href="{{ route(Auth::user()->role) }}">
            <span class="brand">
                <span class="brand-tip">Sutra Accessories</span>
            </span>
        </a>
    </div>
    <div class="flexbox flex-1">
        <!-- START TOP-LEFT TOOLBAR-->
        <ul class="nav navbar-toolbar">
            {{-- <li>
                <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
            </li> --}}
        </ul>
        <!-- END TOP-LEFT TOOLBAR-->
        <!-- START TOP-RIGHT TOOLBAR-->
        <ul class="nav navbar-toolbar">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle link" href="#" id="navbarDropdown" role="button"
                    aria-haspopup="true" aria-expanded="false" onclick="toggleLogoutDropdown()">
                    🙍‍♂️
                    {{ auth()->user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" id="dropdownMenu">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout_form').submit();" style="background-color: red; color: white">
                        Logout</a>
                    <form action="{{ route('logout') }}" method="post" class="" id="logout_form">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <!-- END TOP-RIGHT TOOLBAR-->
    </div>
</header>
<!-- END HEADER-->

