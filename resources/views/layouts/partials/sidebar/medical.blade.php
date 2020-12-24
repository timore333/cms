@if(auth()->user()->hasPermission('access medical'))
    <li class="nav-small-cap"></li>
    <li>
        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
            <i class=" icon-heart"></i>
            <span class="hide-menu">@lang('general.medical') </span>
        </a>
        <ul aria-expanded="false" class="collapse">
                    <li><a href="{{route('patients.index')}}">@lang('general.patients') <i class="fa fa-wheelchair "></i></a></li>
                    <li><a href="{{route('drugs.index')}}">@lang('general.drugs') <i class="fa fa-flask "></i></a></li>
                    <li><a href="{{route('companies.index')}}">@lang('general.insurance') <i class="fa fa-building "></i></a></li>
                    <li><a href="{{route('procedures.index')}}">@lang('general.procedures') <i class="fa fa-chain "></i></a></li>
                    <li><a href="{{route('labs.index')}}">@lang('general.lab') <i class="fa fa-thermometer-0 "></i></a></li>

        </ul>
    </li>
@endif