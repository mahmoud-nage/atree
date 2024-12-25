@extends('site.layouts.master')
@section('page_content')
    <!-- ========================= SECTION CONTENT ========================= -->
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
                                                <h4 class="title"> {{ $can_withdrawal }}
                                                    <span> {{__('site.can_withdrawal')}} </span></h4>
                                                <span> {{__('site.SAR')}} </span>
                                            </div>
                                        </figure>
                                        <figure class="card bg">
                                            <div class="p-3">
                                                <h4 class="title"> {{ $can_not_withdrawal }}
                                                    <span> {{__('site.can_not_withdrawal')}} </span></h4>
                                                <span> {{__('site.SAR')}} </span>
                                            </div>
                                        </figure>

                                    </article>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <article class="card p-4" style="background: #642F91;">
                                <div class="row align-items-center">
                                    <div class="col"><p
                                            class="mb-0 text-white">{{__('site.minimum_money_can_be_withdrawal')}}
                                            : {{ $data['settings']->minimam_money_can_be_withdrawal }} {{__('site.SAR')}} </p>
                                    </div>
                                    <div class="col-auto">
                                        @if ($can_withdrawal >= $data['settings']->minimam_money_can_be_withdrawal )
                                            <a class="btn btn-warning" href="{{ route('withdrawals.create') }}">
                                                {{__('site.get_withdrawal')}} </a>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <table class='table table-hover'>
                                        <thead>
                                        <tr>
                                            <th> #</th>
                                            <th> {{__('site.order_no')}} </th>
                                            <th> {{__('site.total')}} </th>
                                            <th> {{__('site.status')}} </th>
                                            <th>{{__('site.actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($withdrawals as $withdrawal)
                                            <tr>
                                                <td> {{ $loop->iteration }} </td>
                                                <td> {{ $withdrawal->number }} </td>
                                                <td> {{ $withdrawal->amount }} {{__('site.SAR')}} </td>
                                                <td>
                                                    @switch($withdrawal->status)
                                                        @case(1)
                                                            <span class='badge badge-warning'> قيد المراجعه </span>
                                                            @break
                                                        @case(2)
                                                            <span class='badge badge-success'> جارى تحويل المبلغ </span>
                                                            @break
                                                        @case(3)
                                                            <span class='badge badge-primary'> تم الموافقه </span>
                                                            @break
                                                        @case(4)
                                                            <span class='badge badge-danger'> تم الرفض </span>
                                                            @break
                                                    @endswitch
                                                </td>
                                                <td><a href="{{ route('withdrawals.show' , $withdrawal ) }}"
                                                       class="btn btn-primary btn-sm"> مشاهده الطلب </a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </main> <!-- col.// -->
            </div>

        </div> <!-- container .//  -->
    </section>
    <!-- ========================= SECTION CONTENT END// ========================= -->
@endsection
