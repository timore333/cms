<aside class="left-sidebar">
    @include('layouts.partials.sidebar.logo')

    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                @include('layouts.partials.sidebar.calendar')
                @include('layouts.partials.sidebar.dashboards')
                @include('layouts.partials.sidebar.user_managments')
                @include('layouts.partials.sidebar.medical')
                @include('layouts.partials.sidebar.ledgers')
                @include('layouts.partials.sidebar.store')
                @include('layouts.partials.sidebar.setting')
            </ul>
        </nav>

    </div>

</aside>
