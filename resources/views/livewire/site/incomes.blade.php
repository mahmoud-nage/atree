<div>
    @foreach ($incomes as $income)
    @if ($income->amount < 0 )
    <div class="alert alert-danger" role="alert">
        <strong> {{ $income->amount }} </strong> {{__('site.SAR')}}  {{ $income->comment }}
    </div>
    @else
    <div class="alert alert-success" role="alert">
        <strong> {{ $income->amount }} </strong> {{__('site.SAR')}}  {{ $income->comment }}
    </div>
    @endif
    @endforeach
</div>
