<div class="col-md-3 right-sidebar">
    <div class="home-sidebar">

        <!--------- Suggested Designers List --------->
        <div class="section">
            <div class="title col-md-12">
                <h5 class="mb-2"> @lang('site.Suggested Designers')  </h5>
            </div>

            <div class="sugested-designer-list">

                @foreach (\App\Models\User::inRandomOrder()->where('type', \App\Models\User::USER)->where('id', '!=', auth()->id())->take(3)->get() as $user)
                    <div class="media">
                        <a href="{{ route('users.show' , $user ) }}">
                            <div class="mr-3 media-img">
                                <a href="{{ route('users.show' , $user ) }}">
                                    <img
                                        src="{{ Storage::url('users/'.$user->image) }}"/>
                                </a>
                            </div>
                            <div class="media-body">
                                <a href="{{ route('users.show' , $user ) }}">
                                    <p class="m-0 users-list-name"> {{ $user->name() }} </p>
                                </a>
                            </div>
                        </a>
                        <div class="ml-auto">
                            @livewire('site.follow-user' , ['designer' => $user] , key($user->id) )
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <!--------- Heigh Recomanded Designs List --------->
        @if(\App\Models\UserDesign::count() > 0)
            <div class="section">
                <div class="title col-md-12 mt-4">
                    <h5 class="mb-2"> @lang('site.Heigh Recomanded Designs') </h5>
                </div>
                <div class="list-group heigh-recomanded-list">
                    @foreach(\App\Models\UserDesign::inRandomOrder()->get()->take(3) as $record)
                        <!-- list-item -->
                        <div class="list-item ">
                            <div class="media">
                                <a class="mr-3 heigh-recomanded-img"
                                   href="{{ route('custom-designs', $record->id).'?type=design' }}">
                                    <div style="width: 130px; height: 155px">
                                        <img
                                            style="background-color: {{$record->main_color_code}}"
                                            src="{{Storage::url('products/'.$record->image)}}">
                                        <img class="img-fluid pad" alt="design"
                                             src="{{Storage::url('designs/'.$record->design_image_front)}}"
                                             style="width: {{$record->product->site_front_width}}%; height: {{$record->product->site_front_height}}%; top: {{$record->product->site_front_top}}%; left: {{$record->product->site_front_left}}%;position: absolute;">
                                    </div>
                                </a>
                                <div class="media-body">
                                    <a href="{{ route('custom-designs', $record->id).'?type=design' }}" class="m-0">{{$record->description}}</a>
                                    <!-- designer-item -->
                                    <a href="{{$record->user->url() ?? ''}}" class="media">
                                        <div class="mr-2 media-img"><img
                                                src="{{ Storage::url('users/'.$record->user->image) ?? '' }}"/>
                                        </div>
                                        <div class="media-body">
                                            <p class="m-0 text-gray">{{$record->user->name() ?? ''}}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!--------- Heigh Recomanded Designs List --------->
        @include('site.layouts.footer')
    </div>
</div>
