<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name', 'description'];
    protected $fillable = [
        'user_id',
        'price',
        'name',
        'description',
        'rate',
        'world_code',
        'local_code',
        'unit_id',
        'returnable',
        'carton_includes',
        'category_id',
        'sub_category_id',
        'sub_sub_category_id',
        'type',
        'minimam',
        'includes_tax',
        'policy_segmental',
        'wholesale_policy',
        'have_wholesale_policy',
        'vip_policy',
        'sales_count',
        'sales_count',
        'views_count',
        'minimam_stock_alert',
        'country_id',
        'total_sales',
        'front_image',
        'back_image',
        'diamonds',
        'price_full_design',
        'category_id',
        'active',
        'show_in_home_page',

        'site_back_width',
        'site_back_height',
        'site_back_left',
        'site_back_top',
        'site_front_width',
        'site_front_height',
        'site_front_left',
        'site_front_top',
        'mobile_back_image_width',
        'mobile_back_image_height',
        'mobile_back_width',
        'mobile_back_height',
        'mobile_back_left',
        'mobile_back_top',
        'mobile_front_image_width',
        'mobile_front_image_height',
        'mobile_front_width',
        'mobile_front_height',
        'mobile_front_left',

        'mobile_front_top', 'mobile_back_image', 'mobile_back_tint', 'mobile_back_shadow',
        'mobile_front_image', 'mobile_front_tint', 'mobile_front_shadow'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function variations()
    {
        return $this->hasMany(Variation::class, 'product_id');
    }


    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }


    public function url()
    {
        return route('products.show', $this->id . '-' . $this->name);
    }


    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function design_products(): hasMany
    {
        return $this->hasMany(DesignProduct::class, 'product_id');
    }

    public function getPrice()
    {
        if ($this->price_after_discount) {
            return $this->price_after_discount;
        }

        return $this->price;
    }


}
