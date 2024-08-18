<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DesignProduct extends Model
{
    use HasFactory;
    protected $table = 'design_product';
    protected $fillable = [
        'design_id',
        'product_id',
        'diamonds',
    ];


    public function design(): BelongsTo
    {
        return $this->belongsTo(UserDesign::class, 'design_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
