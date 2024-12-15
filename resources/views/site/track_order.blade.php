@extends('site.layouts.master')
@section('styles')
@endsection
@section('page_content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper pt-3">
        <!-- Main content -->
        <section class="content">
            <div class="card-body">
                <div class="row">
                    <!-- Order list Container -->
                    <div class="col-md-8">
                        <div class="category-container Track-order">

                            <!-- Order list item -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <div>
                                        <p class="card-title">{{__('site.Order Date')}}</p>
                                        <p class="font-weight-normal">{{date('d F Y', strtotime($record->created_at))}}</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- The timeline -->
                                    <div class="timeline timeline-inverse">
                                        <!-- timeline time label -->
                                        @foreach(\App\Models\ShippingStatus::all() as $status)
                                            <div
                                                @if($record->shipping_statues_id < $status->id) style="opacity: 0.5" @endif>
                                                <i class="fas fa-check bg-primary"></i>
                                                <div class="timeline-item">
                                                    <div class="timeline-body">
                                                        <div class="card-title">{{$status->name}}</div>
                                                        @if($record->shipping_url && $status->id == 3)
                                                            {{__('site.shipping_company')}} : {{$record->shipping_company->name??''}}
                                                            <br/>
                                                            <a href="{{$record->shipping_url}}">{{__('site.shipping_url')}}</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <!-- timeline item -->
                                        <!-- END timeline item -->
                                    </div>
                                </div>
                                <div class="text-right p-3">
                                    <a href="{{route('orders')}}"
                                       class=" btn btn-primary bg-primary-gridant">{{__('site.Back to order Summary')}}</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- Right side -->
                    @include('site.layouts.sidebar_left2')
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('scripts')
@endsection
