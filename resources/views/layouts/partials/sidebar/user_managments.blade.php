<li>
	<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
		<i class="icon-people"></i>
		<span class="hide-menu">@lang('general.user_management')</span>
	</a>
	<ul aria-expanded="false" class="collapse">
	    <li><a href="{{url('users')}}">@lang('general.users') <i class="icon-user"></i></a></li>

	    <li><a href="{{url('roles')}}">@lang('general.roles') <i class="icon-lock"></i></a></li>

{{-- 	permission not for users, thay cant change it or create new
	<li><a href="{{url('permissions')}}">Premissions <i class="icon-key text-danger"></i></a></li>
	 --}}
	</ul>
</li>