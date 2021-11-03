<!-- NAVBAR, SECTION START -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/dashboard') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- NAVBAR BUTTONS, SECTION START -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="">
                        {{ __('navbar.navbar_menu.first_button') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="">
                        {{ __('navbar.navbar_menu.second_button') }}
                    </a>
                </li>
            </ul>
            <!-- NAVBAR BUTTONS, SECTION END -->
        </div>
    </div>
</nav>
<!-- NAVBAR, SECTION END -->