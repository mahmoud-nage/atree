{{--<div>--}}
{{--    @foreach ($incomes as $income)--}}
{{--    @if ($income->amount < 0 )--}}
{{--    <div class="alert alert-danger" role="alert">--}}
{{--        <strong> {{ $income->amount }} </strong> {{__('site.SAR')}}  {{ $income->comment }}--}}
{{--    </div>--}}
{{--    @else--}}
{{--    <div class="alert alert-success" role="alert">--}}
{{--        <strong> {{ $income->amount }} </strong> {{__('site.SAR')}}  {{ $income->comment }}--}}
{{--    </div>--}}
{{--    @endif--}}
{{--    @endforeach--}}
{{--</div>--}}


<section class="section-content padding-y">
    <div class="container">

        <div class="row">
            <aside class="col-md-3">
                <nav class="list-group">
                    @include('site.user_side_bar')
                </nav>
            </aside> <!-- col.// -->
            <main class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <article class="card-group card-stat">
                                    <figure class="card bg">
                                        <div class="p-3">
                                            <h4 class="title">{{ $orders_count }}</h4>
                                            <span>{{__('site.orders_count')}}</span>
                                        </div>
                                    </figure>
                                    <figure class="card bg">
                                        <div class="p-3">
                                            <h4 class="title">{{ $total_incomes }} <span> {{__('site.SAR')}} </span> </h4>
                                            <span> {{__('site.total_incomes')}} </span>
                                        </div>
                                    </figure>
                                    <figure class="card bg">
                                        <div class="p-3">
                                            <h4 class="title">{{ $total_incomes_withdrawal }} <span> {{__('site.SAR')}} </span> </h4>
                                            <span>{{__('site.total_incomes_withdrawal')}}</span>
                                        </div>
                                    </figure>

                                    <figure class="card bg">
                                        <div class="p-3">
                                            <h4 class="title">{{ $total_incomes_not_withdrawal }} <span> {{__('site.SAR')}} </span> </h4>
                                            <span> {{__('site.total_incomes_not_withdrawal')}}  </span>
                                        </div>
                                    </figure>

                                    <figure class="card bg">
                                        <div class="p-3">
                                            <h4 class="title">{{ $total_points }}</h4>
                                            <span> {{__('site.total_points')}}  </span>
                                        </div>
                                    </figure>

                                </article>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table class='table table-hover'>
                                    <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> {{__('site.order_no')}} </th>
                                        <th> {{__('site.product')}} </th>
                                        <th> {{__('site.total')}} </th>
                                        <th> {{__('site.points')}} </th>
                                        <th> {{__('site.can_withdrawal_when')}} </th>
                                        <th> {{__('site.status')}} </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($incomes as $income)
                                        <tr>
                                            <td> {{ $loop->iteration }} </td>
                                            <td> {{ $income->order->number ?? '' }} </td>
                                            <td> {{ $income->product->name ?? '' }} </td>
                                            <td> {{ $income->amount }} {{__('site.SAR')}} </td>
                                            <td> {{ $income->points }} </td>
                                            <td> {{ $income->can_withdrawal_when }}</td>
                                            <td>
                                                @switch($income->withdrawn)
                                                    @case(0)
                                                        <span class='badge badge-warning' > {{__('site.not_withdrawal')}} </span>
                                                        @break
                                                    @case(1)
                                                        <span class='badge badge-success' > {{__('site.withdrawal')}} </span>
                                                        @break
                                                @endswitch
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>
{{--                            <div class="card-footer">--}}
{{--                                <div class="mb-4 Page navigation sample" aria-label="Page navigation sample">--}}
{{--                                    {{$incomes->links()}}--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>

                    </div>
                </div>

            </main> <!-- col.// -->
        </div>

    </div> <!-- container .//  -->
</section>
