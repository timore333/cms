<a class="dropdown-item" href="javascript:void(0)" onclick="$('#logout').submit()">
    <i class="fa fa-power-off m-r-5 m-l-5"></i> Logout
</a>

<form id="logout" action="{{route('logout')}}" method="post">
    {{ csrf_field() }}
</form>