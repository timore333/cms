<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href=""
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="{{auth()->user()->profile_photo_url}}" alt="user" class="img-circle" width="30">
    </a>
    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
        <span class="with-arrow"><span class="bg-primary"></span></span>
        <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
            <div class="">
                <img src="{{auth()->user()->profile_photo_url}}" alt="user" class="img-circle" width="60">
            </div>
            <div class="m-l-10">
                <h4 class="m-b-0">{{auth()->user()->name}}</h4>
                <p class=" m-b-0">{{auth()->user()->email}}</p>
            </div>
        </div>
        <a class="dropdown-item" href="{{route('profile.show')}}"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
{{--        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>--}}
{{--        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i>Inbox</a>--}}

{{--        <div class="dropdown-divider"></div>--}}

{{--        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i>Account Setting</a>--}}

        <div class="dropdown-divider"></div>
        @include('layouts.partials.topbar.logout')
    </div>

</li>
