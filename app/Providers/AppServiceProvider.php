<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Aws\Sns\SnsClient;
use App\Channels\SmsChannel;
use Aws\Credentials\Credentials;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;
use App\Models\Message;
use App\Models\Settings;
use App\Models\Page;
use App\Models\Category;
use App\Models\Complain;
use App\Models\Country;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $data['unrd_mssages_count'] = Message::where('seen' , 0)->count();
        $data['unrd_complains_count'] = Complain::where('seen' , 0)->count();
        $data['settings'] = Settings::first();
        $data['pages'] = Page::where('active' , 1)->get();
        $data['categories'] = Category::where('active' , 1)->where('show_in_header' , 1)->where('category_id' , null )->latest()->get();
        $data['countries'] = Country::where('active' , 1 )->latest()->get();
        view()->share('data' , $data);
    }
}
