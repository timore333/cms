@if(auth()->user()->hasPermission('access ledgers'))
    <li class="nav-small-cap"></li>
    <li><a href="#">@lang('general.ledgers') <i class="icon-chart"></i></a></li>
@endif