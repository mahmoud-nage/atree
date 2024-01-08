@php
$lang = LaravelLocalization::getCurrentLocale();
if ($lang == 'ar') {
  $dir = 'rtl';
} else {
  $dir = 'ltr';
}
@endphp
@extends('site.layouts.master')
@section('page_content')
 <div class="container-fluid">
        <!-- /.row -->
        <div class="row">  
            
          <div class="card card-widget widget-user" style="width: 100%;">
              <div class="widget-user-header text-white" style="background: url('{{ asset('site_assets/'.$dir.'/img/photo1.png') }}') center center;">
                <label class="upload-icon fa fa-image">
                  <input id="panner-background" type="file">
              </label>
              </div><!-- Add the bg color to the header using any of the bg-* classes -->
              
              
            </div><!-- /.col -->
          
            <div class="bio-header">
              <div class="bio-user-image">
                <img class="img-circle" src="{{ Storage::url('users/'.$user->image) }}" alt="User Avatar">
                <label class="upload-icon fa fa-image">
                    <input id="file-input" type="file"/>
                </label>
              </div>
              
              <div class="bio-user-info">
                <h5 class="widget-user-desc text-left text-bold mb-1"> {{ $user->name() }} </h5>
                <h3 class="widget-user-username text-left mb-3">@ {{ $user->username }}</h3>
              </div>
              
              <div class="bio-user-info ml-auto">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#followersPopup">1000 @lang('site.Followers') </button>
              </div>

            </div>



            <!-- //////////////////////////////////// -->
            <div class="col-md-4">
              <div class="card p-2">

                <div class="d-flex flex-wrap justify-content-between align-items-center">
                  <h5 class="font-weight-bold"> @lang('site.Bio') </h5>
                  <div>
                    <button type="button" class="btn circle-btn fa fa-edit" style="background: #eee;"></button>
                  </div>
                </div>

                <p>
                  {{ $user->bio }}               
                </p>

              </div>
            </div>

            <!-- Order list Container -->
            <div class="col-md-8">
            
              <!-- Order list item -->
              <div class="card card-primary bio-content">
                <div class="card-header">
                  <div>
                    <p class="card-title text-lg font-weight-bold mb-0">Create</p>
                    <p class="font-weight-normal mb-0">Your Owen Design</p>
                  </div>
          
          
                  <div class="ml-auto">
                    <a href="custom-designs.html" class="btn circle-btn fa fa-plus"></a>
                  </div>
                </div>
                <div class="card-body">
          
                      <!-------------------------- Posts List --------------------------->
                    <div class="card card-widget mb-3">
                      <div class="card-header">
                        <div class="user-block">
                          <img class="img-circle" src="{{ asset('site_assets/'.$dir.'/img/user1-128x128.jpg') }}" alt="User Image">
                          <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                          <span class="description">@Jonathan</span>
                        </div>
                        <!-- /.user-block -->
                        <div class="card-tools">
                          <span class="text-muted p-4"> 12 H </span>
                        </div>
                        <!-- /.card-tools -->
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <a href="products.html" class="text-center post-image-container">
                          <div class="badge badge-light">200 <span>SAR</span></div>
                          <img class="img-fluid pad" src="{{ asset('site_assets/'.$dir.'/img/tshirt-4.jpg') }}" alt="Photo">
                        </a>

                        <p>I took this photo this morning. What do you guys think?</p>
                        <div class="tag-btns-container">
                          <a href="#" class="btn tag-btn"> Tag link </a>
                          <a href="#" class="btn tag-btn"> Tag link </a>
                          <a href="#" class="btn tag-btn"> Tag link </a>
                          <a href="#" class="btn tag-btn"> Tag link </a>
                          <a href="#" class="btn tag-btn"> Tag link </a>
                          <a href="#" class="btn tag-btn"> Tag link </a>
                          <a href="#" class="btn tag-btn"> Tag link </a>
                          <a href="#" class="btn tag-btn"> Tag link </a>
                          </ul>
                        </div>

                      </div>



                    </div>
          
                      <!-------------------------- Posts List --------------------------->
                    <div class="card card-widget mb-3">
                      <div class="card-header">
                        <div class="user-block">
                          <img class="img-circle" src="img/user1-128x128.jpg" alt="User Image">
                          <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                          <span class="description">@Jonathan</span>
                        </div>
                        <!-- /.user-block -->
                        <div class="card-tools">
                          <span class="text-muted p-4"> 12 H </span>
                        </div>
                        <!-- /.card-tools -->
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <a href="Product-details.html" class="text-center post-image-container">
                          <div class="badge badge-light">200 <span>SAR</span></div>
                          <img class="img-fluid pad" src="img/tshirt-5.jpg" alt="Photo">
                        </a>

                        <p>I took this photo this morning. What do you guys think?</p>
                        <div class="tag-btns-container">
                          <a href="#" class="btn tag-btn"> Tag link </a>
                          <a href="#" class="btn tag-btn"> Tag link </a>
                          <a href="#" class="btn tag-btn"> Tag link </a>
                          <a href="#" class="btn tag-btn"> Tag link </a>
                          <a href="#" class="btn tag-btn"> Tag link </a>
                          <a href="#" class="btn tag-btn"> Tag link </a>
                          <a href="#" class="btn tag-btn"> Tag link </a>
                          <a href="#" class="btn tag-btn"> Tag link </a>
                          </ul>
                        </div>

                      </div>



                    </div>


                    <!-------------------------- Posts List --------------------------->
                    <div class="section used-design">
                      <div class="title d-flex justify-content-between col-md-12">
                        <h5 class="mb-2">lateest design</h5>
                        <a href="Products.html" class="text-sm text-dark"> more</a>
                      </div>
      
                      <ul class="users-list clearfix">
                        <li>
      
                          <a href="#">
                            <div class="image-container">
                              <img src="img/design-1.jpg" alt="User Image">
                            </div>
                          </a>
                          <a class="users-list-name" href="#">Alexander Pierce</a>
                        </li>
                        <li>
                          <a href="#">
                            <div class="image-container">
                              <img src="img/design-2.png" alt="User Image">
                            </div>
                          </a>
                          <a class="users-list-name" href="#">Norman</a>
                        </li>
                        <li>
                          <a href="#">
                            <div class="image-container">
                              <img src="img/photo3.jpg" alt="User Image">
                            </div>
                          </a>
                          <a class="users-list-name" href="#">Jane</a>
                        </li>
                        <li>
                          <a href="#">
                            <div class="image-container">
                              <img src="img/photo2.png" alt="User Image">
                            </div>
                          </a>
                          <a class="users-list-name" href="#">John</a>
                        </li>
                      </ul>
      
                    </div>


                </div>
              </div>
            </div>
          
        </div>          
        <!-- /.row -->
      </div>
@endsection


