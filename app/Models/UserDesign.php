<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserDesign extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'design_product', 'design_id');
    }

    public function design_products(): hasMany
    {
        return $this->hasMany(DesignProduct::class, 'design_id');
    }

    public function url()
    {
        return route('products.show', $this->id . '-' . $this->name);
    }
}
