<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        @include('layouts.partials.topbar.logo')
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto">
                @include('layouts.partials.topbar.left_sidebar_toggle')
                @include('layouts.partials.topbar.comments')
{{--                @include('layouts.partials.topbar.message')--}}
{{--                @include('layouts.partials.topbar.search')--}}
            </ul>

            <ul class="navbar-nav my-lg-0">
{{--                @include('layouts.partials.topbar.mega')--}}
                @include('layouts.partials.topbar.user_profile')
                @include('layouts.partials.topbar.right_sidebar_toggle')
            </ul>
        </div>
    </nav>
</header>
