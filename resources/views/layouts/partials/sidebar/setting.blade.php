@if(auth()->user()->hasPermission('access setting'))
     <li class="nav-small-cap"></li>
    <li>
        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
            <i class=" icon-wrench"></i>
            <span class="hide-menu">@lang('general.setting') </span>
        </a>

        <ul aria-expanded="false" class="collapse">

            {{--        <li><a href="{{route('priceLists.index')}}">@lang('general.priceLists')<i class="fa  fa-file-text"></i></a></li>--}}
            {{--        <li><a href="{{route('suppliers.index')}}">@lang('general.suppliers') <i class="fa fa-id-card"></i></a></li>--}}
            {{--        <li><a href="{{route('banks.index')}}">@lang('general.banks') <i class="fa fa-bank"></i></a></li>--}}
            {{--        <li><a href="{{route('allergies.index')}}">@lang('general.allergies') <i class="fa fa-circle-o"></i></a></li>--}}
            {{--        <li><a href="{{route('diseases.index')}}">@lang('general.diseases') <i class="fa fa-circle-o"></i></a></li>--}}


            <li><a href="#">@lang('general.priceLists')<i class="fa  fa-file-text"></i></a></li>
            <li><a href="#">@lang('general.suppliers') <i class="fa fa-id-card"></i></a></li>
            <li><a href="#">@lang('general.banks') <i class="fa fa-bank"></i></a></li>
            <li><a href="#">@lang('general.allergies') <i class="fa fa-circle-o"></i></a></li>
            <li><a href="#">@lang('general.diseases') <i class="fa fa-circle-o"></i></a></li>


            {{-- 	 <li><a href="{{route('dental-companies.index')}}">Medical Companies <i class="fa fa-circle-o text-secondary"></i></a></li> --}}


        </ul>
    </li>
@endif

