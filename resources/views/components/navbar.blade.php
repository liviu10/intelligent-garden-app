<!-- NAVBAR, SECTION START -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- NAVBAR BUTTONS, SECTION START -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ url('/') }}">
                        {{ __('navbar.navbar_menu.first_button') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ url('/list-of-equipments') }}">
                        {{ __('navbar.navbar_menu.second_button') }}
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                        href="#"
                        id="navbarDropdown"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        {{ __('navbar.navbar_menu.third_button.title') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ url('/ph-records') }}">
                                {{ __('navbar.navbar_menu.third_button.dropdown.item_1') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('/ec-records') }}">
                                {{ __('navbar.navbar_menu.third_button.dropdown.item_2') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('/level-records') }}">
                                {{ __('navbar.navbar_menu.third_button.dropdown.item_3') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('/pump1-records') }}">
                                {{ __('navbar.navbar_menu.third_button.dropdown.item_4') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('/pump2-records') }}">
                                {{ __('navbar.navbar_menu.third_button.dropdown.item_5') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('/pump3-records') }}">
                                {{ __('navbar.navbar_menu.third_button.dropdown.item_6') }}
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- NAVBAR BUTTONS, SECTION END -->
        </div>
    </div>
</nav>
<!-- NAVBAR, SECTION END -->