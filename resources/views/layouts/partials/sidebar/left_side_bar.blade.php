<aside class="left-sidebar">
    @include('layouts.partials.sidebar.logo')

    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                @include('layouts.partials.sidebar.dashboards')
                @include('layouts.partials.sidebar.user_managments')

                <li class="nav-small-cap"></li>

                @include('layouts.partials.sidebar.medical')

                <li class="nav-small-cap"></li>
                @include('layouts.partials.sidebar.ledgers')
                <li class="nav-small-cap"></li>
                @include('layouts.partials.sidebar.store')
                <li class="nav-small-cap"></li>

                @include('layouts.partials.sidebar.setting')
            </ul>
        </nav>

    </div>

</aside>
