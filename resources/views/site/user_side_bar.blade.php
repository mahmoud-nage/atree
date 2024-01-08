@php
$account =  $orders =  $wishlist = $wallet  =  $incomes =  $statistics =  $withdrawals = '';
switch (Request()->segment(2)) {
    case 'account':
    $account = 'active';
    break;
     case 'orders':
    $orders = 'active';
    break;
     case 'wishlist':
    $wishlist = 'active';
    break;
     case 'incomes':
    $incomes = 'active';
    break;
     case 'statistics':
    $statistics = 'active';
    break;
    case 'withdrawals':
    $withdrawals = 'active';
    break;
     case 'wallet':
    $wallet = 'active';
    break;

    default:
            // code...
    break;
}
@endphp

<a class="list-group-item {{ $account }}" href="{{ route('site.account') }}"> الحساب الشخصى </a>
<a class="list-group-item {{ $wallet }}" href="{{ route('site.wallet') }}"> المحفظه </a>
<a class="list-group-item {{ $orders }}" href="{{ route('site.orders.index') }}"> طلباتى </a>
<a class="list-group-item {{ $wishlist }}" href="{{ route('site.wishlist') }}"> قائمه الامنيات </a>
<a class="list-group-item {{ $incomes }}" href="{{ route('site.incomes') }}"> الارباح </a>
<a class="list-group-item {{ $statistics }}" href="{{ route('site.statistics') }}"> الاحصئيات </a>
<a class="list-group-item {{ $withdrawals }}" href="{{ route('site.withdrawals') }}"> طلبات سحب الارباح </a>
<a class="list-group-item" href="{{ route('user.logout') }}"> تسجيل الخروج </a>