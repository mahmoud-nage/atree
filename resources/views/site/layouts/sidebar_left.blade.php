<div class="col-md-3 right-sidebar">
    <div class="home-sidebar">

        <!--------- Suggested Designers List --------->
        <div class="section">
            <div class="title col-md-12">
                <h5 class="mb-2"> @lang('site.Suggested Designers')  </h5>
            </div>

            <div class="sugested-designer-list">

                @foreach (\App\Models\User::inRandomOrder()->where('type', \App\Models\User::USER)->take(3)->get() as $user)
                    <div class="media">
                        <div class="mr-3 media-img"><img
                                src="{{ Storage::url('users/'.$user->image) }}"/></div>
                        <div class="media-body">
                            <p class="m-0"> {{ $user->name() }} </p>
                        </div>
                        <div class="ml-auto">
                            @livewire('site.follow-user' , ['designer' => $user] , key($user->id) )
                        </div>
                    </div>
                @endforeach

            </div>

        </div>


        <!--------- Heigh Recomanded Designs List --------->
        <div class="section">
            <div class="title col-md-12 mt-4">
                <h5 class="mb-2"> @lang('site.Heigh Recomanded Designs') </h5>
            </div>
            <div class="list-group heigh-recomanded-list">

                <!-- list-item -->
                <div class="list-item ">
                    <div class="media">
                        <a class="mr-3 heigh-recomanded-img" href="#"> <img
                                src="{{ asset('site_assets/ltr/img/photo1.png') }}"> </a>
                        <div class="media-body">
                            <a href="#" class="m-0">Design Recomanded Number 1</a>
                            <!-- designer-item -->
                            <a href="#" class="media">
                                <div class="mr-2 media-img"><img
                                        src="{{ asset('site_assets/ltr/img/avatar4.png') }}"/>
                                </div>
                                <div class="media-body">
                                    <p class="m-0 text-gray">Moataz Ibrahim</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- list-item -->
                <div class="list-item ">
                    <div class="media">
                        <a class="mr-3 heigh-recomanded-img" href="#"> <img
                                src="{{ asset('site_assets/ltr/img/photo3.jpg') }}"> </a>
                        <div class="media-body">
                            <a href="#" class="m-0">Design Recomanded Number 2</a>
                            <!-- designer-item -->
                            <a href="#" class="media">
                                <div class="mr-2 media-img"><img
                                        src="{{ asset('site_assets/ltr/img/avatar4.png') }}"/>
                                </div>
                                <div class="media-body">
                                    <p class="m-0 text-gray">Moataz Ibrahim</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- list-item -->
                <div class="list-item ">
                    <div class="media">
                        <a class="mr-3 heigh-recomanded-img" href="#"> <img
                                src="{{ asset('site_assets/ltr/img/photo2.png') }}"> </a>
                        <div class="media-body">
                            <a href="#" class="m-0">Design Recomanded Number 3</a>
                            <!-- designer-item -->
                            <a href="#" class="media">
                                <div class="mr-2 media-img"><img
                                        src="{{ asset('site_assets/ltr/img/avatar4.png') }}"/>
                                </div>
                                <div class="media-body">
                                    <p class="m-0 text-gray">Moataz Ibrahim</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!--------- Heigh Recomanded Designs List --------->
        @include('site.layouts.footer')
    </div>
</div>
