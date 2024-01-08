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
                                        <p class="card-title">Order Placed</p>
                                        <p class="font-weight-normal">20 April 2023</p>
                                    </div>
                                </div>

                                <div class="card-body">




                                    <!-- The timeline -->
                                    <div class="timeline timeline-inverse">
                                        <!-- timeline time label -->

                                        <!-- timeline item -->
                                        <div>
                                            <i class="fas fa-check bg-primary"></i>
                                            <div class="timeline-item">
                                                <div class="timeline-body">
                                                    <div class="card-title">Your request has been confirmed </div>
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                    Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an
                                                    unknown printer took a
                                                    galley of type and scrambled it to make a type specimen book. It has survived not only five
                                                    centuries
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->

                                        <!-- timeline item -->
                                        <div>
                                            <i class="fas fa-check bg-primary"></i>
                                            <div class="timeline-item">
                                                <div class="timeline-body">
                                                    <div class="card-title">Your request has been confirmed </div>
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                    Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an
                                                    unknown printer took a
                                                    galley of type and scrambled it to make a type specimen book. It has survived not only five
                                                    centuries
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->

                                        <!-- timeline item -->
                                        <div>
                                            <i class="fas fa-check bg-primary"></i>
                                            <div class="timeline-item">
                                                <div class="timeline-body">
                                                    <div class="card-title">Your order has been shipped</div>
                                                    Take me to your leader!
                                                    Switzerland is small and neutral!
                                                    We are more like Germany, ambitious and misunderstood!
                                                    <br/>
                                                    <a href="#">shiping link</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->

                                        <!-- timeline item -->
                                        <div>
                                            <i class="fas fa-check bg-primary"></i>
                                            <div class="timeline-item">
                                                <div class="timeline-body">
                                                    <div class="card-title">Your Order Delivered </div>
                                                    Take me to your leader!
                                                    Switzerland is small and neutral!
                                                    We are more like Germany, ambitious and misunderstood!
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->
                                    </div>

                                </div>

                                <div class="text-right p-3">
                                    <a href="{{route('orders')}}" class=" btn btn-primary bg-primary-gridant">Back to order Summary</a>
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
