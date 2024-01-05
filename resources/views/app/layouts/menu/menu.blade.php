<div class="header-menu">
    @yield('titulo-app')
    <div class="header-icons"></div>
    <button class="btn-setting" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar_menu"
        aria-controls="sidebar_menu">
        <span><i class='fa-solid fa-bars'></i></span>
    </button>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar_menu" aria-labelledby="sidebar_menuLabel">
        <div class="offcanvas-header">
            @if (Auth::check() && Auth::user()->photo == true)
                @php
                    $id = Auth::user()->id;
                @endphp
                <img class="user-photo" src="{{ asset("assets/storage/profile/users/$id/photo/profile.jpg") }}"
                    alt="Foto de Perfil">
            @else
                @php
                    $letter = Auth::user()->username[0];
                @endphp
                <img class="user-photo" src="{{ asset("assets/storage/profile/letters/$letter.jpg") }}"
                    alt="Foto de Perfil">
            @endif

            <h5 class="offcanvas-title user-title" id="sidebar_menuLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body options-menu">
            @if (Auth::check())
                @if (Auth::user()->role->level == 1)
                    @include('app.layouts.menu.sidebar.dev')
                @endif
                @if (Auth::user()->role->level == 2)
                    @include('app.layouts.menu.sidebar.admin')
                @endif
                @if (Auth::user()->role->level == 3)
                    @include('app.layouts.menu.sidebar.manager')
                @endif
                @if (Auth::user()->role->level == 4)
                    @include('app.layouts.menu.sidebar.driver')
                @endif
                @if (Auth::user()->role->level == 5)
                    @include('app.layouts.menu.sidebar.commerce')
                @endif
                @if (Auth::user()->role->level == 6)
                    @include('app.layouts.menu.sidebar.user')
                @endif

            @endif
        </div>
    </div>
</div>

<div class="footer-menu">
    @if (Auth::check())
        @if (Auth::user()->role->level == 1)
            @include('app.layouts.menu.footer.dev')
        @endif
        @if (Auth::user()->role->level == 2)
            @include('app.layouts.menu.footer.admin')
        @endif
        @if (Auth::user()->role->level == 3)
            @include('app.layouts.menu.footer.manager')
        @endif
        @if (Auth::user()->role->level == 4)
            @include('app.layouts.menu.footer.driver')
        @endif
        @if (Auth::user()->role->level == 5)
            @include('app.layouts.menu.footer.commerce')
        @endif
        @if (Auth::user()->role->level == 6)
            @include('app.layouts.menu.footer.user')
        @endif

    @endif
</div>
