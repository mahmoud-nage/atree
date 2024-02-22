<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Design extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'description',
        'views_count',
        'times_used_count',
        'diamonds_earned',
        'is_active',
        'image',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'design_product');
    }

    public function url()
    {
        return route('products.show', $this->id . '-' . $this->name);
    }
}
