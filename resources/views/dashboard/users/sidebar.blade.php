@php



$info = $orders = $desgins =  '';


switch (request()->segment(5)) {
	case null:
		$info = 'active';
	break;
	case 'orders':
		$orders = 'active';
	break;
	case 'desgins':
		$desgins = 'active';
	break;

	default:

	break;
}

@endphp

<ul class="nav nav-sidebar">
	<li class="nav-item">
		<a href="{{ route('dashboard.users.show' , $user ) }}" class="nav-link {{ $info }} "  >
			<i class="icon-user"></i>
			البيانات الاساسيه
		</a>
	</li>
	<li class="nav-item">
		<a href="{{ route('dashboard.designs.index').'?user_id='.$user->id }}" class="nav-link {{ $desgins }} " >
			<i class="icon-cart2"></i>
				التصميمات
			<span class="badge badge-dark badge-pill ml-auto"> {{ $user->designs()->count() }} </span>
		</a>
	</li>

	<li class="nav-item">
		<a href="{{ route('dashboard.orders.index').'?user_id='.$user->id}}" class="nav-link {{ $orders }} " target="_blank">
			<i class="icon-cart2"></i>
			الطلبات
			<span class="badge badge-dark badge-pill ml-auto"> {{ $user->orders()->count() }} </span>
		</a>
	</li>

	<li class="nav-item">
		<a href="{{ route('dashboard.withdrawals.index').'?user='.$user->id}}" class="nav-link " target="_blank">
			<i class="icon-cart2"></i>
			{{__('site.withdrawals')}}
			<span class="badge badge-dark badge-pill ml-auto"> {{ $user->withdrawals()->count() }} </span>
		</a>
	</li>


{{--	<li class="nav-item-divider"></li>--}}
{{--	<li class="nav-item">--}}
{{--		<a target="_blank" href="{{ route('dashboard.users.login' , $user ) }}" class="nav-link" >--}}
{{--			<i class="icon-switch2"></i>--}}
{{--			تسجيل الدخول باسم المسوق--}}
{{--		</a>--}}
{{--	</li>--}}
</ul>
